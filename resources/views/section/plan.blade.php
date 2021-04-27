<div  class="mt-5 pt-5"  id="plans" style="background: url({{ asset('/img/testimonials-bg.png') }}) no-repeat; background-size: 40% 100%; background-position: left center">
    <div class="container text-center">
        <h2 class="mb-5">{{ __('home.plans') }}</h2>
        <div class="row justify-content-center">
        @foreach ($plans as $plan)
                <div class="card card-pricing text-center mb-4 px-4 border-0 shadow mx-2  col-sm-12 col-md-2">
                    <span class=" w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white">{{ __('home.'.$plan->type) }}</span>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <h1 class="h3 font-weight-normal text-success text-center" >%<span class="price mr-2">{{$plan->profit}}</span></h1>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-unstyled mb-4">
                            <li>{{ __('home.profit')}}</li>
                        </ul>
                        <a  href="{{ sub_asset('panel','/') }}">
                            <button type="button" class="btn btn-outline-primary mb-3">{{ __('home.start')}}</button>
                        </a>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
</div>