
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
                                            <span class="reply-comment-data"  data-id="{{$comment->id}}" style="cursor: pointer" class="mt-2">
                                                                        <i class="ri-chat-1-line"></i>
                                                                        Trả lời
                                                                    </span>
                                            @can('delete-comment')
                                                <span class="ms-2 mt-2" data-id="{{$comment->id}}" style="cursor: pointer"  onclick="deleteComment(this)">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                            Xóa Comment
                                                                        </span>
                                            @endcan
                                            <hr>
                                        </div>
                                </div>
                                <div class="card-footer py-5 border-0 mt-6 mb-16 create-comment form-reply-{{$comment->id}}" style="background-color: #f8f9fa;">
                                    <div class="d-flex flex-start w-100">
                                        <div class="form-outline w-100">
                                            <input hidden="hidden" class="post-id-{{$comment->id}}" data-id="{{$comment->id}}" type="text" value="{{$post->id}}">
                                            <input hidden="hidden" class="parent-id-{{$comment->id}}" data-id="{{$comment->id}}" type="text" value="{{$comment->id}}">
                                            <input hidden="hidden" class="user-id-{{$comment->id}}" data-id="{{$comment->id}}" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" >
                                            <textarea  class="form-control textAreaExample-{{$comment->id}}"   data-id="{{$comment->id}}" rows="4"
                                                       style="background: #fff;"></textarea>
                                            <label class="form-label" for="textAreaExample">Lời bình luận</label>
                                        </div>
                                    </div>
                                    <div class="float-end mt-2 pt-3">
                                        <button  type="button" class="btn btn-primary btn-sm post-comment" data-id="{{$comment->id}}">Đăng</button>
                                        <button type="button" data-id="{{$comment->id}}" class="btn btn-outline-primary btn-sm cancel-form-{{$comment->id}} cancel-form">Cancel</button>
                                    </div>
                                </div>
                                @endif

                                @if(count($comment->replies) > 0)
                                    @foreach($comment->replies as $reply)
                                        <div class="children-comment ms-8 mt-6">
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
                                                @can('delete-comment')
                                                    <span class="ms-2 mt-2" style="cursor: pointer" data-id="{{$reply->id}}"  onclick="deleteComment(this)">
                                                                                        <i class="ri-delete-bin-line"></i>
                                                                                        Xóa Comment
                                                                                    </span>
                                                @endcan
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <hr class="my-0" />
                </div>
            </div>
        </div>
    </div>

