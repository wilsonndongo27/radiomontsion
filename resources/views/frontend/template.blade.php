<!DOCTYPE html>
<html lang="fr">

<head>
    <title>RADIO MONT SION</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Radio Mont Sion">
    <meta name="keywords" content="Mont Sion, Radio, Dieu, Message, Bible, Bonne Nouvelle">
    <meta name="author" content="Radio Mon Sion">

    <link href="{{ asset ('frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/camera.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/audio4_html5.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/mediaelementplayer.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset ('frontend/css/custom.css') }}" rel="stylesheet">

    
    <link rel="icon" type="image/png" href="{{ asset ('storage/'.$company->logo ) }}">

</head>
<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="92">

<div id="load"></div>

<div id="main">

    @yield('banner')

    <div id="top1">
        <div class="top2_wrapper" id="top2">
            <div class="container">

                <div class="top2 clearfix">

                    <header>
                        <div class="logo_wrapper">
                            <a href="{{ route('home')}}" class="logo scroll-to logoimage2">
                                <img src="{{ asset ('storage/'.$company->logo) }}" alt="" class="img-responsive">
                            </a>
                        </div>
                    </header>

                    <div class="menu_wrapper">
                        <div class="add1 clearfix">
                            <div class="icon-search"><a href="javascript:void()"></a></div>
                            <div class="dropdown dropdown1">
                                <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true">EN
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="javascript:void(0);">FR</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="navbar navbar_ navbar-default">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-collapse navbar-collapse_ collapse">
                                <ul class="nav navbar-nav sf-menu ">
                                    <li><a href="{{ route('home')}}">Accueil</a></li>
                                    <li><a href="{{ route('list-news')}}">Actualités</a></li>
                                    <li><a href="{{route('list-program')}}">Programmes</a></li>
                                    <li><a href="{{route('list-podcast')}}">Podcasts</a></li>
                                    @if ($allproduct->count() > 0)
                                        <li class="sub-menu sub-menu-1"><a href="javascript:void(0);">Nos services<em></em></a>
                                            <ul>
                                                @foreach ($allproduct as $item)
                                                    <li><a href="#">{{$item->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else 
                                    @endif
                                    <li><a href="{{route('about')}}">A propos</a></li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    @yield('body')

    <div class="bot1_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">

                    <div class="logo2_wrapper">
                        <a href="index.html" class="logo2">
                            <img src="{{ asset ('storage/'.$company->logo ) }}" alt="" class="img-responsive">
                        </a>
                    </div>

                    <p>
                        {{$company->vision}}
                    </p>

                    <div class="location1">PK13. <br>Douala, CAMEROUN</div>

                    <div class="phone1">(+237) 691917410 / 674547575</div>

                    <div class="mail1"><a href="#">contact@radiomonsion.com</a></div>

                </div>
                <div class="col-sm-3">

                    <div class="bot1_title">ACCES RAPIDE</div>

                    <ul class="tags1 clearfix">
                        <li><a href="{{route('list-news')}}">Actualités</a></li>
                        <li><a href="{{route('list-program')}}">Programmes</a></li>
                        <li><a href="{{route('list-podcast')}}">Podcasts</a></li>
                        <li><a href="{{route('about')}}">A Propos</a></li>
                    </ul>

                    <div class="bot1_title">NEWS LETTERS</div>

                    <div class="newsletter_block">
                        <div class="txt1">Voulez vous recevoir nos messages par email ?</div>
                        <div class="newsletter-wrapper clearfix">
                            <form class="newsletter" action="javascript:void(0);">
                                <input type="text" name="s" value='Email Address'
                                       onBlur="if(this.value=='') this.value='Email Address'"
                                       onFocus="if(this.value =='Email Address' ) this.value=''">
                                <a href="javascript:void(0);"></a>
                            </form>
                        </div>
                        <div class="txt2">Nous respectons votre vie privé</div>
                    </div>

                </div>
                <div class="col-sm-4 col-sm-offset-1">

                    <div class="bot1_title">Actualités recentes</div>

                    <div class="latest1">
                        @foreach ($lastnews as $item)
                            <a href="{{route('detail-news', $item->id)}}" class="clearfix">
                                <figure><img src="{{asset('storage/'.$item->cover)}}" alt=""></figure>
                                <div class="caption">
                                    <div class="txt1">
                                        {{$item->title}}
                                    </div>
                                    <div class="txt2">{{ $item->created_at->DiffForHumans() }}</div>
                                </div>
                            </a>  
                        @endforeach
                    </div>

                    <a href="{{route('list-news')}}" class="btn-default btn3">VOIR PLUS</a>

                </div>
            </div>
        </div>
    </div>

    <div class="bot2_wrapper">
        <div class="container">
            Copyright © <span class="copydate"></span> RADIO MONT SION, All right Reserved. Designed by: <a href="https://polyh-sa.com" target="_blank"><b>Polyh International</b></a>
        </div>
    </div>


</div>
<script src="{{ asset ('frontend/js/jquery.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset ('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset ('frontend/js/superfish.js') }}"></script>

<script src="{{ asset ('frontend/js/camera.js') }}"></script>

<script src="{{ asset ('frontend/js/mediaelement-and-player.js') }}"></script>
<script src="{{ asset ('frontend/js/mep-feature-playlist.js') }}"></script>
<script src="{{ asset ('frontend/js/slick.min.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.jrumble.1.3.min.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.sticky.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.queryloader2.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.appear.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.ui.totop.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery.equalheights.js') }}"></script>

<script src="{{ asset ('frontend/js/jquery.caroufredsel.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery.touchSwipe.min.js') }}"></script>

<script src="{{ asset ('frontend/js/SmoothScroll.js') }}"></script>

<script src="{{ asset ('frontend/js/cform.js') }}"></script>

<script type="text/javascript" src="{{ asset ('frontend/js/lastfm.api.md5.js') }}"></script>
<script type="text/javascript" src="{{ asset ('frontend/js/lastfm.api.js') }}"></script>
<script type="text/javascript" src="{{ asset ('frontend/js/lastfm.api.cache.js') }}"></script>
<script type="text/javascript" src="{{ asset ('frontend/js/swfobject.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery.mousewheel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('frontend/js/audio4_html5.js') }}" type="text/javascript"></script>
<script src="{{ asset ('frontend/js/scripts.js') }}"></script>
<script>
    var data = new Date();
    $('.copydate').text(data.getFullYear());
</script>


<script type="text/javascript" src="{{ asset ('frontend/js/custom.js') }}"></script>
</body>

</html>