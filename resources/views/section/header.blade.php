<section class="hero bg-top" id="hero" style="background: url({{ asset('/img/banner-4.png') }}) no-repeat; background-size: 100% 80%">
  <div class="container">
    <div class="row py-5">
      <div class="col-lg-5 py-5">
        <h2 class="font-weight-bold">{{ __('home.header') }}</h2>
        <p class="my-4 text-muted">{{ __('home.header-desc') }}</p>
        <ul class="list-inline mb-0">
          <li class="list-inline-item mb-2 mb-lg-0">
            <a class="btn btn-primary btn-lg px-4" href="https://panel.stronghold.live">
                <i class="fas fa-handshake mr-3"></i>{{ __('home.join-us') }}
            </a>
          </li>
        </ul>
      </div>
      <div class="col-lg-7">
        <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_q9mzugao.json"  background="transparent"  speed="1"  loop  autoplay></lottie-player>
      </div>
  </div>
</section>