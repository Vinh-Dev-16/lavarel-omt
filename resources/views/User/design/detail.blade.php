@extends('user.layout')


@section('title')
    Chi tiết {{\Illuminate\Support\Str::of($post->title)->words(6)}}
@endsection
@section('content')
    <div class= "detail-main mt-20 mb-20">
        <nav aria-label="breadcrumb breadcrumb-admin ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{\Illuminate\Support\Str::of($post->title)->words(6)}}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-8">
                <div class="detail-main-content mt-3 ms-3">
                    <div class="detail-main-content-title">
                        <h2> {{$post->title}}</h2>
                    </div>
                    <div class="detail-main-content-author">
                        <p style="color: red">{{$post->user->name}}</p>
                    </div>
                    <hr>

                    <div class="detail-content mb-16">
                       {!! $post->content !!}
                    </div>
                </div>

                <div class="bottom-detail ms-3">
                    <div class="comment-detail position-relative">
                        <div class="comment-title position-relative ms-4 mb-3">
                            <h3 class="mb-3">Để lại bình luận của bạn</h3>

                            <section>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                <button id="btn-comment" class="btn btn-primary">Bình luận ngay</button>
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
                                                        @foreach(\App\Models\Comment::where('post_id', '=', $post->id)->limit(6)->latest()->get() as $comment)

                                                        <div class="d-flex mt-3 flex-start ">
                                                            @if($comment->count() > 0)
                                                                <div>
                                                                    <h6 class="fw-bold mb-1">{{$comment->user->name}}</h6>
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <p class="mb-0">
                                                                            {{ date('d-m-Y'), strtotime($comment->created_at) }}
                                                                        </p>
                                                                    </div>
                                                                    <p class="mb-0">
                                                                        {{$comment->content}}
                                                                    </p>
                                                                    @can('delete', $comment)
                                                                        <button id="delete-comment" type="button" class="btn btn-primary btn-sm mt-2">Xóa Comment</button>
                                                                    @endcan
                                                                </div>
                                                             </div>
                                                            <hr>
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
        </div>
    </div>
@endsection


@section('javascript')

    <script>

        let btnComment = document.querySelector('#btn-comment');
        btnComment.addEventListener('click',() => {
            let createComment = document.querySelector('.create-comment');
            createComment.classList.toggle('active');
        });

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
            if (content.length > 0) {
                sendDataComment(content,userID,postID);
            } else {
                creatErrorToast('Không đuợc để trống comment')
            }
        })
        let BASE_URL = 'http://127.0.0.1:8000';

        async function sendDataComment(content,userID,postID) {
            let form = new FormData();
            form.append('user_id', `${userID}`);
            form.append('post_id', `${postID}`);
            form.append('content', `${content}`);
            const res = await fetch(`${BASE_URL}/comment/store`, {
                method: "POST",
                // headers: {
                //     "Content-Type": "application/json",
                //     "X-Requested-With": "XMLHttpRequest",
                // },
                body: form,
            })
                .then((response) => response.json())
                .then((data) => {
                    showData(data);
                })
                .catch((error) => {
                    alert(error.message);
                });
        };

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
                                if(item.user_id == data.userID){
                                    return `
                                        <button id="delete-comment" type="button" class="btn btn-primary btn-sm mt-2">Xóa Comment</button>
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
            }

        }
    </script>

@endsection
