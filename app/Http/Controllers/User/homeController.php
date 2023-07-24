<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.design.home');
    }

    public function detail($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $post = Post::find($id);
        return  view('user.design.detail', compact('post'));
    }

    public function category($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::find($id);

        $relatedCategories = Category::where('parent_id', $category->id)->get();

        $categoryItem = $relatedCategories->isNotEmpty() ? $relatedCategories : collect([$category]);

        $categoryIds = $categoryItem->pluck('id')->toArray();

        $posts = Post::whereHas('categories', function ($query) use ($categoryIds) {
        $query->where('category_id' , $categoryIds); })->get();
        return view('user.design.category', compact('category', 'categoryItem', 'posts'));
    }
}
