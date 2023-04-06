<div class="edica-loader"></div>
<header class="edica-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <img src="{{asset('assets/images/logo.svg')}}" alt="Edica">
            <div class="collapse navbar-collapse" id="edicaMainNav">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('index')}}">Блог<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('category.index')}}">Категории<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    @auth('web')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('personal.index')}}">Личный кабинет</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Выход</a>
                        </li>
                    @endauth
                    @guest('web')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Авторизация</a>
                            </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>
