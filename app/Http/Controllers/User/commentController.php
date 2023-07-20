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
            $post = Post::find($request->post_id);
            $name = User::find($request->user_id)->name;
            $userID = User::find($request->user_id)->id;
            $comments = $post->comments;

            return response()->json([
                'result' => $comments,
                'name' => $name,
                'userID' => $userID,
            ]);
        }
    }
}
