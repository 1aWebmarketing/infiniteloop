<?php

namespace App\Livewire;

use App\Jobs\SendNewCommentNotification;
use Livewire\Component;
use App\Models\Item;

class ItemStatusSelector extends Component
{
    public Item $item;
    public string $status;

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->status = $this->item->status;
    }

    public function updatedStatus()
    {
        $comment = $this->item->comments()->create([
            'user_id' => auth()->id(),
            'text' => $this->item->status . ' -> ' . $this->status,
        ]);

        $this->item->update([
            'status' => $this->status
        ]);

        SendNewCommentNotification::dispatch($this->item, $comment);
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <x-select-group name="status" wire:model.change="status" options='CREATED:CREATED;IN_PROGRESS:IN_PROGRESS;DONE:DONE' :value="$item->status" />
        </div>
        HTML;
    }
}
