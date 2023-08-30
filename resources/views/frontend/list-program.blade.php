@extends('frontend.template')
@section('banner')
@endsection
@section('body')
    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="{{route('home')}}">Accueil</a><span>/</span>Programmes</div>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <div class="title2 animated" data-animation="fadeInUp" data-animation-delay="100">Liste des programmes
            </div>
            <div class="title3 animated" data-animation="fadeInUp" data-animation-delay="200">
                Vous pouvez accéder à tous les Podcasts des programmes en un clic.
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

                <div class="pager_wrapper animated" data-animation="fadeInUp" data-animation-delay="400">
                    {{$allprogram->links('frontend.paginator')}}
                </div>

        </div>
    </div>
@endsection