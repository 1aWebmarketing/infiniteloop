<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    public function getLogoUrl()
    {
        if( $this->logo )
        {
            return asset('storage/projects/' . $this->logo);
        }
        return asset('storage/projects/default.png');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
