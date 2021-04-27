<div  class="mt-5 pt-2"  id="test" style="background: url({{ asset('/img/testimonials-bg.png') }}) no-repeat; background-size: 40% 100%; background-position: left center">
    <div class="container text-center">
        <h2 class="mb-5 mt-5">{{ __('home.faq') }}</h2>
        <div class="accordion_two_section">
            <div class="container">
                <div class="panel-group accordionTwo" id="accordionTwoLeft">
                    @foreach ($faq as $f)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordionTwoLeft" href="#collapse{{$f->id}}" aria-expanded="false" class="collapsed">{{$f->question}}</a> </h4>
                        </div>
                        <div id="collapse{{$f->id}}" class="panel-collapse collapse" aria-expanded="false" role="tablist" >
                            <div class="panel-body">{{$f->answer}} </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>