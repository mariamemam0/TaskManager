<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    private function resolveParent(string $type, int $id): Model
    {
        return match ($type) {
            'projects' => Project::findOrFail($id),
            'tasks'    => Task::findOrFail($id),
        };
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $type, int $id)
    {
        $parent   = $this->resolveParent($type, $id);
        $comments = $parent->comments()->paginate($this->paginate);

        if ($comments->isEmpty()) {
            return apiResponse(404, 'No comments found');
        }

        return apiResponse(200, 'success', new CommentCollection($comments));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request,string $type, int $id)
    {
        $parent  = $this->resolveParent($type, $id);
        $comment = $parent->comments()->create($request->validated());

        return apiResponse(201, 'Comment created', new CommentResource($comment));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
