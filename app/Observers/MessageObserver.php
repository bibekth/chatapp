<?php

namespace App\Observers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $user = Auth::user();
        $from = $message->from;
        $to = $message->to;
        $pusher = new Pusher("1a480654e99768cdd279", "8ea1efdaec5fae1bc837", "1924751", array('cluster' => 'ap2'));
        if ($user->id == $from) {
            $otherId = $to;
        } else {
            $otherId = $from;
        }
        if ($user->id > $otherId) {
            $pusher->trigger('private-channel-' . $otherId . '-' . $user->id, 'client-event-' . $otherId . '-' . $user->id, array('message' => $message));
        } else {
            $pusher->trigger('private-channel-' . $user->id . '-' . $otherId, 'client-event-' . $user->id . '-' . $otherId, array('message' => $message));
        }
    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
