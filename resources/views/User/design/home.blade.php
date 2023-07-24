@extends('user.layout')

@section('title')
    Trang chủ
@endsection
@section('content')

    <div class="container mt-20">
        <div class="row">
            <div class="col-sm-6">
                <div class="main-content">
                    @foreach(\App\Models\Admin\Post::where('is_landing', 1)->limit(1)->latest()->get() as $post)
                    <a href="{{url('detail/'. $post->id)}}" class="link-title-content">
                        <img class="image-title" src="{{$post->avatar}}" alt="ảnh content">
                        <h5 class="title-content">{{$post->title}}</h5>
                    </a>
                    @endforeach
                </div>
                <div class="row">
                   @foreach(\App\Models\Admin\Post::whereHas('categories', function ($query) {
                    $query->where('category_id', 5); })->where('is_landing', 0)->limit(2)->latest()->get() as $post)
                    <div class="col-md-6 col-sm-12 category-movie">
                        <a href="{{url('detail/'. $post->id)}}" class="link-title-content">
                            <img class="image-title" src="{{$post->avatar}}" alt="ảnh content">
                            <h5 class="title-content title-content-main">{{$post->title}}</h5>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-lg-6 right-content-main">
                        @foreach(\App\Models\Admin\Post::whereHas('categories', function ($query) {
                     $query->where('category_id', 2); })->where('is_landing', 0)->limit(2)->latest()->get() as $post)
                        <div>
                            <img src="{{$post->avatar}}" alt="ảnh content">
                            <h5 class="title-content title-content-main">
                                {{$post->title}}
                            </h5>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-bold text-sm text-horizon">Đáng chú ý</p>
        </div>
        <div class="row mt-10">
            @foreach(\App\Models\Admin\Post::limit(4)->latest()->get() as $post)
            <div class="col-md-3 notable">
                <a href="{{url('detail/' . $post->id)}}" class="link-title-content">
                    <img class="image-title" src="{{$post->avatar}}" alt="ảnh content">
                    <h5 class=" title-content title-content-main ">{{$post->title}}</h5>
                </a>
            </div>
            @endforeach
        </div>
    </div>



@endsection
