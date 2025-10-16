<?php

namespace App\Http\Controllers;

use App\Models\TeamSubmission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamDashboardController extends Controller
{
    /**
     * Display team dashboard with statistics and recent submissions.
     */
    public function dashboard(): View
    {
        /** @var \App\Models\Team $team */
        $team = auth()->guard('team')->user();
        
        // Statistics
        $stats = [
            'total_submissions' => $team->submissions()->count(),
            'confirmed_submissions' => $team->submissions()->where('is_confirmed', true)->count(),
            'pending_submissions' => $team->submissions()->where('is_confirmed', false)->count(),
            'latest_submission' => $team->submissions()->latest()->first(),
        ];
        
        // Recent submissions (last 5)
        $recentSubmissions = $team->submissions()
            ->latest()
            ->take(5)
            ->get();
        
        return view('team.dashboard', compact('team', 'stats', 'recentSubmissions'));
    }
    
    /**
     * Display team profile with full statistics.
     */
    public function profile(): View
    {
        /** @var \App\Models\Team $team */
        $team = auth()->guard('team')->user();
        
        $stats = [
            'total_submissions' => $team->submissions()->count(),
            'confirmed_submissions' => $team->submissions()->where('is_confirmed', true)->count(),
            'pending_submissions' => $team->submissions()->where('is_confirmed', false)->count(),
            'first_submission' => $team->submissions()->oldest()->first(),
            'latest_submission' => $team->submissions()->latest()->first(),
        ];
        
        return view('team.profile', compact('team', 'stats'));
    }
    
    /**
     * Display all submissions for the authenticated team with filters.
     */
    public function submissions(Request $request): View
    {
        /** @var \App\Models\Team $team */
        $team = auth()->guard('team')->user();
        
        $query = $team->submissions();
        
        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'confirmed') {
                $query->where('is_confirmed', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_confirmed', false);
            }
        }
        
        // Search in content
        if ($request->filled('q')) {
            $query->where('content', 'like', '%' . $request->q . '%');
        }
        
        // Pagination
        $perPage = $request->get('per_page', 10);
        $submissions = $query->latest()->paginate($perPage)->withQueryString();
        
        return view('team.submissions', compact('submissions', 'team'));
    }
}

