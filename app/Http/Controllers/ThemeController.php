<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function index()
    {
        // Show available themes
        $themes = Theme::all();
        return view('theme-selection', compact('themes'));
    }
    
    public function installTheme(Request $request)
    {
        // Logic to upload and install theme
        $themeName = $request->input('name');
        $directory = $request->input('directory');
        
        $theme = Theme::create([
            'name' => $themeName,
            'directory' => $directory,
        ]);

        return response()->json(['status' => 'success', 'theme' => $theme]);
    }

    public function activateTheme($id)
    {
        Theme::activateTheme($id);
        return redirect()->back()->with('success', 'Theme activated successfully.');
    }

    public function listThemes()
    {
        $themes = Theme::all();
        return view('admin.themes.index', compact('themes'));
    }
}
