<?php

namespace App\Http\Controllers;

use App\Http\Resources\LikeResource;
use App\Model\Like;
use App\Model\Question;
use App\Model\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question, Reply $reply)
    {
        return response()->json(LikeResource::collection($reply->likes), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question, Reply $reply)
    {
        $like = $reply->likes()->create(['user_id' => 1]);
        return response()->json(new LikeResource($like), Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply, Like $like)
    {
        $like->delete();
        return response()->json(new LikeResource($like), Response::HTTP_NO_CONTENT);
    }
}
