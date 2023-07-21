@extends('user.layout')

@section('title')
    Trang chủ
@endsection
@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-6">
                <div class="main-content">
                    @foreach(\App\Models\Admin\Post::whereHas('categories', function ($query) {
                        $query->where('category_id', 7);})->limit(1)->latest()->get() as $post)
                    <a href="{{url('detail/'. $post->id)}}" class="link-title-content">
                        <img class="image-title" src="{{$post->avatar}}" alt="ảnh content">
                        <h5 class="title-content">{{$post->title}}</h5>
                    </a>
                    @endforeach
                </div>
                <div class="row">
                   @foreach(\App\Models\Admin\Post::whereHas('categories', function ($query) {
                    $query->where('category_id', 5); })->whereDoesntHave('categories', function ($query) {
                   $query->where('category_id', 7);})->limit(2)->latest()->get() as $post)
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
                        <div>
                            <img src="https://genk.mediacdn.vn/zoom/260_162/139269124445442048/2023/7/10/avatar1688961579881-16889615802521138232940.jpg" alt="ảnh content">
                            <h5 class="title-content title-content-main">
                                Áo choàng tàng hình ngoài đời thực hoạt động như thế nào?
                            </h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <img  class="image-title" src=" https://genk.mediacdn.vn/zoom/80_50/139269124445442048/2023/7/8/1-16887949915352107642744-83-0-1333-2000-crop-16887958815811387130215.jpg" alt="ảnh content">
                            </div>
                            <div class="col-md-8">
                                <h5 class="right-title-content">
                                    Bằng kính hồng ngoại Euclid, khoa học sẽ lý giải hai bí ẩn mang tên vật chất tối và năng lượng tối và năng...
                                </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <img  class="image-title" src=" https://genk.mediacdn.vn/zoom/80_50/139269124445442048/2023/7/8/1-16887949915352107642744-83-0-1333-2000-crop-16887958815811387130215.jpg" alt="ảnh content">
                            </div>
                            <div class="col-md-8">
                                <h5 class="right-title-content">
                                    Bằng kính hồng ngoại Euclid, khoa học sẽ lý giải hai bí ẩn mang tên vật chất tối và năng lượng tối và năng...
                                </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <img  class="image-title" src=" https://genk.mediacdn.vn/zoom/80_50/139269124445442048/2023/7/8/1-16887949915352107642744-83-0-1333-2000-crop-16887958815811387130215.jpg" alt="ảnh content">
                            </div>
                            <div class="col-md-8">
                                <h5 class="right-title-content">
                                    Bằng kính hồng ngoại Euclid, khoa học sẽ lý giải hai bí ẩn mang tên vật chất tối và năng lượng tối và năng...
                                </h5>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-bold text-sm text-horizon">Đáng chú ý</p>
        </div>
        <div class="row mt-10">
            <div class="col-md-3 notable">
                <a href="#" class="link-title-content">
                    <img class="image-title" src="https://genk.mediacdn.vn/zoom/260_162/139269124445442048/2023/7/7/avatar1688703937660-16887039382991981642927.jpg" alt="ảnh content">
                    <h5 class=" title-content title-content-main ">Bi hài Elon Musk: Đuổi 80% nhân viên Twitter để rồi họ giúp Mark Zuckerberg tạo ra 'phiên bản copy' Threads</h5>
                </a>
            </div>
            <div class="col-md-3 notable">
                <a href="#" class="link-title-content">
                    <img class="image-title" src="https://genk.mediacdn.vn/zoom/260_162/139269124445442048/2023/7/7/avatar1688699571367-1688699571853608700839.jpg" alt="ảnh content">
                    <h5 class="title-content title-content-main">Đánh giá máy chơi game PC cầm tay ROG Ally: Thiết kế đẹp, cấu hình mạnh, chơi tốt được game nặng nhưng vẫn tồn tại vài điểm trừ</h5>
                </a>
            </div>
            <div class="col-md-3 notable">
                <a href="#" class="link-title-content">
                    <img class="image-title" src="https://genk.mediacdn.vn/zoom/260_162/139269124445442048/2023/7/7/getty-zuckerberg-musk-800x597-1688690755075-1688690755998967780835-13-0-513-800-crop-1688691011403305629175.jpg" alt="ảnh content">
                    <h5 class="title-content title-content-main">Vừa khai sinh một ngày, mạng xã hội Threads của Mark Zuckerberg đã bị Elon Musk tấn công</h5>
                </a>
            </div>
            <div class="col-md-3 notable">
                <a href="#" class="link-title-content">
                    <img class="image-title" src="https://genk.mediacdn.vn/zoom/260_162/139269124445442048/2023/7/10/avatar1688952680522-1688952681221931904389.jpg" alt="ảnh content">
                    <h5 class="title-content title-content-main">Cục Điện ảnh yêu cầu Netflix, FPT Play gỡ phim có đường lưỡi bò trong vòng 24 giờ</h5>
                </a>
            </div>
        </div>
    </div>



@endsection
