<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\Project;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{

    // GET /projects/{project}/users\
    public function index(Project $project)
    {
        $users = $project->users()->get();
        return apiResponse(200,'success',new UserCollection($users));
    }

    public function store()
    {

    }


    public function destroy()
    {

    }

}
