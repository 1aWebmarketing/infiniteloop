<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'description',
        'template'
    ];

    public function getLogoUrl()
    {
        if( $this->logo )
        {
            return asset('storage/' . $this->logo);
        }
        return asset('images/project-default.png');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
