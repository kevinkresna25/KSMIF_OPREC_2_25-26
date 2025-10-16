<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\TeamSubmission;
use App\Services\SubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService
    ) {}

    /**
     * Display form input and all submissions.
     */
    public function create(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $perPage = max(5, min((int) $request->query('per_page', 10), 50));

        $allSubmissions = $this->submissionService->getPaginatedSubmissions($search ?: null, $perPage);

        return view('submissions.create', [
            'allSubmissions' => $allSubmissions,
            'q' => $search,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Store a new submission with duplicate prevention.
     */
    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $teamId = auth()->guard('team')->id();

        // Check for duplicate
        $duplicate = $this->submissionService->isDuplicate($validated['content']);
        
        if ($duplicate) {
            return back()
                ->withInput()
                ->with('error', 'Potongan ini sudah pernah disimpan oleh tim: ' . ($duplicate->team->name ?? 'Unknown') . '.');
        }

        // Create submission
        $this->submissionService->createSubmission(
            $teamId,
            $validated['content']
        );

        return back()
            ->with('success', 'Potongan berhasil disimpan.');
    }

    /**
     * Remove the specified submission from storage.
     */
    public function destroy(TeamSubmission $submission): RedirectResponse
    {
        $team = auth()->guard('team')->user();

        // Authorization check
        if ($submission->team_id !== $team->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus submission ini.');
        }

        if ($submission->is_confirmed) {
            return back()->with('error', 'Submission yang sudah di-confirm tidak bisa dihapus.');
        }

        $submission->delete();

        return back()->with('success', 'Submission berhasil dihapus.');
    }
}
