<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
    <x-css-code-post></x-css-code-post>
</head>
<body>
<x-header></x-header>

<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Категории</h1>
        <div class="row">
            <div class="col-lg-9 mx-auto" data-aos="fade-up">
                <ul class="list-group" style="margin-bottom: 150px">
                    @foreach($categories as $category)
                        <a href="{{route('category.index.show', $category->id)}}" class="list-group-item d-flex justify-content-between align-items-center" style="text-decoration: none">
                            {{$category->title}}
                            <span class="badge badge-primary badge-pill">{{$category->posts->count()}}</span>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</main>

<x-footer></x-footer>
<x-current-js-code></x-current-js-code>

</body>

</html>
