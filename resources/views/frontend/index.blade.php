@extends('frontend.template')
@section('banner')
    <div id="home">
        <div class="logo3_wrapper">
            <a href="{{ route ('home')}}" class="logo3 scroll-to">
                <img src="{{ asset ('storage/'.$company->logo ) }}" alt="" class="img-responsive">
            </a>
        </div>
        <div class="contacthead nonresponsiveheadtext">
            <a href="#"><i class="fa fa-phone"></i>(+237) 691917410/674547575</a>
            <a href="#"><i class="fa fa-exchange"></i>contact@radiomonsion.com</a>
        </div>
        <div class="contacthead responsivetexthead">
            <marquee behavior="" direction="">
                <a href="#"><i class="fa fa-phone"></i>(+237) 691917410/674547575</a>
                <a href="#"><i class="fa fa-exchange"></i>contact@radiomonsion.com</a>
                <a href="#">CENTRE D'ÉVANGÉLISATION ET DU COMBAT SPIRITUEL / MONTAGNE DE SION sis PK13 Douala Cameroun.</a>
            </marquee>
        </div>
        <div class="add1 add2 clearfix">
            <div class="icon-search"><a href="#"></a></div>
            <div class="dropdown dropdown1">
                <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">FR
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="javascript:void(0);">EN</a></li>
                </ul>
            </div>
        </div>
        <div id="slider_wrapper">
            <div class="go-down"><a href="#featured" class="scroll-to"></a></div>
            <div class="">
                <div id="slider_inner" class="clearfix">
                    <div id="slider" class="clearfix">
                        <div id="camera_wrap">
                            @foreach ($allbanner as $item)
                                <div data-src="{{ asset ('storage/'.$item->cover) }}">
                                    <div class="camera_caption fadeFromRight nav2">
                                        <div class="txt1 txt">{{Str::limit($item->title, 50, '...')}}</div>
                                        <div class="txt5"><a href="#" class="btn-default btn0">Voir plus</a></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="song1_wrapper attacheplayer">
            <div class="container">
                <div class="audio4_html5">
                    <audio id="audio4_html5_white" class="liveRadio" preload="metadata">
                        <div class="xaudioplaylist">
                            @foreach ($allflux as $item)
                                <ul>
                                    <li class="xradiostream">{{$item->flux}}</li>
                                </ul>
                            @endforeach
                        </div>
                    </audio>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body')
<div id="featured">
    <div class="container">
        <div class="kand1 animated" data-animation="fadeInUp" data-animation-delay="200"></div>
        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="300">NOS PODCASTS</div>
    </div>

    <div class="slick-slider-wrapper">
        <div class="container">
            <div class="slick-slider slider center">
                @foreach ($allpodcast as $item)
                    <div>
                        <div class="slick-slider-inner">
                            <figure><img src="{{ asset ('storage/'.$item->cover ) }}" alt="" class="img-responsive"></figure>
                            <div class="caption">
                                <div class="txt1"><span>{{$item->label}}</span></div>
                                <div class="txt2"><span>{{$item->title}}</span></div>
                                <div class="txt3">
                                    <div class="audio2">
                                        <audio class="audio" preload="none" style="width: 100%; visibility: hidden;"
                                            controls="controls">
                                            <source type="audio/mpeg" src="{{ asset ('storage/'.$item->audio ) }}"/>
                                            <a href="{{ asset ('storage/'.$item->audio ) }}">Ecouter {{$item->title}}</a>
                                        </audio>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slider-overlay"></div>
                        </div>
                    </div>
                @endforeach
               
            </div>
        </div>
    </div>


    <div class="container">
        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="100">NOS PROGRAMMES</div>

        <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="200">
            Accédez à nos 
        </div>

        <br><br><br>

        <div class="radios animated" data-animation="fadeInUp" data-animation-delay="300">
            <div class="radio1 head clearfix">
                <div class="sec1">#</div>
                <div class="sec2">Titre du programme</div>
                <div class="sec3">Libellé du programme</div>
                <div class="sec4">Jour de diffusion</div>
                <div class="sec5">Heur de début</div>
                <div class="sec6">Heur de fin</div>
                <div class="sec7">Options </div>
            </div>
            @foreach ($allprogram as $item)
                <div class="radio1 clearfix">
                    <div class="sec1">
                        <img src="{{ asset ('storage/'.$item->cover)}}" alt="">
                    </div>
                    <div class="sec2">{{$item->title}}</div>
                    <div class="sec3">{{$item->label}}</div>
                    <div class="sec4">{{\Carbon\Carbon::parse($item->date)->diffForHumans()}}</div>
                    <div class="sec5">{{$item->time_start}}</div>   
                    <div class="sec6">{{$item->time_end}}</div>
                    <div class="sec7">
                        <div><a href="{{route('list-podcast-program', $item->id)}}" class="btn-default btnprogram">Voir les podcasts</a></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pager_wrapper animated" data-animation="fadeInUp" data-animation-delay="600">
            {{$allprogram->links('frontend.paginator')}}
        </div>

    </div>
</div>

<div id="collection2">
    <div class="container">

        <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200">A Propos de RADIO MON SION
        </div>

        <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="300">{{$company->description}}
        </div>

        <br><br>

        <div class="row">
            <div class="col-sm-6"> 
                <div class="thumb7 animated" data-animation="fadeInUp" data-animation-delay="200">
                    <div class="thumbnail clearfix">
                        <figure class="">
                            <img src="{{ asset ('frontend/images/styles010.png') }}" alt="" class="img-responsive">
                        </figure>
                        <div class="caption">
                            <div class="title">Notre vision</div>
                            <p>
                               {{$company->vision}}
                            </p>
                            <a href="{{route('about')}}" class="btn-default btn5">A propos de nous</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 blockobjecttif">
                <div class="thumb7 animated" data-animation="fadeInUp" data-animation-delay="300">
                    <div class="thumbnail clearfix">
                        <figure class="">
                            <img src="{{ asset ('frontend/images/style009.jpg') }}" alt="" class="img-responsive">
                        </figure>
                        <div class="caption">
                            <div class="title">Nos Objectifs</div>
                            <p>
                               {!! html_entity_decode(Str::limit($company->objectif, 200, '...')) !!}
                            </p>
                            <a href="#" class="btn-default btn5"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<div id="testimonial">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">

                <div id="testim_wrapper">
                    <div class="title2 actutitle">ACTUALITES</div>

                    <div id="testim">
                        <div class="carousel-box">
                            <div class="inner">
                                <div class="carousel main">
                                    <ul>
                                        @foreach ($allnews as $item)
                                            <li class="blockitemnews" onclick="redirectDetail(this)" url="{{route('detail-news', $item->id)}}">
                                                <div class="testim">
                                                    <div class="blockimage" style="background-image: url({{asset('storage/'.$item->cover)}})">
                                                    </div>
                                                    <div class="testim_inner">
                                                        <h2>{{$item->title}}</h2>
                                                        <div class="txt1">
                                                            {{$item->label}}
                                                        </div>
                                                        <div class="txt2">
                                                            Publié {{ $item->updated_at->diffForHumans()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testim_pagination"></div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection