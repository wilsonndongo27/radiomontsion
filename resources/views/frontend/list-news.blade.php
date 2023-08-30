@extends('frontend.template')
@section('banner')
@endsection
@section('body')
    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="{{ route ('home')}}">Accueil</a><span>/</span>Actualités</div>
        </div>
    </div>

    <div id="content">
        <div class="container">

            <h2>Fil Actualités</h2>

            <div class="details2 clearfix">
                <div class="left">Créé <span>|</span> Par: Admin</div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <div class="blog_sidebar">

                        <div class="title5">NOUVEAUTES</div>
                        <div class="news2_wrapper">
                            @foreach ($lastnews as $item)
                                <div class="news2">
                                    <a href="{{ route('detail-news', $item->id )}}">
                                        <div class="txt1">{{$item->title}}</div>
                                        <div class="txt2">{{$item->updated_at->diffForHumans()}}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="blog_content">
                        @foreach ($allnews as $item)
                            <div class="post post-short news-{{$item->id}}">
                                <div class="post-header">
                                    <div class="post-image">
                                        @if ($item->has_video == '1')
                                            <video controls>
                                                <source src="{{ asset ('storage/'.$item->video)}}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset ('storage/'.$item->cover)}}" alt="" class="img-responsive">
                                        @endif
                                    </div>
                                </div>
                                <div class="post-story">
                                    <div class="post-story-body clearfix">
                                        <div class="txt1">{{$item->title}}</div>
                                        {!! html_entity_decode($item->description) !!}
                                        <div>
                                            <div class="txt2">Publié, {{$item->created_at->diffForHumans()}}</div>
                                            <div class="right"><a href="https://www.facebook.com/sharer/sharer.php?u=#home&t=TITLE" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                                target="_blank" title="Share on Facebook" class="share1"></a></div>
                                        </div>
                                    </div>
                                    <div class="post-story-link">
                                        <a href="{{ route('detail-news', $item->id )}}" class="btn-default btn6">Voir le détail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
 