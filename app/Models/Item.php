<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'story',
        'priority',
        'type',
        'voting'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function typePillHtml()
    {
        return match($this->type){
            'FEATURE' => '<span class="rounded px-2 py-1 text-sm font-bold bg-blue-100 text-blue-500">' . $this->type . '</span>',
            'TASK' => '<span class="rounded px-2 py-1 text-sm font-bold bg-amber-100 text-amber-500">' . $this->type . '</span>',
            'BUG' => '<span class="rounded px-2 py-1 text-sm font-bold bg-red-100 text-red-500">' . $this->type . '</span>',
        };
    }

    public function priorityPillHtml()
    {
        return match($this->priority){
            'LOW' => '<span class="rounded px-2 py-1 text-sm font-bold bg-blue-100 text-blue-500">' . $this->priority . '</span>',
            'MEDIUM' => '<span class="rounded px-2 py-1 text-sm font-bold bg-yellow-100 text-yellow-500">' . $this->priority . '</span>',
            'HIGH' => '<span class="rounded px-2 py-1 text-sm font-bold bg-orange-100 text-orange-500">' . $this->priority . '</span>',
            'CRITICAL' => '<span class="rounded px-2 py-1 text-sm font-bold bg-red-100 text-red-500">' . $this->priority . '</span>',
        };
    }

    public function styledStory()
    {
        return <<<"HTML"
            <div class="userstory">
                $this->story
            </div>
            <style>
                .userstory h1{
                    font-size: 2em;
                }
                .userstory h2{
                    font-size: 1.5em;
                    font-weight: bold;
                    margin-top: 20px;
                }

                .userstory ul{
                    list-style: disc;
                    padding-left: 1em;
                    margin: 10px 0;
                }
            </style>
        HTML;
    }
}
