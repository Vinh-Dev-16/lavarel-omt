@extends('user.layout')

@section('title')
Kết quả tìm kiếm cho: {{$key}}
@endsection
@section('content')
<div class="container mt-20" style="background-color: white">
    <h2 style="color: red; text-align:center; padding-top: 20px">Kết quả tìm kiếm của: {{$key}}</h2>
    <div class="row my-10">
        @foreach($searches as $search)
        <div class="col-sm-3">
            <a href="{{url('detail/' . $search->id)}}" class="link-title-content">
                <img class="image-title" src="{{asset('storage/image/' . $search->avatarlay)}}" alt="ảnh content">
                <h5 class=" title-content title-content-main ">{{$search->title}}</h5>
            </a>
        </div>
        @endforeach
    </div>
@endsection

