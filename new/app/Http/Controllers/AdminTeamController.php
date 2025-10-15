<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreTeamRequest;
use App\Http\Requests\Admin\UpdateTeamRequest;
use App\Models\Team;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of teams.
     */
    public function index()
    {
        $teams = Team::withCount('submissions')
            ->with(['submissions' => function ($query) {
                $query->where('is_confirmed', true);
            }])
            ->orderBy('name')
            ->paginate(15);
        
        return view('operator.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     */
    public function create()
    {
        return view('operator.teams.create');
    }

    /**
     * Store a newly created team.
     */
    public function store(StoreTeamRequest $request)
    {
        Team::create($request->validated());

        return redirect()
            ->route('operator.manage.teams.index')
            ->with('success', 'Team berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified team.
     */
    public function edit(Team $team)
    {
        return view('operator.teams.edit', compact('team'));
    }

    /**
     * Update the specified team.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data = $request->validated();
        
        // Remove password from update if not provided
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $team->update($data);

        return redirect()
            ->route('operator.manage.teams.index')
            ->with('success', 'Team berhasil diperbarui.');
    }

    /**
     * Remove the specified team.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()
            ->route('operator.manage.teams.index')
            ->with('success', 'Team berhasil dihapus.');
    }
}
