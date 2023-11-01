<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
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
        $projects = Project::orderby('id', 'desc')->paginate(10);
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
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // Valida i dati del form
        // $request->validate([
        //     'name' => 'required|string',
        //     'title' => 'required|string',
        //     'content' => 'required|string',
        //     'slug' => 'required|string',
        //     'type_id' => 'nullable|exists:types,id',
        // 'technologies' => ['nullable', 'exists:technologies,id'],

        // ]);

        // Crea un nuovo progetto
        $project = new Project;
        $project->name = $request->input('name');
        $project->title = $request->input('title');
        $project->content = $request->input('content');
        $project->slug = $request->input('slug');
        $project->type_id = $request->input('type_id');
        // Salva il progetto nel database
        $project->save();


        // Associa le tecnologie al progetto
        if ($request->has('technologies')) {
            $project->technologies()->attach($request->input('technologies'));
        }

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
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *  * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        // Aggiorna i dati del progetto con i nuovi dati
        $data = $request->validated();

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->input('technologies'));
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)
            ->with('message', 'Progetto aggiornato con successo.')
            ->with('message_type', 'success');
    }

    /**
     * SoftDelete the specified resource from storage.
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

    /**
     * Display a listing of the deleted resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::orderby('id', 'desc')->onlyTrashed()->paginate(10);
        return view('admin.projects.trash.index', compact('projects'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     *  * @return \Illuminate\Http\Response
     */
    public function forceDestroy(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();
        // Elimina il progetto dal database
        $project->forceDelete();

        return redirect()->route('admin.projects.trash.index')
            ->with('message', 'Progetto eliminato con successo.')
            ->with('message_type', 'success');
    }


    /**
     * Restore the specified resource from storage.
     *
     * @param  Project $project
     *  * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        // Elimina il progetto dal database
        $project->restore();

        return redirect()->route('admin.projects.trash.index')
            ->with('message', 'Progetto ripristinato con successo.')
            ->with('message_type', 'success');
    }
}
