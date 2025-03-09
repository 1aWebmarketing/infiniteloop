<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creative extends Model
{
    use HasUuids;

    public $fillable = [
        'item_id',
        'name',
        'path',
        'type',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function display(int $maxHeight = 300)
    {
        if($this->type === 'IMAGE')
        {
            return "<img src='" . asset($this->path) . "'
                class='object-cover hover:object-contain hover:outline outline-gray-300 hover:cursor-pointer'
                style='max-height: {{$maxHeight}}px; aspect-ratio: 1/1;'>";
        }
        if($this->type === 'VIDEO')
        {
            return "<video
                class='hover:cursor-pointer'
                style='max-height: {{$maxHeight}}px; aspect-ratio: 1/1;'
                onclick='if(this.paused){this.play();}else{this.pause();this.currentTime = 0;}'>
                <source src='" . asset($this->path) . "'>
            </video>";

        }
    }
}
