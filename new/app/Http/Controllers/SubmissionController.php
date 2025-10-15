<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Team;
use App\Services\SubmissionService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function __construct(
        private readonly SubmissionService $submissionService
    ) {}

    /**
     * Display form input and all submissions.
     */
    public function create(Request $request)
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
    public function store(StoreSubmissionRequest $request)
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
}
