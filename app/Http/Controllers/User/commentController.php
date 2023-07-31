<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Comment::create($data);
            $postID = Post::find($request->post_id)->id;
            $name = User::find($request->user_id)->name;
            $userID = User::find($request->user_id)->id;
            $comments = Comment::where('post_id',$postID)->limit(6)->latest()->get();

            return response()->json([
                'result' => $comments,
                'name' => $name,
                'userID' => $userID,
            ]);
        }
    }


    public function reply(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Comment::create($data);
            $post = Post::where('id', $request->post_id)->with('user:id,name' ,
                'comments.replies',
                'user:id,name',
                'comments.user:id,name',
                'comments.replies.user:id,name')->first();
            $post->toArray();

            return response()->json(
                [
                    'posts' => $post,
                ]
            );
        }
    }
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $comment = Comment::find($id);
        $post = Post::where('id', $comment->post_id)->first();
        $comment->delete();
        $postID = $post->id;
        $comments = Comment::where('post_id',$postID)->limit(6)->latest()->get();
        $userID = auth()->user()->id;
        $name = auth()->user()->name;

        return response()->json([
            'result' => $comments,
            'userID' => $userID,
            'name' => $name,
            'status' => 'success',
        ]);
    }
}
