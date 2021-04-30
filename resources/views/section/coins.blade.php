<div class="row">
  <div class="col-12">
    <div class="coins cf">
      <div class="courses cf" id="showcase">
      @foreach ($sliders as $slider)
        <div class="course-item slide">
          <div class="course-summary coin-card">
            <div class="course-thumbnail">
            <img src="{{ asset('/crypto/'.strtolower($slider->name).'.svg') }}" />
            </div>
            <div class="course-info">
              <h6 class="course-title">{{$slider->dname ? $slider->dname : $slider->fullname}}</h6>
              <span class="course-price">{{$slider->price}}</span>
            </div>
            <div class="course-balance">
              {{__('home.our-balance')}} : <span>{{$slider->balance}}</span>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</div>