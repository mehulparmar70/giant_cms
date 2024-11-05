<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Theme;

class CheckActiveTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if any theme is active
        $activeTheme = Theme::where('is_active', true)->first();

        if (!$activeTheme) {
            // If no theme is active, redirect to theme selection
            return redirect()->route('theme.selection');
        }

        // Pass the active theme to the view
        view()->share('activeTheme', $activeTheme);

        return $next($request);
    }
}
