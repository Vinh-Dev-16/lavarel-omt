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

                            <section>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                <button id="btn-comment" class="btn btn-primary">
                                    <i class="ri-add-line me-1"></i>
                                    Bình luận ngay
                                </button>
                                    <div class="card-footer py-5 border-0 mt-6 mb-16 create-comment" style="background-color: #f8f9fa;">
                                        <div class="d-flex flex-start w-100">
                                            <div class="form-outline w-100">
                                                <input hidden="hidden" id="post-id" type="text" value="{{$post->id}}">
                                                <input hidden="hidden" id="user-id" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" >
                                                <textarea  class="form-control" id="textAreaExample" rows="4"
                                                           style="background: #fff;"></textarea>
                                                <label class="form-label" for="textAreaExample">Lời bình luận</label>
                                            </div>
                                        </div>
                                        <div class="float-end mt-2 pt-3">
                                            <button id="post-comment" type="button" class="btn btn-primary btn-sm">Đăng</button>
                                            <button id="cancel-comment" type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                @else
                                    <button class="btn btn-primary" onclick="createErrorToast('Bạn cần phải đăng nhập')">Bình luận ngay</button>
                                @endif
                                <div class="my-5 py-5 show-comment" style="background-color: #f8f9fa;">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12 col-lg-10">
                                            <div class="card text-dark">
                                                <div class="card-body p-4">
                                                    <h4 class="mb-0">Bình luận về bài viết</h4>
                                                    <p class="fw-light mb-4 pb-2">Bình luận mới nhất</p>

                                                    <div class="comment">
                                                        @foreach(\App\Models\Comment::where('post_id', '=', $post->id)->where('parent_id', 0)->limit(6)->latest()->get() as $comment)

                                                        <div class="mt-3 ">
                                                            @if($comment->count() > 0)
                                                                <div>
                                                                    <h6 class="fw-bold mb-1">{{$comment->user->name}}</h6>
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <p class="mb-0">
                                                                            {{ date('d-m-Y'), strtotime($comment->created_at) }}
                                                                        </p>
                                                                    </div>
                                                                    <p class="mb-2">
                                                                        {{$comment->content}}
                                                                    </p>
                                                                    <span id="reply-parent"  style="cursor: pointer" class="mt-2">
                                                                        <i class="ri-chat-1-line"></i>
                                                                        Trả lời
                                                                    </span>
                                                                    @can('delete-comment')
                                                                        <span class="ms-2 mt-2" style="cursor: pointer" onclick="return sendDelete({{$comment->id}})">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                            Xóa Comment
                                                                        </span>
                                                                    @endcan

                                                                    <div class="card-footer py-5 border-0 mt-6 mb-16 reply-comment-parent" style="background-color: #f8f9fa;">
                                                                        <div class="d-flex flex-start w-100">
                                                                            <div class="form-outline w-100">

                                                                                <input hidden="hidden" id="parent-id" value="{{$comment->id}}" name="parent_id">
                                                                                <textarea  class="form-control" id="textAreaParent" rows="4"
                                                                                           style="background: #fff;"></textarea>
                                                                                <label class="form-label" for="textAreaParent">Lời bình luận</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="float-end mt-2 pt-3">
                                                                            <button id="reply-comment-parent" type="button" class="btn btn-primary btn-sm">Đăng</button>
                                                                            <button id="delete-comment-parent" type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                    @if(count($comment->replies) > 0)
                                                                        @foreach($comment->replies as $reply)
                                                                        <div class="children-comment ms-6 mt-6">
                                                                            <div>
                                                                                <h6 class="fw-bold mb-1">{{$reply->user->name}}</h6>
                                                                                <div class="d-flex align-items-center mb-3">
                                                                                    <p class="mb-0">
                                                                                        {{ date('d-m-Y'), strtotime($reply->created_at) }}
                                                                                    </p>
                                                                                </div>
                                                                                <p class="mb-2">
                                                                                    {{$reply->content}}
                                                                                </p>
                                                                                <span class="btn-reply-comment"  style="cursor: pointer;">
                                                                                   <i class="ri-chat-1-line"></i>
                                                                                         Trả lời
                                                                                </span>
                                                                                @can('delete-comment')
                                                                                    <span class="ms-2 mt-2" style="cursor: pointer" onclick="return sendDelete({{$reply->id}})">
                                                                                        <i class="ri-delete-bin-line"></i>
                                                                                        Xóa Comment
                                                                                    </span>
                                                                                @endcan
                                                                            </div>
                                                                        </div>
                                                                            <div class="card-footer py-5 border-0 mt-6 mb-16 reply-comment" style="background-color: #f8f9fa;">
                                                                                <div class="d-flex flex-start w-100">
                                                                                    <div class="form-outline w-100">
                                                                                        <input hidden="hidden" value="{{$comment->id}}" name="parent_id">
                                                                                        <textarea  class="form-control textAreaReply" rows="4"
                                                                                                   style="background: #fff;"></textarea>
                                                                                        <label class="form-label" for="textAreaExample">Lời bình luận</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-end mt-2 pt-3">
                                                                                    <button type="button" class="reply-comment btn btn-primary btn-sm">Đăng</button>
                                                                                    <button  type="button" class="delete-comment btn btn-outline-primary btn-sm">Cancel</button>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                             </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <hr class="my-0" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('banner')
            <div class="col-md-3 my-6 ms-12 " >
                <div class="banner-ads right" style="min-height: 800px;">
                    <img class="mb-2" style="object-fit: cover; " src="{{asset('image/banner.png')}}" alt="banner">
                    <img class="my-2" style="object-fit: cover; " src="{{asset('image/banner-2.png')}}" alt="banner">
                    <img class="my-2 position-sticky overflow-hidden top-10" style="object-fit: cover; " src="{{asset('image/banner-1.gif')}}" alt="banner">
                </div>
            </div>
        </div>

