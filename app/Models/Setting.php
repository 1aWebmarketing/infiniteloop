<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'team_id',
        'key',
        'value',
    ];

    public static function get($key, $default = null, $teamId = null)
    {
        return self::where('key', $key)->where('team_id', $teamId)->value('value') ?? $default;
    }

    public static function set($key, $value, $teamId = null)
    {
        return self::updateOrCreate([
            'key' => $key,
            'team_id' => $teamId,
        ], [
            'value' => $value,
        ]);
    }
}
