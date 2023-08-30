@extends('frontend.template')
@section('banner')
@endsection
@section('body')
    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="{{route('home')}}">Accueil</a><span>/</span>A propos de nous</div>
        </div>
    </div>

    <div id="content">
        <div class="container about">

            <h3 class="animated" data-animation="fadeInUp" data-animation-delay="100">QUI SOMMES NOUS ?</h3>

            <div class="thumb6 animated" data-animation="fadeInLeft" data-animation-delay="200">
                <div class="thumbnail clearfix">
                    <figure class="">
                        <img src="{{ asset ('frontend/images/styles010.png') }}" alt="" class="img-responsive">
                    </figure>
                    <div class="caption">
                        <div class="title">Notre Vision</div>
                        <p>
                            {{$company->vision}}
                        </p>
                    </div>
                </div>
            </div><br><br>

            <div class="thumb6 right animated" data-animation="fadeInRight" data-animation-delay="200">
                <div class="thumbnail clearfix">
                    <figure class="">
                        <img src="{{ asset ('frontend/images/style009.jpg') }}" alt="" class="img-responsive">
                    </figure>
                    <div class="caption">
                        <div class="title">Nos Objectifs</div>
                        <p>
                            {!! html_entity_decode($company->objectif) !!}
                        </p>
                    </div>
                </div>
            </div>
            <br><br><br>

            <div class="title1 animated" data-animation="fadeInUp" data-animation-delay="100">Télécharger notre application Mobile sur Google playstore
                <div class="apps_wrapper">
                    <a href="#"><img src="{{asset ('frontend/images/app2.png') }}" alt="" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
@endsection