<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public static $caseStatement = "CASE priority
        WHEN 'LOW' THEN 1
        WHEN 'MEDIUM' THEN 2
        WHEN 'HIGH' THEN 3
        WHEN 'CRITICAL' THEN 4
        ELSE 5 END";

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'story',
        'translated',
        'status',
        'priority',
        'type',
        'voting'
    ];

    protected $casts = [
        'translated' => 'array',
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

    public function scopeStatusInProgress($query)
    {
        return $query->where('status', 'IN_PROGRESS')
             ->orderByRaw(self::$caseStatement . ' DESC')
             ->orderByDesc('voting');
    }

    public function scopeStatusCreated($query)
    {
        return $query->where('status', 'CREATED')
             ->orderByRaw(self::$caseStatement . ' DESC')
             ->orderByDesc('voting');
    }

    public function scopeStatusDone($query)
    {
        return $query->where('status', 'DONE')
             ->orderByRaw(self::$caseStatement . ' DESC')
             ->orderByDesc('voting');
    }

    public function statusPillHtml()
    {
        return match($this->status){
            'CREATED' => '<span class="rounded px-2 py-1 text-sm font-bold bg-purple-100 text-purple-500">' . $this->status . '</span>',
            'IN_PROGRESS' => '<span class="rounded px-2 py-1 text-sm font-bold bg-green-100 text-green-500">' . $this->status . '</span>',
            'DONE' => '<span class="rounded px-2 py-1 text-sm font-bold bg-gray-100 text-gray-500">' . $this->status . '</span>',
        };
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
                    font-size: 1.7em;
                    font-weight: bold;
                    margin-top: 20px;
                    margin-bottom: 10px;
                }

                .userstory ul{
                    list-style: disc;
                    padding-left: 1em;
                    margin: 10px 0;
                }

                .userstory p{
                    margin: 10px 0;
                }
            </style>
        HTML;
    }
}
