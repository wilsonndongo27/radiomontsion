@extends('frontend.template')
@section('banner')
@endsection
@section('body')
    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="{{route('home')}}">Accueil</a>
                @if ($program ?? '')
                    <span>/</span><a href="{{route('list-podcast')}}">Podcasts</a>
                    <span>/</span>{{$program->title}}
                @else
                    <span>/</span>Podcasts
                @endif
            </div>
        </div>
    </div>

    <div id="content">
        <div class="container">

            <div class="title1 animated" data-animation="fadeInUp" data-animation-delay="100">Ecoutez les podcasts
            </div>
            <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="200">
                @if ($program ?? '')
                    PODCASTS / {{$program->title}}
                @else
                    LISTE DES PODCASTS
                @endif
            </div>
            <div class="title4 animated" data-animation="fadeInUp" data-animation-delay="300">
                Suivez vos émissions 24h/24.
            </div>

            <br><br><br>

            <div class="row">
                @if ($allpodcast->count() >  0)
                    @foreach ($allpodcast as $item)
                        <div class="col-sm-4">
                            <div class="artists1 clearfix animated" data-animation="fadeInUp" data-animation-delay="300">
                                <figure><img src="{{asset('storage/'.$item->cover)}}" alt="" class="img-responsive"></figure>
                                <div class="audio2">
                                    <audio class="audio" preload="none" style="width: 100%; visibility: hidden;"
                                        controls="controls">
                                        <source type="audio/mpeg" src="{{ asset ('storage/'.$item->audio ) }}"/>
                                        <a href="{{ asset ('storage/'.$item->audio ) }}">Ecouter {{$item->title}}</a>
                                    </audio>
                                </div>
                                <div class="caption">
                                    <div class="txt1">{{$item->title}}</div>
                                    <div class="txt2">{{$item->label}}</div>
                                    <div class="social2_wrapper">
                                        <ul class="social2 clearfix">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="emptyblock">
                        <h4>Aucun Podcast pour l'instant dans cette rubrique</h4>
                    </div>
                @endif
                
            </div>
            
            <div class="pager_wrapper animated" data-animation="fadeInUp" data-animation-delay="400">
                {{$allpodcast->links('frontend.paginator')}}
            </div>


        </div>
    </div>
@endsection