@endsection
@section('javascript')



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

        // Comment con

        if(document.querySelector('#btn-reply-comment')) {
        let reply = document.querySelectorAll('.btn-reply-comment');
        let deleteComment = document.querySelectorAll('.delete-comment');
        let content = document.querySelectorAll('.textAreaReply');
        reply.addEventListener('click',() => {
            let replyComment = document.querySelector('.reply-comment');
            replyComment.classList.toggle('active');
        })
            deleteComment.addEventListener('click', () => {
                let replyComment = document.querySelector('.reply-comment');
                replyComment.classList.remove('active');
                textAreaExample.value = '';
            })
        }



        // Reply comment parent



        let replyParent = document.querySelector('#reply-parent');
        let deleteCommentParent = document.querySelector('#delete-comment-parent');
        let contentParent = document.querySelector('#textAreaParent');
        let replyCommentParent = document.querySelector('#reply-comment-parent');

        replyCommentParent.addEventListener('click', (e) => {
            e.preventDefault();
            let postID = document.querySelector('#post-id').value;
            let userID = document.querySelector('#user-id').value;
            let content = document.querySelector('#TextAreaParent').value;
            let parentID  = document.querySelector('#parent-id').value;

            if (content.length > 0 ) {
                replyDataComment(content,userID,postID, parentID);
            } else {
                creatErrorToast('Không đuợc để trống comment')
            }
        })

        deleteCommentParent.addEventListener('click', () => {
            let replyCommentParent = document.querySelector('.reply-comment-parent');
            replyCommentParent.classList.remove('active');
            textAreaExample.value = '';
        })


        replyParent.addEventListener('click', ()=> {
            let replyCommentParent = document.querySelector('.reply-comment-parent');
            replyCommentParent.classList.toggle('active');
        })

        async function replyDataComment(content, userID, postID, parentID) {
            let form = new FormData();
            form.append('user_id', `${userID}`);
            form.append('post_id', `${postID}`);
            form.append('content', `${content}`);
            form.append('parent_id', `${parentID}`);
            const res = await fetch(`${BASE_URL}/comment/reply`, {
                method: "POST",
                body: form,
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    createSuccessToast('Đã bình luận');
                })
                .catch((error) => {
                    alert(error.message);
                });
        }



        // Comment first

        let textAreaExample = document.querySelector('#textAreaExample');
        let cancelComment = document.querySelector('#cancel-comment');

        cancelComment.addEventListener('click', () => {
            let createComment = document.querySelector('.create-comment');
            createComment.classList.remove('active');
            textAreaExample.value = '';
        })

        let postComment = document.querySelector('#post-comment');
        postComment.addEventListener('click', () => {
            let postID = document.querySelector('#post-id').value;
            let userID = document.querySelector('#user-id').value;
            let content = textAreaExample.value;
            if (content.length > 0 ) {
                sendDataComment(content,userID,postID);
            } else {
                creatErrorToast('Không đuợc để trống comment')
            }
        })


        async function sendDataComment(content,userID,postID) {
            let form = new FormData();
            form.append('user_id', `${userID}`);
            form.append('post_id', `${postID}`);
            form.append('content', `${content}`);
            const res = await fetch(`${BASE_URL}/comment/store`, {
                method: "POST",
                body: form,
            })
                .then((response) => response.json())
                .then((data) => {
                    showData(data);
                    createSuccessToast('Đã bình luận');
                })
                .catch((error) => {
                    alert(error.message);
                });
        };

        // delete

        async function sendDelete(id) {
            const res = await fetch(`http://127.0.0.1:8000/comment/delete/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    showData(data);
                })
                .catch((error) => {
                    alert(error.message);
                });

                createSuccessToast('Đã xóa bình luận');

            return false;
        }


        function showData(data) {
            let show = '';
            if(data.result.length > 0) {
                data.result.map((item)=>{
                    let date = new Date(item.created_at);
                    let time = (date.getDate()) +
                        '-' + (date.getMonth()) +
                        '-' + date.getFullYear()
                    show +=
                        `   <div class="d-flex mt-3 flex-start ">
                             <div>
                                <h6 class="fw-bold mb-1">${data.name}</h6>
                                 <div class="d-flex align-items-center mb-3">
                                   <p class="mb-0"> ${time} </p>
                                  </div>
                                   <p class="mb-0">
                                        ${item.content}
                                   </p>
                             ${
                            (()=>{
                                if(item.user_id == data.userID || data.userID == 1){
                                    return `
                                        <span class="ms-2 mt-2" style="cursor: pointer" onclick="return sendDelete(${item.id})">
                                         <i class="ri-delete-bin-line me-1"></i>
                                        Xóa Comment
                                        </span>
                                     `
                                }else{
                                    return `
                                      `
                                }
                            })()
                             }
                             </div>

                          </div>
                         <hr>
                      `
                });
                document.querySelector('.comment').innerHTML = show;
                textAreaExample.value = '';
                let createComment = document.querySelector('.create-comment');
                createComment.classList.remove('active');
            } else {
                document.querySelector('.comment').innerHTML = '';
            }

        }
    </script>

@endsection
