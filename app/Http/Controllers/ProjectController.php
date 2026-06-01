<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //  dd(Project::active()->get());
          $projects = Project::select('id','name','description','user_id','slug')->with('user','tasks')
              ->paginate($this->paginate);
          if($projects->isEmpty()){
              return apiResponse(404,'projects not found');
    }
          return apiResponse(200,'success',new ProjectCollection($projects));

    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::create($data);
        return apiResponse(201 ,'Success',new ProjectResource($project));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('comments');

        return apiResponse(200,'success',new ProjectResource($project));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return apiResponse(200,'success',new ProjectResource($project));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return apiResponse(200,'Project deleted');
    }
}
