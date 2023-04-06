<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->title}}</title>
    <x-css-code-post></x-css-code-post>
</head>
<body>
<div class="edica-loader"></div>
<x-header></x-header>

<main class="blog-post">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{$post->title}}</h1>
        <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{$date->translatedFormat('F')}} {{$date->day}}, {{$date->year}} • {{$date->format('H:i')}}• {{$post->comments()->count()}} Комментариев</p>
        <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
            <div class="row">
                <div class="col-lg-9 mx-auto" data-aos="fade-up">
                    <img src="{{asset('storage/' . $post->main_image)}}" alt="featured image" class="w-100">
                </div>
            </div>
        </section>
        <section class="post-content">
            <div class="row">
                <div class="col-lg-9 mx-auto" data-aos="fade-up">
                    {!! $post->content !!}
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-lg-9 mx-auto">

                <section class="py-3">
                    @auth('web')
                        <form action="{{route('post.like.store', $post->id)}}" method="post">
                        @csrf
                            <span>{{$post->liked_users_count}}</span>
                            <button type="submit" class="border-0 bg-transparent">
                                @if(Auth::user()->likedPosts->contains($post->id))
                                    <i class="fas fa-solid fa-heart"></i>
                                @else
                                    <i class="far fa-solid fa-heart"></i>
                                @endif
                            </button>
                        </form>
                    @endauth
                        @guest('web')
                            <div>
                                <span>{{$post->liked_users_count}}</span>
                                <i class="far fa-solid fa-heart"></i>
                            </div>
                        @endguest
                </section>
                </div>
            </div>
        <section class="comment-list mb-5">
            <div class="row">
                <div class="col-lg-9 mx-auto" data-aos="fade-up">
                    <h2 class="section-title mb-5" data-aos="fade-up">Комментарии({{$post->comments->count()}})</h2>
                </div>
            </div>

            @foreach($post->comments as $comment)
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        <div class="comment-text mb-3">
                            <span class="username">
                                <div class="font-weight-bold">
                                {{$comment->user->name}}
                                </div>
                                <span class="text-muted float-right">{{$comment->DateAsCarbon->diffForHumans()}}
                            </span>
                        </span><!-- /.username -->
                            {{$comment->message}}
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                @if($relatedPosts->count() > 0)
                <section class="related-posts">
                    <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                    <div class="row blog-post-row">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-4 blog-post" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{asset('storage/' . $relatedPost->preview_image)}}" alt="related post" class="post-thumbnail">
                                <p class="post-category">{{$relatedPost->category->title}}</p>
                                <a href="{{route('post.index.show', $relatedPost->id)}}"><h5 class="post-title">{{$relatedPost->title}}</h5></a>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif
                @auth('web')
                <section class="comment-section">
                    <h2 class="section-title mb-5" data-aos="fade-up">Отправить комментарий</h2>
                    <form action="{{route('post.comment.store', $post->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12" data-aos="fade-up">
                                <label for="comment" class="sr-only">Comment</label>
                                <textarea name="message" id="comment" class="form-control" placeholder="Напиши комментарий!" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" data-aos="fade-up">
                                <input type="submit" value="Добавить" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </section>
                @endauth
            </div>
        </div>
    </div>
</main>

<x-footer></x-footer>
<x-current-js-code></x-current-js-code>
</body>

</html>
