<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderby('id', 'desc')->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida i dati del form
        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'slug' => 'required|string',
            'type_id' => 'nullable|exists:types,id',

        ]);

        // Crea un nuovo progetto
        $project = new Project;
        $project->name = $request->input('name');
        $project->title = $request->input('title');
        $project->content = $request->input('content');
        $project->slug = $request->input('slug');
        $project->type_id = $request->input('type_id');
        // Salva il progetto nel database
        $project->save();

        return redirect()->route('admin.projects.show', $project)
            ->with('message', 'Progetto creato con successo.')
            ->with('message_type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *  *@return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // Valida i dati del form
        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'slug' => 'required|string',
            'type_id' => 'nullable|exists:types,id',


        ]);

        // Aggiorna i dati del progetto con i nuovi dati
        $project->name = $request->input('name');
        $project->title = $request->input('title');
        $project->content = $request->input('content');
        $project->slug = $request->input('slug');
        $project->type_id = $request->input('type_id');
        $project->save();

        return redirect()->route('admin.projects.show', $project)
            ->with('message', 'Progetto aggiornato con successo.')
            ->with('message_type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *  * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // Elimina il progetto dal database
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('message', 'Progetto eliminato con successo.')
            ->with('message_type', 'success');
    }
}
