<header class="header">
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset(mix('img/logo.png')) }}" alt="" width="110"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link link-scroll active" href="#hero">{{ __('home.home') }} <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link link-scroll" href="#about">{{ __('home.about') }}</a></li>
            <li class="nav-item"><a class="nav-link link-scroll" href="#plans">{{ __('home.plans') }}</a></li>
            <!-- <li class="nav-item"><a class="nav-link link-scroll" href="#testimonials">Testimonials</a></li> -->
        </ul>
        </div>
    </div>
    </nav>
</header>