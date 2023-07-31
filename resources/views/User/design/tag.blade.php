@extends('user.layout')


@section('title')
    Tag: {{$key}}
@endsection
@section('content')

    <div class= "my-20">
        <nav aria-label="breadcrumb breadcrumb-admin ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$key}}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-8">
                <div class="tag-lable my-6 mx-6">
                    <span>
                        #
                    </span>
                    <h1>{{$key}}</h1>
                </div>
                <div class="tag-post ms-2">
                    <div class="row">
                        @foreach($tags as $tag)
                            <div class="col-md-4 ">
                                <a href="{{url('detail/'. $tag->slug)}}">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{asset('storage/image/' . $tag->avatar)}}" alt="{{$tag->title}}">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{url('detail/'. $tag->slug)}}">
                                <h3 style="font-size: 15px;">{{$tag->title}}</h3>
                                <strong style="font-size: 13px; color:black;">{{$tag->user->name}}</strong>
                                <p style="font-size: 13px; color:black;">{{$tag->short_description}}</p>
                                </a>
                            </div>
                        <hr class="my-6">
                        @endforeach
                    </div>
                </div>
                <div class="bottom-detail ms-3 mt-8">
                    <div class="comment-detail position-relative">
                        <div class="comment-title position-relative ms-4 mb-3">
                            <h3 class="mb-3">Các sản phẩm khác</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

