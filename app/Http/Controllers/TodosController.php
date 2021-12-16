<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;
use App\Models\Themes;
use Session;

class TodosController extends Controller
{

    //Liste
    public function liste()
    {
        return view("layouts.home", ["todos" => Todos::all()], ["themes" => Themes::all()]);
    }
    public function listeParTheme($theme)
    {
        return view("layouts.home", ["themes" => Themes::all()], ["todos" => Todos::where('theme', $theme)->get()]);
    }
    public function add()
    {
        return view("form");
    }

    public function store(Request $request)
    {
        $todo = new Todos();

        $todo->texte = $request->texte;
        $todovalue = $request->termine != null ? 1 : 0;
        $todoImporant = $request->important != null ? 1 : 0;
        $todo->important = $todoImporant;
        $todo->termine = $todovalue;
        $todo->theme = $request->theme;
        $todo->save();
        Session::flash('message', 'Note Ajouté !');
        Session::flash('alert-class', 'alert-Success');
     
        if ($todo->theme != null) {
            return redirect()->route("listeParTheme", ["theme" => $todo->theme]);
        } else {
            return redirect()->route("liste");
        }
    }

    public function delete($id)
    {
        if (Todos::find($id)->termine) {
            Todos::destroy($id);
            Session::flash('message', 'Note Supprimer !');
            Session::flash('alert-class', 'alert-Danger');
    
        }else{
        
        Session::flash('message', "Votre note doit d'abords etre terminer !");
        Session::flash('alert-class', 'alert-warning');
    }
        return redirect()->route("liste");
    }
    public function setTermine($id)
    {
        $todo = Todos::find($id);
        $todo->termine = $todo->termine == 1 ? 0 : 1;
        $todo->save();

        if ($todo->theme != null) {
            return redirect()->route("listeParTheme", ["theme" => $todo->theme]);
        } else {
            return redirect()->route("liste");
        }
    }
    public function update(Request $request, $id)
    {
        $todo = Todos::find($id);
        $todo->texte = $request->noteTexte;
        $todo->save();

        if ($todo->theme != null) {
            return redirect()->route("listeParTheme", ["theme" => $todo->theme]);
        } else {
            return redirect()->route("liste");
        }
    }
    public function important($id){
        $todo = Todos::find($id);
        $todo->important = $todo->important == 1 ? 0 : 1;
        $todo->save();

        if ($todo->theme != null) {
            return redirect()->route("listeParTheme", ["theme" => $todo->theme]);
        } else {
            return redirect()->route("liste");
        }

    }
    public function compteurListe(){
        // return view compteur with todos that are termine
        return view("compteur", ["todos" => Todos::where('termine', 0)->get(),"numberOfTodos" => Todos::where('termine', 0)->count()]);

    }
}
