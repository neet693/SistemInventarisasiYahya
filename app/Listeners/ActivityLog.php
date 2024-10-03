<?php

namespace App\Listeners;

use App\Models\ActivityLog as ModelsActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ActivityLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $this->logActivity($event->user, 'login');
    }

    protected function logActivity($user, $action)
    {
        Log::info('Activity logged for user: ' . $user->email);

        ModelsActivityLog::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'action' => $action,
            'ip_address' => request()->ip(),
        ]);
    }
}
