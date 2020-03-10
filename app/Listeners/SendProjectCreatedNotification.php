<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ProjectCreated as ProjectCreatedMail;

class SendProjectCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProjectCreated  $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        // In response to that event, This listener it will maill to its owner the email
        Mail::mailer('smtp')
            ->to($event->project->owner->email)
            ->send(new ProjectCreatedMail($event->project));
    }
}
