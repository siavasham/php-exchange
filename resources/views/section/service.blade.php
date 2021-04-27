<section class="about py-0" style="background: url({{ asset('/img/service-bg.png') }}) no-repeat; background-size: cover">
    <div class="container">
        <h2 class="mb-5">{{ __('home.service') }}</h2>
        <div class="row pb-5">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Services Item-->
                <div class="card border-0 shadow rounded-lg py-4 text-left">
                    <div class="card-body p-3">
                    <div class="text-center"><img class="card-img" src="{{ asset('/img/crypto.png') }}" /></div>
                    <h3 class="font-weight-normal h4 my-4">{{ __('home.crypto') }}</h3>
                    <p class="text-small mb-0">{{ __('home.crypto-desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <!-- Services Item-->
                <div class="card border-0 shadow rounded-lg py-4 text-left">
                    <div class="card-body p-3">
                    <div class="text-center"><img class="card-img" src="{{ asset('/img/forex.png') }}" /></div>
                    <h3 class="font-weight-normal h4 my-4">{{ __('home.forex') }}</h3>
                    <p class="text-small mb-0">{{ __('home.forex-desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Services Item-->
                <div class="card border-0 shadow rounded-lg py-4 text-left">
                    <div class="card-body p-3">
                    <div class="text-center"><img class="card-img" src="{{ asset('/img/mine.png') }}" /></div>
                    <h3 class="font-weight-normal h4 my-4">{{ __('home.mine') }}</h3>
                    <p class="text-small mb-0">{{ __('home.mine-desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>