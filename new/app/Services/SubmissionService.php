<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamSubmission;
use Illuminate\Support\Collection;

class SubmissionService
{
    /**
     * Check if content already exists globally.
     */
    public function isDuplicate(string $content): ?TeamSubmission
    {
        $normalized = TeamSubmission::normalizeContent($content);
        $hash = hash('sha256', $normalized);

        return TeamSubmission::with('team')
            ->where('content_hash', $hash)
            ->first();
    }

    /**
     * Create a new submission.
     */
    public function createSubmission(int $teamId, string $content): TeamSubmission
    {
        return TeamSubmission::create([
            'team_id' => $teamId,
            'content' => $content,
            'is_confirmed' => false,
        ]);
    }

    /**
     * Get paginated submissions with optional search.
     */
    public function getPaginatedSubmissions(?string $search = null, int $perPage = 10)
    {
        $query = TeamSubmission::with('team')->latest();

        if ($search) {
            $query->search($search);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Confirm ONLY ONE submission for a team (unset others first).
     */
    public function confirmSingleSubmission(Team $team, int $submissionId): bool
    {
        // Validate that submission belongs to this team
        $submission = TeamSubmission::where('id', $submissionId)
            ->where('team_id', $team->id)
            ->first();

        if (!$submission) {
            return false;
        }

        // Unset all confirmed submissions for this team first
        TeamSubmission::where('team_id', $team->id)
            ->update(['is_confirmed' => false]);

        // Then confirm only the selected one
        $submission->update(['is_confirmed' => true]);

        return true;
    }

    /**
     * Get confirmed submissions for a team.
     */
    public function getConfirmedSubmissions(Team $team)
    {
        return $team->submissions()
            ->where('is_confirmed', true)
            ->latest('id')
            ->get();
    }

    /**
     * Get ALL confirmed submissions (1 per team) for arrangement.
     */
    public function getAllConfirmedSubmissions(): Collection
    {
        return TeamSubmission::with('team')
            ->confirmed()
            ->get()
            ->groupBy('team_id')
            ->map(fn($submissions) => $submissions->first());
    }

    /**
     * Check if all teams have exactly 1 confirmed submission.
     */
    public function allTeamsHaveConfirmedSubmission(): bool
    {
        $totalTeams = Team::count();
        $teamsWithConfirmed = TeamSubmission::confirmed()
            ->distinct('team_id')
            ->count('team_id');

        return $totalTeams > 0 && $totalTeams === $teamsWithConfirmed;
    }

    /**
     * Get teams without confirmed submission.
     */
    public function getTeamsWithoutConfirmedSubmission(): Collection
    {
        $teamsWithConfirmed = TeamSubmission::confirmed()
            ->pluck('team_id')
            ->unique();

        return Team::whereNotIn('id', $teamsWithConfirmed)
            ->orderBy('name')
            ->get();
    }

    /**
     * Get confirmation progress statistics.
     */
    public function getConfirmationProgress(): array
    {
        $totalTeams = Team::count();
        $confirmedTeams = TeamSubmission::confirmed()
            ->distinct('team_id')
            ->count('team_id');

        return [
            'total_teams' => $totalTeams,
            'confirmed_teams' => $confirmedTeams,
            'remaining_teams' => $totalTeams - $confirmedTeams,
            'percentage' => $totalTeams > 0 ? round(($confirmedTeams / $totalTeams) * 100, 1) : 0,
            'is_complete' => $totalTeams > 0 && $confirmedTeams === $totalTeams,
        ];
    }
}
