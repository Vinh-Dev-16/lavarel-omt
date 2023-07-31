@extends('user.layout')


@section('title')
    {{$category->name}} - Tin tức được cập nhật liên tục
@endsection

@section('content')
    <div class="category-page">
        <div class="category-children">
                <div class="category-children-item d-sm-flex gap-5 justify-content-start align-items-center">
                @if(\App\Models\Admin\Category::where('parent_id' , $category->id)->count() > 0)
                        <a href="{{url('category/'. $category->slug)}}" class="{{ request()->is('category/' .$category->slug) ? 'active' : '' }}">{{$category->name}}</a>
                @foreach(\App\Models\Admin\Category::where('parent_id' , $category->id)->get() as $category)
                    <a href="{{url('category/'. $category->slug)}}" class="{{ request()->is('category/' .$category->slug) ? 'active' : '' }}">{{$category->name}}</a>
                @endforeach
                @else
                    @if(\App\Models\Admin\Category::where('id', $category->parent_id)->count() > 0)
                    @foreach(\App\Models\Admin\Category::where('id', $category->parent_id)->get() as $item)
                            <a href="{{url('category/'. $item->slug)}}" class="{{ request()->is('category/'. $item->slug) ? 'active' : '' }}">{{$item->name}}</a>
                    @endforeach
                        @else
                            <a href="{{url('category/'. $category->slug)}}" class="{{ request()->is('category/'. $category->slug) ? 'active' : '' }}">{{$category->name}}</a>
                    @endif
                    @foreach(\App\Models\Admin\Category::where('parent_id', $category->parent_id)->where('parent_id', '!=', 0)->get() as $category)
                        <a href="{{url('category/'. $category->slug)}}" class="{{ request()->is('category/'. $category->slug) ? 'active' : '' }}">{{$category->name}}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
        <div class="row">
            <div class="col-sm-11">
                <div class="left-category mt-12">
                    <div class="row">
                        <div class="col-md-8">
                            @foreach($posts->where('status', 1)->sortByDesc('created_at')->take(1) as $post)
                                @if($post->is_landing == 1)
                                    <div>
                                        <a href="{{url('detail/'. $post->slug)}}" class="link-title-content">
                                            <img class="image-title" src="{{asset('storage/image/' . $post->avatar)}}" alt="ảnh content">
                                            <h5 class="title-content title-content-main">{{$post->title}}</h5>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="left-category-children">
                    <div class="row">
                    @foreach($posts->where('status', 1)->sortByDesc('created_at')->take(2) as $post)
                        @if($post->is_landing == 0)
                            <div class="col-sm-4">
                            <a href="{{url('detail/'. $post->slug)}}" class="link-title-content">
                                <img class="image-title" src="{{asset('storage/image/' . $post->avatar)}}" alt="ảnh content">
                                <h5 class="title-content title-content-main">{{$post->title}}</h5>
                            </a>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="right-category">
                    @foreach($posts->where('status', 1)->take(3)->sortByDesc('created_at')->skip(3) as $post)
                        <div>
                            <img src="{{asset('storage/image/' . $post->avatar)}}" alt="ảnh content">
                            <h5 class="title-content title-content-main">
                                {{$post->title}}
                            </h5>
                        </div>
                        <hr>
                    @endforeach
                    <div>

                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
@endsection

