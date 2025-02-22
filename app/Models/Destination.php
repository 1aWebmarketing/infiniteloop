<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'item_id',
        'type',
        'remote_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
