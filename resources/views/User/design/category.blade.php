@extends('user.layout')


@section('title')
    {{$category->name}} - Tin tức được cập nhật liên tục
@endsection

@section('content')
    <div class="category-page">
        <div class="category-children container">
                <div class="category-children-item d-sm-flex gap-5 justify-content-start align-items-center">
                @if(\App\Models\Admin\Category::where('parent_id' , $category->id)->count() > 0)
                @foreach(\App\Models\Admin\Category::where('parent_id' , $category->id)->get() as $index=>$category)
                    <?php    $isActive = $index === 0 ? 'active' : ''; ?>
                    <a href="{{url('category/'. $category->id)}}" class="{{$isActive}}">{{$category->name}}</a>
                @endforeach
                @else
                    @foreach(\App\Models\Admin\Category::where('parent_id', $category->parent_id)->where('parent_id', '!=', 0)->get() as $category)
                        <a href="{{url('category/'. $category->id)}}" class="{{ request()->is('category/'. $category->id) ? 'active' : '' }}">{{$category->name}}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="left-category mt-12">
                    @foreach($posts as $item)
                        @if($item->is_landing == 1)
                        <a href="{{url('detail/'. $item->id)}}" class="link-title-content">
                            <img class="image-title" src="{{$item->avatar}}" alt="ảnh content">
                            <h5 class="title-content">{{$item->title}}</h5>
                        </a>
                        @endif
                    @endforeach
                </div>
                <div class="left-category-children">
                    <div class="row">
                    @foreach($posts->take(2)->sortByDesc('created_at') as $post)
                        @if($post->is_landing == 0)
                            <div class="col-sm-6">
                            <a href="{{url('detail/'. $post->id)}}" class="link-title-content">
                                <img class="image-title" src="{{$post->avatar}}" alt="ảnh content">
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
                    @foreach($posts->take(3)->sortByDesc('created_at')->skip(3) as $post)
                        <div>
                            <img src="{{$post->avatar}}" alt="ảnh content">
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

