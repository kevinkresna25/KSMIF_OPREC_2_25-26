<?php

namespace App\Observers;

use App\Models\TeamSubmission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TeamSubmissionObserver
{
    /**
     * Handle the TeamSubmission "created" event.
     */
    public function created(TeamSubmission $teamSubmission): void
    {
        $this->clearCache();
        
        Log::info('New submission created', [
            'submission_id' => $teamSubmission->id,
            'team_id' => $teamSubmission->team_id,
            'team_name' => $teamSubmission->team->name ?? 'Unknown',
        ]);
    }

    /**
     * Handle the TeamSubmission "updated" event.
     */
    public function updated(TeamSubmission $teamSubmission): void
    {
        $this->clearCache();
        
        // Log confirmation changes
        if ($teamSubmission->isDirty('is_confirmed')) {
            $status = $teamSubmission->is_confirmed ? 'confirmed' : 'unconfirmed';
            
            Log::info("Submission {$status}", [
                'submission_id' => $teamSubmission->id,
                'team_id' => $teamSubmission->team_id,
                'team_name' => $teamSubmission->team->name ?? 'Unknown',
                'status' => $status,
            ]);
        }
    }

    /**
     * Handle the TeamSubmission "deleted" event.
     */
    public function deleted(TeamSubmission $teamSubmission): void
    {
        $this->clearCache();
        
        Log::info('Submission deleted', [
            'submission_id' => $teamSubmission->id,
            'team_id' => $teamSubmission->team_id,
        ]);
    }

    /**
     * Clear relevant caches.
     */
    private function clearCache(): void
    {
        // Clear progress cache
        Cache::forget('confirmation_progress');
        Cache::forget('confirmed_submissions');
        Cache::forget('teams_without_confirmation');
    }
}
