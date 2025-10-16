<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckArrangementRequest;
use App\Models\Team;
use App\Services\PuzzleValidationService;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService,
        private readonly PuzzleValidationService $puzzleValidationService
    ) {}

    /**
     * Dashboard Operator: display all teams with confirmation progress.
     */
    public function dashboard()
    {
        $teams = Team::withCount('submissions')
            ->with(['submissions' => function ($query) {
                $query->where('is_confirmed', true);
            }])
            ->orderBy('name')
            ->get();

        $progress = $this->submissionService->getConfirmationProgress();
        $teamsWithoutConfirmation = $this->submissionService->getTeamsWithoutConfirmedSubmission();

        return view('dashboard', compact('teams', 'progress', 'teamsWithoutConfirmation'));
    }

    /**
     * Show confirmation page for team submissions.
     */
    public function showConfirm(Team $team)
    {
        $submissions = $team->submissions()->latest()->get();
        $currentConfirmed = $team->submissions()->where('is_confirmed', true)->first();

        return view('operator.confirm', compact('team', 'submissions', 'currentConfirmed'));
    }

    /**
     * Process confirmation of SINGLE submission per team.
     */
    public function processConfirm(Request $request, Team $team)
    {
        $request->validate([
            'submission_id' => ['required', 'integer', 'exists:team_submissions,id'],
        ], [
            'submission_id.required' => 'Silakan pilih satu potongan.',
            'submission_id.exists' => 'Potongan tidak valid.',
        ]);

        $success = $this->submissionService->confirmSingleSubmission(
            $team,
            $request->input('submission_id')
        );

        if (!$success) {
            return back()->with('error', 'Gagal mengkonfirmasi. Potongan tidak ditemukan atau bukan milik tim ini.');
        }

        // Check if all teams have confirmed
        $progress = $this->submissionService->getConfirmationProgress();

        if ($progress['is_complete']) {
            return redirect()
                ->route('operator.arrange.show')
                ->with('success', 'Semua tim sudah dikonfirmasi! Silakan susun urutannya.');
        }

        // Get next team without confirmation
        $nextTeam = $this->submissionService->getTeamsWithoutConfirmedSubmission()->first();

        if ($nextTeam) {
            return redirect()
                ->route('operator.confirm.show', $nextTeam)
                ->with('success', "Potongan tim {$team->name} berhasil dikonfirmasi. Lanjut ke {$nextTeam->name}.");
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Potongan berhasil dikonfirmasi.');
    }

    /**
     * Show arrangement page with ALL confirmed submissions (1 per team).
     */
    public function showArrange()
    {
        // Check if all teams have confirmed submission
        if (!$this->submissionService->allTeamsHaveConfirmedSubmission()) {
            $teamsWithout = $this->submissionService->getTeamsWithoutConfirmedSubmission();
            
            return redirect()
                ->route('dashboard')
                ->with('error', 'Belum semua tim memiliki potongan terkonfirmasi. Tim yang belum: ' 
                    . $teamsWithout->pluck('name')->implode(', '));
        }

        $confirmedSubmissions = $this->submissionService->getAllConfirmedSubmissions();

        return view('operator.arrange', compact('confirmedSubmissions'));
    }

    /**
     * Validate order and return result as JSON.
     * Always returns HTML for preview (success or not).
     */
    public function checkOrder(CheckArrangementRequest $request)
    {
        $order = $request->validated()['order'];

        $result = $this->puzzleValidationService->validateOrder($order);

        // Always return 200 OK since we want to show the preview regardless
        // Use JSON_UNESCAPED_UNICODE to prevent HTML encoding
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
