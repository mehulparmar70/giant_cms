<?php
namespace App\Providers;

use App\Models\Theme;
use Illuminate\Support\Facades\Schema; // Add this line
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Check if the 'themes' table exists before querying it
        if (Schema::hasTable('themes')) {
            $activeTheme = Theme::getActiveTheme();
            if ($activeTheme) {
                $themePath = resource_path("themes/{$activeTheme->directory}/views");
    
                // Add the theme view path as the primary location
                View::addNamespace('theme', $themePath);
            }
        }

        // Default views fall back to resources/views
        View::addNamespace('theme', resource_path('views'));
    }
}
