@extends('frontend.template')
@section('banner')
@endsection
@section('body')
    <div class="breadcrumbs1_wrapper">
        <div class="container">
            <div class="breadcrumbs1"><a href="{{ route('home')}}">Accueil</a><span>/</span>{{$news->label}}</div>
        </div>
    </div>

    <div id="content">
        <div class="container">

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

                        <h2>{{ $news->title }}</h2>

                        <div class="post post-full"> 
                            <div class="post-header">
                                <div class="post-image">
                                    @if ($news->has_video == '1')
                                        <video controls class="img-responsive">
                                            <source src="{{ asset ('storage/'.$news->video)}}" type="video/mp4">
                                        </video>
                                    @else
                                        <img src="{{ asset ('storage/'.$news->cover)}}" alt="" class="img-responsive">
                                    @endif
                                </div>
                            </div>
                            <div class="post-story">
                                <div class="details2 clearfix">
                                    <div class="left">Créé <span>|</span> Par: Admin <span>|</span> {{ $news->created_at }}</div>
                                    <div class="right"><a href="https://www.facebook.com/sharer/sharer.php?u=#home&t=TITLE" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                        target="_blank" class="share1"></a>
                                    </div>
                                </div>
                                <div class="post-story-body clearfix">
                                    {!! html_entity_decode($news->description) !!}
                                </div>
                            </div>
                        </div>

                        <!-- <div class="num-comments">3 Comments</div>

                        <div class="comment-block clearfix">
                            <figure>
                                <img src="images/user1.jpg" alt="" class="img-responsive">
                            </figure>
                            <div class="caption">
                                <div class="top clearfix">
                                    <div class="left">
                                        <div class="txt1">George Smith</div>
                                        <div class="txt2">2015. May.20</div>
                                    </div>
                                    <div class="right"><a href="#">Reply</a></div>
                                </div>
                                <div class="txt">
                                    The bedding was hardly able to cover it and seemed ready to slide off any moment.
                                    His many legs, pitifully r it and seemed ready to slide off any m
                                </div>
                            </div>
                        </div>

                        <div class="comment-block left1 clearfix">
                            <figure>
                                <img src="images/user2.jpg" alt="" class="img-responsive">
                            </figure>
                            <div class="caption">
                                <div class="top clearfix">
                                    <div class="left">
                                        <div class="txt1">Laura Mountroe</div>
                                        <div class="txt2">2015. May.20</div>
                                    </div>
                                    <div class="right"><a href="#">Reply</a></div>
                                </div>
                                <div class="txt">
                                    The bedding was hardly able to cover it and seemed ready to slide off any moment.
                                    His many legs, pitifully r it and seemed ready to slide off any m
                                </div>
                            </div>
                        </div>

                        <div class="comment-block clearfix">
                            <figure>
                                <img src="images/user3.jpg" alt="" class="img-responsive">
                            </figure>
                            <div class="caption">
                                <div class="top clearfix">
                                    <div class="left">
                                        <div class="txt1">George Smith</div>
                                        <div class="txt2">2015. May.20</div>
                                    </div>
                                    <div class="right"><a href="#">Reply</a></div>
                                </div>
                                <div class="txt">
                                    The bedding was hardly able to cover it and seemed ready to slide off any moment.
                                    His many legs, pitifully r it and seemed ready to slide off any m
                                </div>
                            </div>
                        </div>

                        <div class="live-comment">
                            <div class="live-comment-title">Leave a Comment</div>
                            <div class="live-comment-form">

                                <div id="note3"></div>
                                <div id="fields3">
                                    <form id="ajax-contact-form3" class="form-horizontal" action="javascript:;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputName">Your Name</label>
                                                    <input type="text" class="form-control" id="inputName" name="name"
                                                           value="Full Name"
                                                           onBlur="if(this.value=='') this.value='Full Name'"
                                                           onFocus="if(this.value =='Full Name' ) this.value=''">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="text" class="form-control" id="inputEmail" name="email"
                                                           value="E-mail address"
                                                           onBlur="if(this.value=='') this.value='E-mail address'"
                                                           onFocus="if(this.value =='E-mail address' ) this.value=''">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputMessage">Your Message</label>
                                                    <textarea class="form-control" rows="9" id="inputMessage" name="content"
                                                                onBlur="if(this.value=='') this.value='Message'"
                                                                onFocus="if(this.value =='Message' ) this.value=''">Message</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn-default btn-cf-submit3">SUBMIT</button>
                                    </form>
                                </div>

                            </div>

                        </div> -->


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection