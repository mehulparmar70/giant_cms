<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['name', 'directory', 'is_active'];

    public static function activateTheme($themeId)
    {
        self::where('is_active', true)->update(['is_active' => false]);
        return self::where('id', $themeId)->update(['is_active' => true]);
    }

    public static function getActiveTheme()
    {
        return self::where('is_active', true)->first();
    }
}
