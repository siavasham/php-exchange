@extends('layouts.app')

@section('content')

  @include('section.header')
   
    <section class="bg-center py-0" id="about" >
      @include('section.service')
      <section class="with-pattern-1" id="services">
        <div class="container">
          @include('section.vision')
          @include('section.coins')
        </div>
        @include('section.plan')
        @include('section.faq')
      </section>
    </section>
    <a class="scropll-top-btn" id="scrollTop" href="#"><i class="fas fa-long-arrow-alt-up"></i></a>
   

@endsection
