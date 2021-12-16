<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Themes;

class ThemesController extends Controller
{
    public function addTheme(Request $request)
    {
        $theme = new Themes();
        $theme->nom = $request->nomTheme;
        $theme->save();
        return redirect('liste');
    }
    public function deleteTheme(Request $request)
    {
        $theme = Themes::find($request->nomTheme);
        $theme->delete();
        return redirect('liste');
    }
        
    
}
