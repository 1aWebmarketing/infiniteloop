<?php

namespace App\Jobs;

use App\Mail\NewItemComment;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNewCommentNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Item $item,
        public Comment $comment,
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

        unset($receivers[$this->comment->user->email]);

//        print_r($receivers);

        foreach($receivers as $email => $notify) {
            Mail::to($email)->send(new NewItemComment($this->item, $this->comment));
        }

    }
}
