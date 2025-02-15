<?php

namespace App\Jobs;

use App\Mail\ItemNewStatus;
use App\Models\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ItemNewStatusNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Item $item,
        public string $oldStatus,
        public string $newStatus,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $receivers = array(
            $this->item->user->email => 1,
        );

        foreach($this->item->comments as $comment) {
            $receivers[$comment->user->email] = 1;
        }

        foreach($receivers as $email => $notify) {
            Mail::to($email)->send(new ItemNewStatus($this->item, $this->oldStatus, $this->newStatus));
        }
    }
}
