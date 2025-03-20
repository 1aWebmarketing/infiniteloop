<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasUuids;

    public static $caseStatement = "CASE priority
        WHEN 'LOW' THEN 1
        WHEN 'MEDIUM' THEN 2
        WHEN 'HIGH' THEN 3
        WHEN 'CRITICAL' THEN 4
        ELSE 5 END";

    protected $guarded = [

    ];

    protected $casts = [
        'translated' => 'array',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Project, $this>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return HasMany<Comment, $this>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return HasMany<Creative, $this>
     */
    public function creatives(): HasMany
    {
        return $this->hasMany(Creative::class);
    }

    /**
     * @return mixed
     */
    public function scopeStatusInProgress($query)
    {
        return $query->where('status', 'IN_PROGRESS')
            ->orderByRaw(self::$caseStatement . ' DESC')
            ->orderByDesc('voting');
    }

    /**
     * @return mixed
     */
    public function scopeStatusCreated($query)
    {
        return $query->where('status', 'CREATED')
            ->orderByRaw(self::$caseStatement . ' DESC')
            ->orderByDesc('voting');
    }

    /**
     * @return mixed
     */
    public function scopeStatusDone($query)
    {
        return $query->where('status', 'DONE')
            ->orderByRaw(self::$caseStatement . ' DESC')
            ->orderByDesc('voting');
    }

    public function statusPillHtml(): string
    {
        return match ($this->status) {
            'CREATED' => '<span class="rounded px-2 py-1 text-sm font-bold bg-purple-100 text-purple-500">' . $this->status . '</span>',
            'IN_PROGRESS' => '<span class="rounded px-2 py-1 text-sm font-bold bg-green-100 text-green-500">' . $this->status . '</span>',
            'DONE' => '<span class="rounded px-2 py-1 text-sm font-bold bg-gray-100 text-gray-500">' . $this->status . '</span>',
        };
    }

    public function typePillHtml(): string
    {
        return match ($this->type) {
            'FEATURE' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 bg-black/40 border-blue-500 text-blue-500">' . $this->type . '</span>',
            'TASK' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 bg-black/40 border-amber-500 text-amber-500">' . $this->type . '</span>',
            'BUG' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 bg-black/40 border-red-500 text-red-500">' . $this->type . '</span>',
        };
    }

    public function priorityPillHtml(): string
    {
        return match ($this->priority) {
            'LOW' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 border-blue-500 bg-black/40 text-blue-500">' . $this->priority . '</span>',
            'MEDIUM' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 border-yellow-500 bg-black/40 text-yellow-500">' . $this->priority . '</span>',
            'HIGH' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 border-orange-500 bg-black/40 text-orange-500">' . $this->priority . '</span>',
            'CRITICAL' => '<span class="rounded px-2 py-1 text-sm font-bold border-2 border-red-500 bg-black/40 text-red-500">' . $this->priority . '</span>',
        };
    }

    public function styledStory(): string
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
