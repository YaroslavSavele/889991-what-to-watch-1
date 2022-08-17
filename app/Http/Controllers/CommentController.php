<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Film;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Responsable
     */
    public function index(Film $film)
    {
        return $this->success([
            'count' => $film->comments_count,
            'comments' => $film->comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @param Film $film
     * @return JsonResponse|Responsable
     */
    public function store(CommentStoreRequest $request, Film $film)
    {
        $film->comments()->create([
            'parent_id' => $request->comment,
            'text' => $request->text,
            'user_id' => Auth::id(),
        ]);

        return $this->success(null, 201);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->success(null, 201);
    }
}
