<div class="row trading">
    <div class="col-sm-12 col-md-5 mb-4 trading-desc">
        <h3 class="title pb-3">{{ $constans->kycTrading }} </h3>
        <div class="desc pb-3">{{ $constans->kycTradingDesc }} </div>
        <button type="button" class="btn btn-outline-danger btn-trade">{{ $constans->kycTradingBtn }}</button>
    </div>
    <div class="col-sm-12 col-md-7  trade-items">
        @for ($i = 1; $i < 7; $i++)
            <div class="trade-item">
                <div class="trade-counter">
                    {{$i}}
                </div>
                <div class="trade-text">
                    {{ $constans->{'kyc'.$i} }}
                </div>
            </div>
        @endfor  
    </div>
</div>
<div class="row safe">
    <div class="col-sm-12 col-md-5 mb-4 safe-desc">
        <h3 class="title pb-3">{{ $constans->safeTitle }} </h3>
        <div class="desc pb-3">{{ $constans->safeDesc }} </div>
    </div>
    <div class="col-sm-12 col-md-7 h-100">
        <div class="row">
        @for ($i = 1; $i < 7; $i++)
            <div class="safe-item col-4">
                <img src="{{ asset('/img/'.(in_array($i,[2,5])?'tick':'trust').'.svg') }}" />
                {{ $constans->{'safe'.$i} }}
            </div>
        @endfor  
        </div>
    </div>
  </div>