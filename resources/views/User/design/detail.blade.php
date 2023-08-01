@extends('user.layout')


@section('title')
    Chi tiết {{\Illuminate\Support\Str::of($post->title)->words(6)}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 my-6 left">
            <nav aria-label="breadcrumb breadcrumb-admin ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        @foreach($post->categories as $category)
                            <a href="{{url('category/' . $category->slug)}}">{{$category->name}}</a>
                        @endforeach
                    </li>
                </ol>
            </nav>
            <div class="detail-main-content mt-3 ms-3" >
                <div class="detail-main-content-title">
                    <h2> {{$post->title}}</h2>
                </div>
                <div class="detail-main-content-author">
                    <p style="color: red">{{$post->user->name}}</p>
                </div>
                <hr>

                <div class="detail-content mb-6">
                    {!! $post->content !!}
                </div>

                <div class="detail-tags mb-9">
                        <span>
                            <i class="ri-price-tag-3-line text-xl-start"></i>
                            <span>Tags</span>
                        </span>
                    <br>
                    <br>
                    @if(!(empty($post->tags)))
                        @php
                            $tags = [];
                            $tags = explode(',', $post->tags);
                        @endphp
                        @foreach($tags as $key=>$tag)
                            <a class="tag-link" href="{{url('tag/'.$tag)}}" class="me-2">{{$tag}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="bottom-detail ms-3 mt-8">
                <div class="comment-detail position-relative">
                    <div class="comment-title position-relative ms-4 mb-3">
                        <h3 class="mb-3">Để lại bình luận của bạn</h3>
                        <section id="comment">
                         @include('user.design.comment', ['comment' => $post->comments])
                        </section>
                    </div>
                </div>
            </div>

        </div>


        @endsection

        @section('banner')
            <div class="col-md-3 my-6 ms-12 " >
                <div class="banner-ads right hide-mobile" style="min-height: 800px;">
                    <img class="mb-2" style="object-fit: cover; " src="{{asset('image/banner.png')}}" alt="banner">
                    <img class="my-2" style="object-fit: cover; " src="{{asset('image/banner-2.png')}}" alt="banner">
                    <img class="my-2 position-sticky overflow-hidden top-10" style="object-fit: cover; " src="{{asset('image/banner-1.gif')}}" alt="banner">
                </div>
            </div>
    </div>

@endsection
@section('javascript')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $('#post-comment').click(function(ev){
            ev.preventDefault();
            let content = $('#textAreaExample').val();
            let postID = $('#post-id').val();
            let userID = $('#user-id').val();
            let _csrf = '{{ csrf_token() }}';
            if(content.length > 0){
                $.ajax({
                    url: "http://127.0.0.1:8000/comment/store",
                    type: "POST",
                    data: {
                        post_id: postID,
                        user_id: userID,
                        content: content,
                        _token: _csrf
                    },
                    success: function(response){
                        createSuccessToast('Đã bình luận')
                        $('#comment').html(response);
                        $('#textAreaExample').val('');
                    }
                });
            }else {
                createErrorToast('Không được để trống bình luận');
            }

        });

        function deleteComment(element) {
            let commentId = $(element).data('id');

            $.ajax({
                url: `http://127.0.0.1:8000/comment/delete/${commentId}`,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(data) {
                    createSuccessToast('Đã xóa bình luận')
                    $('#comment').html(data);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        $('.btn-reply-comment').click(function(ev) {
            ev.preventDefault();
            let id = $(this).data('id');
        });

        $(document).on('click', '.reply-comment-data',function(ev) {
            ev.preventDefault();
            let id = $(this).data('id');
            let formReply = '.form-reply-' +id;
            $('.create-comment').slideUp();

            $(formReply).slideDown();


        });

        $(document).on('click', '.cancel-form',function(ev) {
            ev.preventDefault();
            let id = $(this).data('id');
            let formCancel = '.form-reply-' +id;
            $(formCancel).slideUp();
        });

        $(document).on('click', '.post-comment', function(ev) {
            ev.preventDefault();
            let id = $(this).data('id');
            let commentReplyId = '.textAreaExample-'+id;
            let commentReply = $(commentReplyId).val();
            let postReplyID = '.post-id-'+id;
            let postReply = $(postReplyID).val();
            let userReplyID = '.user-id-'+id;
            let userReply = $(userReplyID).val();
            let parentReplyID = '.parent-id-'+id;
            let parentReply = $(parentReplyID).val();
            let _csrf = '{{ csrf_token() }}';
            if(commentReply.length > 0){
                $.ajax({
                    url: "http://127.0.0.1:8000/comment/store",
                    type: "POST",
                    data: {
                        post_id: postReply,
                        user_id: userReply,
                        content: commentReply,
                        parent_id: parentReply,
                        _token: _csrf,
                    },
                    success: function(response){
                        createSuccessToast('Đã bình luận')
                        $('#comment').html(response);
                        $('#textAreaExample').val('');
                    }
                });
            }else {
                createErrorToast('Không được để trống bình luận');
            }
        });
    </script>
    <script>

        document.addEventListener("DOMContentLoaded", function() {
            // Lấy chiều cao của layout left
            var leftElement = document.querySelector(".left");
            var leftHeight = leftElement.offsetHeight;

            // Gán chiều cao của layout left cho layout right
            var rightElement = document.querySelector(".right");
            rightElement.style.height = leftHeight + "px";

            // Đảm bảo rằng chiều cao của layout right sẽ được cập nhật khi kích thước trình duyệt thay đổi
            window.addEventListener("resize", function() {
                leftHeight = leftElement.offsetHeight;
                rightElement.style.height = leftHeight + "px";
            });
        });


        let BASE_URL = 'http://127.0.0.1:8000';
        let btnComment = document.querySelector('#btn-comment');
        btnComment.addEventListener('click',() => {
            let createComment = document.querySelector('.create-comment');
            createComment.classList.toggle('active');
        });


{{--        // Comment first--}}

{{--        let textAreaExample = document.querySelector('#textAreaExample');--}}
        let cancelComment = document.querySelector('#cancel-comment');

        cancelComment.addEventListener('click', () => {
            let createComment = document.querySelector('.create-comment');
            createComment.classList.remove('active');
            textAreaExample.value = '';
        })

{{--        let postComment = document.querySelector('#post-comment');--}}
{{--        postComment.addEventListener('click', () => {--}}
{{--            let postID = document.querySelector('#post-id').value;--}}
{{--            let userID = document.querySelector('#user-id').value;--}}
{{--            let content = textAreaExample.value;--}}
{{--            if (content.length > 0 ) {--}}
{{--                sendDataComment(content,userID,postID);--}}
{{--            } else {--}}
{{--                creatErrorToast('Không đuợc để trống comment')--}}
{{--            }--}}
{{--        })--}}


{{--        async function sendDataComment(content,userID,postID) {--}}
{{--            let form = new FormData();--}}
{{--            form.append('user_id', `${userID}`);--}}
{{--            form.append('post_id', `${postID}`);--}}
{{--            form.append('content', `${content}`);--}}
{{--            const res = await fetch(`${BASE_URL}/comment/store`, {--}}
{{--                method: "POST",--}}
{{--                body: form,--}}
{{--            })--}}
{{--                .then((response) => response.json())--}}
{{--                .then((data) => {--}}
{{--                    showData(data);--}}
{{--                    createSuccessToast('Đã bình luận');--}}
{{--                })--}}
{{--                .catch((error) => {--}}
{{--                    alert(error.message);--}}
{{--                });--}}
{{--        };--}}

{{--        // delete--}}

{{--        async function sendDelete(id) {--}}
{{--            const res = await fetch(`http://127.0.0.1:8000/comment/delete/${id}`)--}}
{{--                .then((response) => response.json())--}}
{{--                .then((data) => {--}}
{{--                    showData(data);--}}
{{--                })--}}
{{--                .catch((error) => {--}}
{{--                    alert(error.message);--}}
{{--                });--}}

{{--            createSuccessToast('Đã xóa bình luận');--}}

{{--            return false;--}}
{{--        }--}}


{{--        function showData(data) {--}}
{{--                document.querySelector('#comment').innerHTML = data;--}}
{{--                textAreaExample.value = '';--}}
{{--                let createComment = document.querySelector('.create-comment');--}}
{{--                createComment.classList.remove('active');--}}
{{--        }--}}
    </script>

@endsection
