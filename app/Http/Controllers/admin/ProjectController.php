<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('admin.pages.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.addproject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project;
        if (isset($request->edit_id))
            $project = Project::where('id', $request->edit_id)->first();
        else
        {
            $project = Project::where('title', $request->title)->where('client', $request->client)->first();
            if ($project){
                $projects = Project::orderBy('created_at', 'desc')->get();
                $message = "Error! could not save project. A similar project for a similar client already exists";
                return view('admin.pages.projects', compact('message', 'projects'));
            }
            $project = new Project();
        }

        $project->title = $request->title;
        $project->client = $request->client;
        $project->scope = $request->scope;
        $project->notes = $request->notes;
        $project->order = $request->order;
        $project->publish = $request->publish;

        $project->save();

        return redirect(route('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id', $id)->first();

        if ($project){
            return view('admin.pages.addproject', compact('project'));
        }
        else
        {
            return redirect(route('projects'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Project::where('id', $request->delete_project_id)->delete();
        return redirect(route('projects'));
    }
}
