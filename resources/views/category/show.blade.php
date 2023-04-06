<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$category->title}}</title>
    <x-css-code-post></x-css-code-post>
</head>
<body>
<div class="edica-loader"></div>
<x-header></x-header>

<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{$category->title}}</h1>
        <section class="featured-posts-section">
            <div class="row">
                @foreach($category->posts as $post)
                    <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                        <div class="blog-post-thumbnail-wrapper">
                            <img src="{{asset('storage/' . $post->preview_image)}}" alt="blog post">
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="blog-post-category">{{$post->category->title}}</p>
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
                        </div>
                        <a href="{{route('post.index.show', $post->id)}}" class="blog-post-permalink">
                            <h6 class="blog-post-title">{{$post->title}}</h6>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

</main>

<x-footer></x-footer>
<x-current-js-code></x-current-js-code>
</body>

</html>
