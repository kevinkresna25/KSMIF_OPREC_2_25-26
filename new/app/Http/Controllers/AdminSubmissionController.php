<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamSubmission;
use Illuminate\Http\Request;

class AdminSubmissionController extends Controller
{
    /**
     * Display a listing of submissions with filters.
     */
    public function index(Request $request)
    {
        $teams = Team::orderBy('name')->get();
        $selectedTeamId = $request->query('team_id');
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status'); // 'confirmed', 'pending', or null (all)
        $perPage = max(10, min((int) $request->query('per_page', 15), 50));

        $query = TeamSubmission::with('team')->latest();

        // Filter by team
        if ($selectedTeamId) {
            $query->where('team_id', $selectedTeamId);
        }

        // Filter by status
        if ($status === 'confirmed') {
            $query->where('is_confirmed', true);
        } elseif ($status === 'pending') {
            $query->where('is_confirmed', false);
        }

        // Search in content or team name
        if ($search) {
            $query->search($search);
        }

        $submissions = $query->paginate($perPage)->withQueryString();

        // Statistics
        $stats = [
            'total' => TeamSubmission::count(),
            'confirmed' => TeamSubmission::where('is_confirmed', true)->count(),
            'pending' => TeamSubmission::where('is_confirmed', false)->count(),
        ];

        return view('operator.submissions.index', compact('submissions', 'teams', 'selectedTeamId', 'search', 'status', 'perPage', 'stats'));
    }

    /**
     * Remove the specified submission.
     */
    public function destroy(TeamSubmission $submission)
    {
        $teamName = $submission->team->name ?? 'Unknown';
        $submission->delete();

        return redirect()
            ->route('operator.manage.submissions.index')
            ->with('success', "Inputan dari tim {$teamName} berhasil dihapus.");
    }

    /**
     * Bulk delete submissions.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!is_array($ids) || empty($ids)) {
            return back()->with('error', 'Tidak ada inputan yang dipilih.');
        }

        $count = TeamSubmission::whereIn('id', $ids)->delete();

        return back()->with('success', "{$count} inputan berhasil dihapus.");
    }
}
