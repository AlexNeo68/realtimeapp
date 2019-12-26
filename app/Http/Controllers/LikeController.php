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
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function like(Reply $reply)
    {
        $like = $reply->likes()->create(['user_id' => auth()->id()]);
        return response()->json(new LikeResource($like), Response::HTTP_CREATED);
    }

    public function unlike(Reply $reply)
    {
        $like = $reply->likes()->where('user_id', auth()->id())->first();
        $like->delete();
        return response()->json(new LikeResource($like), Response::HTTP_NO_CONTENT);
    }
}
