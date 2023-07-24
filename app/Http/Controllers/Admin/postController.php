<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class postController extends Controller
{



    protected function resourceAbilityMap(): array
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index()
    {
            $posts = Post::paginate(6);
            Session::put('posts_url', request()->fullUrl());
            return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        return view ('admin.post.create', compact('categories'));
    }


    public function store(Request $request)
      {
        if ($request->isMethod('POST')) {
            $rules = [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'avatar' => 'required',
                'short_description' => 'required',
                'is_landing' => 'required',

            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }
        try {
            $input = $request->all();
            unset($input['_token']);
            unset($input['category_id']);
            $post = Post::create($input);
            $post->categories()->attach($request->input('category_id'));
            if (Session::get('post_url')) {
                return redirect(session('post_url'))->with('success', 'Đã thêm post thành công');
            } else {
                return redirect('admin/post/index')->with('success', 'Đã thêm post thành công');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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


    public function edit($id)
    {
        $post= Post::find($id);
        $categories = Category::all();
        $selectedID = $post->categories->pluck('id')->toArray();
        $this->authorize('update', $post);
        return view('admin.post.edit', compact('post','categories','selectedID'));
    }


    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'avatar' => 'required',
                'author' => 'required',
                'short_description' => 'required',
                'is_landing' => 'required',
            ];
            $messages = [
                'required' => 'Không được để trống trường này',
            ];
            $request->validate($rules, $messages);
        }
//        try {
            $post = Post::find($id);
            $input = $request->all();
            unset($input['_token']);
            unset($input['category_id']);
            $post->update($input);
            $post->categories()->sync($request->input('category_id'));
            if (Session::get('post_url')) {
                return redirect(session('post_url'))->with('success', 'Đã sửa post thành công');
            } else {
                return redirect('admin/post/index')->with('success', 'Đã sửa post thành công');
            }
//        }catch (\Exception $e) {
//            return redirect()->back()->with('error', $e->getMessage());
//        }
    }


    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            $this->authorize('delete', $post);
            $post->delete();
            if (Session::get('post_url')) {
                return redirect(session('post_url'))->with('success', 'Đã xóa post thành công');
            } else {
                return redirect('admin/post/index')->with('success', 'Đã xóa post thành công');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function restore() {
        $posts = Post::onlyTrashed()->paginate(6);
        return view('admin/post/restore', compact('posts'));
    }

    public function startRestore($id): \Illuminate\Http\RedirectResponse
    {
        Post::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Đã restore thành công');
    }

    public function delete($id){
        $post = Post::onlyTrashed()->find($id);
        $post->categories()->detach();
        $post->forceDelete();
        $this->authorize('delete', $post);
        return back()->with('success', 'Đã xóa product thành công');
    }
}
