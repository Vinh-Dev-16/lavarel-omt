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
            $comments = Comment::create($data);
            if($comments) {
            $post = Post::find($request->post_id);
            return view('user.design.comment' , compact('comments', 'post'));
            }
            return response()->json([
                'result' => $comments,
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
    public function delete($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $comment = Comment::find($id);
        $postID = $comment->post_id;
        $post = Post::find($postID);
        $comment->delete();
        $comments = Comment::all();
        return view('user.design.comment' , compact('comments', 'post'));
    }
}
