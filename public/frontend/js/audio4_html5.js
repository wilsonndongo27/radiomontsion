/*
 * HTML5 Radio Player With Playlist - Shoutcast and Icecast - v1.8.3
 * Copyright 2014-2017, LambertGroup
 *
 */

 (function(d){function I(a,c,f,e){d(a.thumbsHolder_Thumbs[a.current_img_no]).css({background:c.playlistRecordBgOnColor,"border-bottom-color":c.playlistRecordBottomBorderOnColor,color:c.playlistRecordTextOnColor});a.is_very_first||D(-1,a,c,f);var m;""!=a.playlist_arr[a.origID].radiostream&&(m=a.playlist_arr[a.origID].radiostream);return m}function M(a,c,f,e,m,l,g,q,k,n){clearInterval(a.radioReaderAjaxInterval);d.get(c.pathToAjaxFiles+"now_playing.php",{the_stream:a.playlist_arr[a.origID].radiostream,
 _:d.now()},function(d){a.playlist_arr[a.origID].title=d;J(a,c,f,e,m,l,g,q,k,n)});J(a,c,f,e,m,l,g,q,k,n);a.isFlashNeeded?""!=a.myFlashObject&&a.myFlashObject.myAS3function(I(a,c,f,e),c.initialVolume):(document.getElementById(a.audioID).src=I(a,c,f,e),document.getElementById(a.audioID).load(),c.autoPlay&&m.click());setTimeout(function(){a.radioReaderAjaxInterval=setInterval(function(){d.get(c.pathToAjaxFiles+"now_playing.php",{the_stream:a.playlist_arr[a.origID].radiostream,_:d.now()},function(d){a.playlist_arr[a.origID].title=
 d;J(a,c,f,e,m,l,g,q,k,n)})},1E3*c.nowPlayingInterval)},1E3*c.nowPlayingInterval)}function J(a,c,d,e,m,l,g,q,k,n){l.width(a.titleWidth);q.width(a.titleWidth);a.curSongText="";c.showTitle&&null!=a.playlist_arr[a.origID].title&&""!=a.playlist_arr[a.origID].title&&(a.curSongText+="<b>"+c.translateSongTitle+"</b>"+a.playlist_arr[a.origID].title);c.showRadioStation&&null!=a.playlist_arr[a.origID].station&&""!=a.playlist_arr[a.origID].station&&q.html("<b>"+c.translateRadioStation+"</b>"+a.playlist_arr[a.origID].station);
 d=a.playlist_arr[a.origID].title.split("-");var f=c.noImageAvailable;d[0]=d[0].trim();c.grabLastFmPhoto?a.lastfm.artist.getInfo({artist:d[0]},{success:function(a){""!=a.artist.image[3]["#text"].trim()&&(f=a.artist.image[3]["#text"]);n.css({background:"url("+f+") #000000","background-repeat":"no-repeat","background-position":"center center","background-size":"cover","border-width":c.imageBorderWidth+"px","border-color":c.imageBorderColor})},error:function(a,e){n.css({background:"url("+f+") #000000",
 "background-repeat":"no-repeat","background-position":"center center","background-size":"cover","border-width":c.imageBorderWidth+"px","border-color":c.imageBorderColor})}}):n.css({background:"url("+f+") #000000","background-repeat":"no-repeat","background-position":"center center","background-size":"cover","border-width":c.imageBorderWidth+"px","border-color":c.imageBorderColor});a.curSongText&&a.prevSongTitle!=a.playlist_arr[a.origID].title&&(g.css({width:"auto"}),a.isStationTitleInsideScrolling=
 !1,a.stationTitleInsideWait=0,g.stop(),g.css({"margin-left":0}),g.html(a.curSongText),clearInterval(a.timeupdateInterval),g.width()>a.titleWidth?a.timeupdateInterval=setInterval(function(){!a.isStationTitleInsideScrolling&&5<=a.stationTitleInsideWait&&g.width()>a.titleWidth?(a.isStationTitleInsideScrolling=!0,a.stationTitleInsideWait=0,g.html(a.curSongText+" **** "+a.curSongText+" **** "+a.curSongText+" **** "+a.curSongText+" **** "+a.curSongText+" **** "),g.css({"margin-left":0}),g.stop().animate({"margin-left":c.playerWidth-
 g.width()+"px"},parseInt(1E4*(g.width()-c.playerWidth)/150,10),"linear",function(){a.isStationTitleInsideScrolling=!1})):!a.isStationTitleInsideScrolling&&g.width()>a.titleWidth&&a.stationTitleInsideWait++},300):g.css({width:"100%"}),a.prevSongTitle=a.playlist_arr[a.origID].title)}function D(a,c,d,e){var f=(c.thumbsHolder_ThumbHeight+1)*(c.selectedCateg_total_images-d.numberOfThumbsPerScreen),l=0;e.stop(!0,!0);-1==a||c.isCarouselScrolling?!c.isCarouselScrolling&&c.selectedCateg_total_images>d.numberOfThumbsPerScreen&&
 (c.isCarouselScrolling=!0,l=-1*parseInt((c.thumbsHolder_ThumbHeight+1)*c.current_img_no,10),Math.abs(l)>f&&(l=-1*f),c.selectedCateg_total_images>d.numberOfThumbsPerScreen&&d.showPlaylist&&c.audio4_html5_sliderVertical.slider("value",100+parseInt(100*l/f)),e.animate({top:l+"px"},500,"easeOutCubic",function(){c.isCarouselScrolling=!1})):(c.isCarouselScrolling=!0,l=2>=a?-1*f:parseInt(f*(a-100)/100,10),0<l&&(l=0),e.animate({top:l+"px"},1100,"easeOutQuad",function(){c.isCarouselScrolling=!1}))}function R(a,
 c,f,e,m,l,g,q,k,n,p,z,r,u,v,A,t){e.stop(!0,!0);a.isCarouselScrolling=!1;e.stop().animate({left:-1*l.width()+"px"},600,"easeOutQuad",function(){e.html("");for(var h=0;h<a.category_arr.length;h++)a.thumbsHolder_Thumb=d('<div class="thumbsHolder_ThumbOFF" rel="'+h+'"><div class="padding">'+a.category_arr[h]+"</div></div>"),e.append(a.thumbsHolder_Thumb),a.thumbsHolder_Thumb.css({top:(a.thumbsHolder_Thumb.height()+1)*h+"px",background:c.categoryRecordBgOffColor,"border-bottom-color":c.categoryRecordBottomBorderOffColor,
 color:c.categoryRecordTextOffColor}),a.category_arr[h]==a.selectedCateg&&(a.current_img_no=h,a.thumbsHolder_Thumb.css({background:c.categoryRecordBgOnColor,"border-bottom-color":c.categoryRecordBottomBorderOnColor,color:c.categoryRecordTextOnColor}));a.selectedCateg_total_images=a.numberOfCategories;a.categsAreListed=!0;h=0;c.showCategories&&(h+=c.selectedCategMarginBottom);c.showSearchArea&&(h+=c.selectedCategMarginBottom);m.height(2*c.playlistPadding+(a.thumbsHolder_Thumb.height()+1)*c.numberOfThumbsPerScreen+
 g.height()+k.height()+h);l.height((a.thumbsHolder_Thumb.height()+1)*c.numberOfThumbsPerScreen);n.css({padding:c.playlistPadding+"px"});a.thumbsHolder_Thumbs=d(".thumbsHolder_ThumbOFF",f);a.numberOfCategories>c.numberOfThumbsPerScreen&&c.showPlaylist?(c.isPlaylistSliderInitialized&&a.audio4_html5_sliderVertical.slider("destroy"),a.audio4_html5_sliderVertical.slider({orientation:"vertical",range:"min",min:1,max:100,step:1,value:100,slide:function(d,f){D(f.value,a,c,e)}}),c.isPlaylistSliderInitialized=
 !0,a.audio4_html5_sliderVertical.css({display:"inline",position:"absolute",height:m.height()-20-g.height()-h-k.height()-2*c.playlistPadding+"px",left:f.width()+2*c.playerPadding-a.audio4_html5_sliderVertical.width()-c.playlistPadding+"px",top:a.audioPlayerHeight+c.playlistTopPos+c.playlistPadding+g.height()+c.selectedCategMarginBottom+2+"px"}),c.showPlaylistOnInit||a.audio4_html5_sliderVertical.css({opacity:0,display:"none"}),c.showPlaylistOnInit=!0,d(".thumbsHolder_ThumbOFF",f).css({width:f.width()+
 2*c.playerPadding-a.audio4_html5_sliderVertical.width()-2*c.playlistPadding-3+"px"})):(c.isPlaylistSliderInitialized&&(a.audio4_html5_sliderVertical.slider("destroy"),c.isPlaylistSliderInitialized=!1),d(".thumbsHolder_ThumbOFF",f).css({width:f.width()+2*c.playerPadding-2*c.playlistPadding+"px"}));a.thumbsHolder_Thumbs.click(function(){var h=d(this).attr("rel");a.selectedCateg=a.category_arr[h];q.html(a.selectedCateg);N(a,c,f,e,m,l,g,k,n,p,z,r,u,v,A,t)});a.thumbsHolder_Thumbs.mouseover(function(){d(this).css({background:c.categoryRecordBgOnColor,
 "border-bottom-color":c.categoryRecordBottomBorderOnColor,color:c.categoryRecordTextOnColor})});a.thumbsHolder_Thumbs.mouseout(function(){var e=d(this),f=e.attr("rel");a.current_img_no!=f&&e.css({background:c.categoryRecordBgOffColor,"border-bottom-color":c.categoryRecordBottomBorderOffColor,color:c.categoryRecordTextOffColor})});l.mousewheel(function(d,f,b,h){d.preventDefault();d=a.audio4_html5_sliderVertical.slider("value");if(1<parseInt(d)&&-1==parseInt(f)||100>parseInt(d)&&1==parseInt(f))d+=f,
 a.audio4_html5_sliderVertical.slider("value",d),D(d,a,c,e)});e.css({top:"0px"});e.stop().animate({left:"0px"},400,"easeOutQuad",function(){})})}function N(a,c,f,e,m,l,g,q,k,n,p,z,r,u,v,A){e.stop(!0,!0);a.isCarouselScrolling=!1;var t="",h=!1,B=500;a.is_very_first&&(B=1);""!=a.search_val&&(B=1);e.stop().animate({left:-1*l.width()+"px"},B,"easeOutQuad",function(){e.html("");for(var w=a.selectedCateg_total_images=0;w<a.playlist_arr.length;w++)h=!1,""!=a.search_val?(t=a.playlist_arr[w].station.toLowerCase(),
 -1!=t.indexOf(a.search_val)&&(h=!0)):-1!=a.playlist_arr[w].category.indexOf(a.selectedCateg+";")&&(h=!0),h&&(a.selectedCateg_total_images++,a.thumbsHolder_Thumb=d('<div class="thumbsHolder_ThumbOFF" rel="'+(a.selectedCateg_total_images-1)+'" data-origID="'+w+'"><div class="padding">'+(c.showPlaylistNumber?a.selectedCateg_total_images+". ":"")+a.playlist_arr[w].station+"</div></div>"),e.append(a.thumbsHolder_Thumb),0==a.thumbsHolder_ThumbHeight&&(a.thumbsHolder_ThumbHeight=a.thumbsHolder_Thumb.height()),
 a.thumbsHolder_Thumb.css({top:(a.thumbsHolder_ThumbHeight+1)*a.selectedCateg_total_images+"px",background:c.playlistRecordBgOffColor,"border-bottom-color":c.playlistRecordBottomBorderOffColor,color:c.playlistRecordTextOffColor}),a.current_img_no=0,a.origID==d("div[rel='"+(a.selectedCateg_total_images-1)+"']").attr("data-origID")&&a.thumbsHolder_Thumb.css({background:c.playlistRecordBgOnColor,"border-bottom-color":c.playlistRecordBottomBorderOnColor,color:c.playlistRecordTextOnColor}));a.categsAreListed=
 !1;w=0;c.showCategories&&(w+=c.selectedCategMarginBottom);c.showSearchArea&&(w+=c.selectedCategMarginBottom);m.height(2*c.playlistPadding+(a.thumbsHolder_ThumbHeight+1)*c.numberOfThumbsPerScreen+g.height()+q.height()+w);l.height((a.thumbsHolder_ThumbHeight+1)*c.numberOfThumbsPerScreen);k.css({padding:c.playlistPadding+"px"});a.thumbsHolder_Thumbs=d(".thumbsHolder_ThumbOFF",f);var b=a.audioPlayerHeight+m.height()+c.playlistTopPos;c.showPlaylist&&c.showPlaylistOnInit||(b=a.audioPlayerHeight);A.css({width:f.width()+
 2*c.playerPadding+"px",height:b+"px"});a.selectedCateg_total_images>c.numberOfThumbsPerScreen&&c.showPlaylist?(c.isPlaylistSliderInitialized&&a.audio4_html5_sliderVertical.slider("destroy"),a.audio4_html5_sliderVertical.slider({orientation:"vertical",range:"min",min:1,max:100,step:1,value:100,slide:function(b,d){D(d.value,a,c,e)}}),c.isPlaylistSliderInitialized=!0,b=0,c.showCategories&&(b+=c.selectedCategMarginBottom),a.audio4_html5_sliderVertical.css({display:"inline",position:"absolute",height:m.height()-
 20-g.height()-w-q.height()-2*c.playlistPadding+"px",left:f.width()+2*c.playerPadding-a.audio4_html5_sliderVertical.width()-c.playlistPadding+"px",top:a.audioPlayerHeight+c.playlistTopPos+c.playlistPadding+g.height()+b+2+"px"}),c.showPlaylistOnInit||a.audio4_html5_sliderVertical.css({opacity:0,display:"none"}),c.showPlaylistOnInit=!0,d(".thumbsHolder_ThumbOFF",f).css({width:f.width()+2*c.playerPadding-a.audio4_html5_sliderVertical.width()-2*c.playlistPadding-3+"px"})):(c.isPlaylistSliderInitialized&&
 (a.audio4_html5_sliderVertical.slider("destroy"),c.isPlaylistSliderInitialized=!1),d(".thumbsHolder_ThumbOFF",f).css({width:f.width()+2*c.playerPadding-2*c.playlistPadding+"px"}));a.thumbsHolder_Thumbs.click(function(){c.autoPlay=!0;var b=d(this).attr("rel");a.thumbsHolder_Thumbs.css({background:c.playlistRecordBgOffColor,"border-bottom-color":c.playlistRecordBottomBorderOffColor,color:c.playlistRecordTextOffColor});a.current_img_no=b;a.origID=d("div[rel='"+a.current_img_no+"']").attr("data-origID");
 n.addClass("AudioPause");M(a,c,e,f,n,p,z,r,u,v);D(-1,a,c,e)});a.thumbsHolder_Thumbs.mouseover(function(){d(this).css({background:c.playlistRecordBgOnColor,"border-bottom-color":c.playlistRecordBottomBorderOnColor,color:c.playlistRecordTextOnColor})});a.thumbsHolder_Thumbs.mouseout(function(){var b=d(this),e=b.attr("rel");a.origID!=d("div[rel='"+e+"']").attr("data-origID")&&b.css({background:c.playlistRecordBgOffColor,"border-bottom-color":c.playlistRecordBottomBorderOffColor,color:c.playlistRecordTextOffColor})});
 l.mousewheel(function(b,d,f,h){b.preventDefault();b=a.audio4_html5_sliderVertical.slider("value");if(1<parseInt(b)&&-1==parseInt(d)||100>parseInt(b)&&1==parseInt(d))b+=d,a.audio4_html5_sliderVertical.slider("value",b),D(b,a,c,e)});e.css({top:"0px"});e.stop().animate({left:"0px"},400,"easeOutQuad",function(){})})}function Q(a,c,f){"next"==f?a.current_img_no==a.selectedCateg_total_images-1?a.current_img_no=0:a.current_img_no++:0>a.current_img_no-1?a.current_img_no=a.selectedCateg_total_images-1:a.current_img_no--;
 a.origID=d("div[rel='"+a.current_img_no+"']").attr("data-origID")}function O(){var a=-1;if("Microsoft Internet Explorer"==navigator.appName){var c=navigator.userAgent;var d=/MSIE ([0-9]{1,}[.0-9]{0,})/;null!=d.exec(c)&&(a=parseFloat(RegExp.$1))}else"Netscape"==navigator.appName&&(c=navigator.userAgent,d=/Trident\/.*rv:([0-9]{1,}[.0-9]{0,})/,null!=d.exec(c)&&(a=parseFloat(RegExp.$1)));return parseInt(a,10)}function S(){d("audio").each(function(){d(".AudioPlay").removeClass("AudioPause");d(this)[0].pause()})}
 function O(){var a=-1;if("Microsoft Internet Explorer"==navigator.appName){var c=navigator.userAgent;var d=/MSIE ([0-9]{1,}[.0-9]{0,})/;null!=d.exec(c)&&(a=parseFloat(RegExp.$1))}else"Netscape"==navigator.appName&&(c=navigator.userAgent,d=/Trident\/.*rv:([0-9]{1,}[.0-9]{0,})/,null!=d.exec(c)&&(a=parseFloat(RegExp.$1)));return parseInt(a,10)}function T(a){var c=!1;document.getElementById(a.audioID).canPlayType&&"no"!=document.getElementById(a.audioID).canPlayType("audio/mpeg")&&""!=document.getElementById(a.audioID).canPlayType("audio/mpeg")||
 (c=!0);return c}var E=navigator.userAgent.toLowerCase();d.fn.audio4_html5=function(a){a=d.extend({},d.fn.audio4_html5.defaults,a);O();return this.each(function(){var c=d(this),f=d('<div class="FrameBehindPlayerText"></div><div class="FrameBehindPlayer"></div> <div class="ximage"></div> <div class="AudioControls"> <a class="AudioFacebook" title="Facebook"></a><a class="AudioTwitter" title="Twitter"></a><a class="AudioPlay" title="Play/Pause"></a><a class="AudioPrev" title="Previous"></a><a class="AudioNext" title="Next"></a><a class="AudioShowHidePlaylist" title="Show/Hide Playlist"></a><a class="VolumeButton" title="Mute/Unmute"></a><div class="VolumeSlider"></div>   </div>   <div class="songTitle"><div class="songTitleInside"></div></div>  <div class="radioStation"></div>     <div class="thumbsHolderWrapper"><div class="playlistPadding"><div class="selectedCategDiv"><div class="innerSelectedCategDiv">reading the categories...</div></div> <div class="thumbsHolderVisibleWrapper"><div class="thumbsHolder"></div></div><div class="searchDiv"><input class="search_term" type="text" value="search..." /></div></div></div>  <div class="slider-vertical"></div>'),
 e=c.parent(".audio4_html5");e.addClass(a.skin);e.append(f);var m=d(".FrameBehindPlayerText",e),l=d(".FrameBehindPlayer",e);d(".AudioControls",e);var g=d(".AudioFacebook",e),q=d(".AudioTwitter",e),k=d(".AudioPlay",e),n=d(".AudioPrev",e),p=d(".AudioNext",e),z=d(".AudioShowHidePlaylist",e),r=d(".VolumeButton",e),u=d(".VolumeSlider",e),v=d(".songTitle",e),A=d(".songTitleInside",e),t=d(".radioStation",e),h=d(".ximage",e);e.wrap("<div class='the_wrapper'></div>");var B=e.parent(),w=O();if(-1!=E.indexOf("ipad")||
 -1!=E.indexOf("iphone")||-1!=E.indexOf("ipod")||-1!=E.indexOf("webos")||-1!=navigator.userAgent.indexOf("Android"))a.autoHidePlayButton=!1,k.css("display","block"),a.autoPlay=!1;e.css({background:"transparent",padding:a.playerPadding+"px"});l.css({background:a.frameBehindPlayerColor});m.css({background:a.beneathTitleBackgroundColor_VisiblePlaylist,opacity:a.beneathTitleBackgroundOpacity_VisiblePlaylist/100,"border-bottom":a.beneathTitleBackgroundBorderWidth+"px solid "+a.beneathTitleBackgroundBorderColor});
 var b={current_img_no:0,origID:0,is_very_first:!0,total_images:0,selectedCateg_total_images:0,numberOfCategories:0,is_changeSrc:!1,timeupdateInterval:"",totalTime:"",playlist_arr:"",isCarouselScrolling:!1,isStationTitleInsideScrolling:!1,curSongText:"",prevSongTitle:"",stationTitleInsideWait:0,audioPlayerWidth:0,audioPlayerHeight:0,category_arr:"",selectedCateg:"",categsAreListed:!1,thumbsHolder_Thumb:d('<div class="thumbsHolder_ThumbOFF" rel="0"><div class="padding">test</div></div>'),thumbsHolder_ThumbHeight:0,
 thumbsHolder_Thumbs:"",search_val:"",constantDistance:5,titleWidth:0,radioStationTopPos:0,radioStationLeftPos:0,titleTopPos:0,titleLeftPos:0,frameBehindPlayerTopPos:0,frameBehindPlayerLeftPos:0,imageTopPos:0,imageLeftPos:0,playTopPos:0,playLeftPos:0,previousTopPos:0,previousLeftPos:0,nextTopPos:0,nextLeftPos:0,volumeTopPos:0,volumeLeftPos:0,volumesliderTopPos:0,volumesliderLeftPos:0,showhideplaylistTopPos:0,showhideplaylistLeftPos:0,smallButtonDistance:0,facebookTopPos:0,facebookLeftPos:0,twitterTopPos:0,
 twitterLeftPos:0,numberOfButtonsRightSide:3,origParentFloat:"",origParentPaddingTop:"",origParentPaddingRight:"",origParentPaddingBottom:"",origParentPaddingLeft:"",windowWidth:0,audioID:"",audioObj:"",radioReaderAjaxInterval:"",totalRadioStationsNo:0,ajaxReturnedRadioStationsNo:0,lastfm:"",isFlashNeeded:!0,myFlashObject:"",rndNum:0,prevVolumeVal:1};b.audioID=c.attr("id");b.isFlashNeeded=T(b);-1!=w&&(b.isFlashNeeded=!0);a.showFacebookBut||--b.numberOfButtonsRightSide;a.showTwitterBut||--b.numberOfButtonsRightSide;
 a.showPlaylistBut||--b.numberOfButtonsRightSide;a.showPlaylistBut||z.css({display:"none",padding:0,margin:0});e.width(a.playerWidth);a.origWidth=a.playerWidth;l.css({top:parseInt((h.height()+2*a.imageBorderWidth-l.height())/2,10)+"px",left:"0px"});b.frameBehindPlayerTopPos=parseInt(l.css("top").substring(0,l.css("top").length-2),10);b.frameBehindPlayerLeftPos=parseInt(l.css("left").substring(0,l.css("left").length-2),10);m.css({top:b.frameBehindPlayerTopPos+l.height()+"px",left:"0px"});h.css({top:"0px",
 left:parseInt((e.width()-(h.width()+2*a.imageBorderWidth))/2,10)+"px"});b.imageTopPos=parseInt(h.css("top").substring(0,h.css("top").length-2),10);b.imageLeftPos=parseInt(h.css("left").substring(0,h.css("left").length-2),10);a.autoHidePlayButton&&(d("*").on("click",function(){k.css({display:"none"})}),h.mouseover(function(){k.css({display:"block"})}),h.mouseout(function(){k.css({display:"none"})}),k.mouseover(function(){k.css({display:"block"})}));h.click(function(){k.click();k.css({display:"block"})});
 b.playTopPos=b.frameBehindPlayerTopPos+parseInt((l.height()-k.height())/2,10);b.playLeftPos=parseInt((l.width()-k.width())/2,10);k.css({top:b.playTopPos+"px",left:b.playLeftPos+"px"});a.autoHidePlayButton&&setTimeout(function(){k.fadeOut(1500,function(){})},2E3);a.showNextPrevBut||(n.css({display:"none",width:0,padding:0,margin:0}),p.css({display:"none",width:0,padding:0,margin:0}));b.previousTopPos=b.playTopPos+parseInt((k.height()-n.height())/2,10);b.previousLeftPos=b.imageLeftPos-n.width()-b.constantDistance;
 n.css({top:b.previousTopPos+"px",left:b.previousLeftPos+"px"});b.nextTopPos=b.previousTopPos;b.nextLeftPos=b.imageLeftPos+(h.width()+2*a.imageBorderWidth)+b.constantDistance;p.css({top:b.nextTopPos+"px",left:b.nextLeftPos+"px"});a.showVolume?(b.volumeTopPos=b.nextTopPos+Math.floor((p.height()-r.height())/2),b.volumeLeftPos=parseInt((b.previousLeftPos-(r.width()+u.width()+b.constantDistance))/2,10),r.css({top:b.volumeTopPos+"px",left:b.volumeLeftPos+"px"}),b.volumesliderTopPos=b.volumeTopPos+Math.floor((r.height()-
 u.height())/2),b.volumesliderLeftPos=b.volumeLeftPos+r.width()+b.constantDistance,u.css({top:b.volumesliderTopPos+"px",left:b.volumesliderLeftPos+"px"})):(r.css({display:"none",width:0,padding:0,margin:0}),u.css({display:"none",width:0,padding:0,margin:0}));b.audioPlayerHeight=h.height()+2*a.imageBorderWidth+b.constantDistance+t.height()+b.constantDistance+v.height()+2*b.constantDistance;e.height(b.audioPlayerHeight);f=b.audioPlayerHeight+170+a.playlistTopPos;a.showPlaylist&&a.showPlaylistOnInit||
 (f=b.audioPlayerHeight);B.css({width:e.width()+2*a.playerPadding+"px",height:f+"px"});b.smallButtonDistance=parseInt((a.playerWidth-b.nextLeftPos-p.width()-b.numberOfButtonsRightSide*z.width())/(b.numberOfButtonsRightSide+1),10);b.facebookTopPos=b.nextTopPos+Math.floor((p.height()-g.height())/2);b.facebookLeftPos=b.nextLeftPos+p.width()+b.smallButtonDistance;g.css({top:b.facebookTopPos+"px",left:b.facebookLeftPos+"px"});a.showFacebookBut?(window.fbAsyncInit=function(){FB.init({appId:a.facebookAppID,
 version:"v2.8",status:!0,cookie:!0,xfbml:!0})},function(a,b,c){var d=a.getElementsByTagName(b)[0];a.getElementById(c)||(a=a.createElement(b),a.id=c,a.src="//connect.facebook.com/en_US/sdk.js",d.parentNode.insertBefore(a,d))}(document,"script","facebook-jssdk")):(g.css({display:"none",width:0,padding:0,margin:0}),b.facebookLeftPos=b.nextLeftPos+p.width());g.click(function(){FB.ui({method:"feed",name:a.facebookShareTitle,caption:b.playlist_arr[b.origID].station,description:a.facebookShareDescription,
 link:document.URL},function(a){})});b.twitterTopPos=b.nextTopPos+Math.floor((p.height()-g.height())/2);b.twitterLeftPos=b.facebookLeftPos+g.width()+b.smallButtonDistance;q.css({top:b.twitterTopPos+"px",left:b.twitterLeftPos+"px"});a.showTwitterBut||(q.css({display:"none",width:0,padding:0,margin:0}),b.twitterLeftPos=b.facebookLeftPos+g.width());q.click(function(){window.open("https://twitter.com/intent/tweet?url="+document.URL+"&text="+b.playlist_arr[b.origID].station,"Twitter","status = 1, left = 430, top = 270, height = 550, width = 420, resizable = 0")});
 b.showhideplaylistTopPos=b.nextTopPos+Math.floor((p.height()-z.height())/2);b.showhideplaylistLeftPos=b.twitterLeftPos+q.width()+b.smallButtonDistance;z.css({top:b.showhideplaylistTopPos+"px",left:b.showhideplaylistLeftPos+"px"});v.css({color:a.songTitleColor});t.css({color:a.radioStationColor});b.titleWidth=a.playerWidth-2*a.playlistPadding;b.radioStationTopPos=b.imageTopPos+(h.width()+2*a.imageBorderWidth)+2*b.constantDistance;b.radioStationLeftPos=a.playlistPadding;b.titleTopPos=b.imageTopPos+
 (h.width()+2*a.imageBorderWidth)+2*b.constantDistance+t.height()+b.constantDistance;b.titleLeftPos=a.playlistPadding;t.css({top:b.radioStationTopPos+"px",left:b.radioStationLeftPos+"px"});v.css({top:b.titleTopPos+"px",left:b.titleLeftPos+"px"});m.css({top:b.frameBehindPlayerTopPos+l.height()+"px",left:"0px",height:parseInt(e.height()/2,10)+l.height()+"px"});var y=d(".thumbsHolderWrapper",e),L=d(".playlistPadding",e),F=d(".thumbsHolderVisibleWrapper",e),x=d(".thumbsHolder",e);b.audio4_html5_sliderVertical=
 d(".slider-vertical",e);var C=d(".selectedCategDiv",e),G=d(".innerSelectedCategDiv",e),K=d(".searchDiv",e),H=d(".search_term",e);L.css({padding:a.playlistPadding+"px"});F.append('<div class="readingData">'+a.translateReadingData+"</div>");a.showPlaylist||y.css({opacity:0});a.showPlaylistOnInit||(y.css({opacity:0,"margin-top":"-20px"}),m.css({background:a.beneathTitleBackgroundColor_HiddenPlaylist,opacity:a.beneathTitleBackgroundOpacity_HiddenPlaylist/100,"border-bottom":a.beneathTitleBackgroundBorderWidth+
 "px solid "+a.beneathTitleBackgroundBorderColor}));C.css({"background-color":a.selectedCategBg,"background-position":"10px 50%","margin-bottom":a.selectedCategMarginBottom+"px"});G.css({color:a.selectedCategOffColor,"background-position":a.playerWidth-2*a.playlistPadding-20+"px 50%"});a.showCategories||C.css({display:"none",width:0,height:0,padding:0,margin:0});K.css({"background-color":a.searchAreaBg,"margin-top":a.selectedCategMarginBottom+"px"});H.val(a.searchInputText);H.css({width:parseInt(a.playerWidth-
 2*a.playlistPadding-37,10)+"px","background-color":a.searchInputBg,"border-color":a.searchInputBorderColor,color:a.searchInputTextColor});a.showSearchArea||K.css({display:"none",width:0,height:0,padding:0,margin:0});y.css({width:e.width()+2*a.playerPadding+"px",top:b.audioPlayerHeight+a.playlistTopPos+"px",left:"0px",background:a.playlistBgColor});F.width(e.width());b.playlist_arr=[];b.category_arr=[];d(".xaudioplaylist",e).children().each(function(){currentElement=d(this);b.total_images++;b.playlist_arr[b.total_images-
 1]=[];b.playlist_arr[b.total_images-1].title="";b.playlist_arr[b.total_images-1].station="";b.playlist_arr[b.total_images-1].image="";b.playlist_arr[b.total_images-1].category="";b.playlist_arr[b.total_images-1].radiostream="";null!=currentElement.find(".xtitle").html()&&(b.playlist_arr[b.total_images-1].title=currentElement.find(".xtitle").html());null!=currentElement.find(".xstation").html()&&(b.playlist_arr[b.total_images-1].station=currentElement.find(".xstation").html());null!=currentElement.find(".ximage").html()&&
 (b.playlist_arr[b.total_images-1].image=currentElement.find(".ximage").html());if(null!=currentElement.find(".xcategory").html()&&(b.playlist_arr[b.total_images-1].category=a.translateAllRadioStations+";"+currentElement.find(".xcategory").html()+";",!a.grabStreamnameAndGenre))for(var f=[],f=b.playlist_arr[b.total_images-1].category.split(";"),g=0;g<f.length;g++)f[g]=f[g].trim(),-1===b.category_arr.indexOf(f[g])&&""!=f[g]&&b.category_arr.push(f[g]);null!=currentElement.find(".xradiostream").html()&&
 (b.playlist_arr[b.total_images-1].radiostream=currentElement.find(".xradiostream").html(),-1==b.playlist_arr[b.total_images-1].radiostream.indexOf("/",9)&&(b.playlist_arr[b.total_images-1].radiostream+="/;"),"/"==b.playlist_arr[b.total_images-1].radiostream.charAt(b.playlist_arr[b.total_images-1].radiostream.length-1)&&(b.playlist_arr[b.total_images-1].radiostream+=";"),b.totalRadioStationsNo++,a.grabStreamnameAndGenre&&d.get(a.pathToAjaxFiles+"streamandgenre.php",{the_stream:b.playlist_arr[b.total_images-
 1].radiostream,cur_i:b.total_images-1,translateAllRadioStations:a.translateAllRadioStations,_:d.now()},function(f){b.ajaxReturnedRadioStationsNo++;f=f.split("#----#");2<=f.length&&""==b.playlist_arr[f[0]].station&&(b.playlist_arr[f[0]].station=f[1]);3<=f.length&&""==b.playlist_arr[f[0]].category&&(b.playlist_arr[f[0]].category=f[2]+";");""==b.playlist_arr[f[0]].category&&(b.playlist_arr[f[0]].category=a.translateAllRadioStations);f=b.playlist_arr[f[0]].category.split(";");for(var g=0;g<f.length;g++)f[g]=
 f[g].trim(),-1===b.category_arr.indexOf(f[g])&&""!=f[g]&&b.category_arr.push(f[g]);b.ajaxReturnedRadioStationsNo==b.totalRadioStationsNo&&(b.numberOfCategories=b.category_arr.length,b.selectedCateg=a.firstCateg,b.category_arr.sort(),""==a.firstCateg&&-1===b.category_arr.indexOf(a.firstCateg)&&(b.selectedCateg=b.category_arr[0]),G.html(b.selectedCateg),d(".readingData").remove(),N(b,a,e,x,y,F,C,K,L,k,v,A,t,c,h,B))}))});a.grabStreamnameAndGenre||(b.numberOfCategories=b.category_arr.length,b.selectedCateg=
 a.firstCateg,b.category_arr.sort(),""==a.firstCateg&&-1===b.category_arr.indexOf(a.firstCateg)&&(b.selectedCateg=b.category_arr[0]),G.html(b.selectedCateg),d(".readingData").remove(),N(b,a,e,x,y,F,C,K,L,k,v,A,t,c,h,B));a.grabLastFmPhoto&&(f=new LastFMCache,b.lastfm=new LastFM({apiKey:a.lastFMApiKey,apiSecret:a.lastFMSecret,cache:f}));C.click(function(){b.search_val="";H.val(a.searchInputText);R(b,a,e,x,y,F,C,G,K,L,k,v,A,t,c,h,B)});C.mouseover(function(){G.css({color:a.selectedCategOnColor})});C.mouseout(function(){G.css({color:a.selectedCategOffColor})});
 u.slider({value:a.initialVolume,step:.05,orientation:"horizontal",range:"min",max:1,animate:!0,slide:function(c,d){a.initialVolume=d.value;b.isFlashNeeded?b.myFlashObject.myAS3function(I(b,a,x,e),a.initialVolume):document.getElementById(b.audioID).volume=d.value},stop:function(a,b){}});document.getElementById(b.audioID).volume=a.initialVolume;u.css({background:a.volumeOffColor});d(".ui-slider-range",u).css({background:a.volumeOnColor});k.click(function(){var c=b.isFlashNeeded?!k.hasClass("AudioPause"):
 document.getElementById(b.audioID).paused;S();0==c?(b.isFlashNeeded?b.myFlashObject.myAS3function("_pause_radio_stream_",a.initialVolume):document.getElementById(b.audioID).pause(),k.removeClass("AudioPause")):(b.isFlashNeeded?b.myFlashObject.myAS3function("_play_radio_stream_",a.initialVolume):(document.getElementById(b.audioID).src=I(b,a,x,e),document.getElementById(b.audioID).load(),document.getElementById(b.audioID).play()),k.addClass("AudioPause"))});p.click(function(){!b.categsAreListed&&b.is_very_first&&
 (k.addClass("AudioPause"),a.autoPlay=!0,b.thumbsHolder_Thumbs.css({background:a.playlistRecordBgOffColor,"border-bottom-color":a.playlistRecordBottomBorderOffColor,color:a.playlistRecordTextOffColor}),Q(b,a,"next"),M(b,a,x,e,k,v,A,t,c,h),D(-1,b,a,x))});n.click(function(){!b.categsAreListed&&b.is_very_first&&(k.addClass("AudioPause"),a.autoPlay=!0,b.thumbsHolder_Thumbs.css({background:a.playlistRecordBgOffColor,"border-bottom-color":a.playlistRecordBottomBorderOffColor,color:a.playlistRecordTextOffColor}),
 Q(b,a,"previous"),M(b,a,x,e,k,v,A,t,c,h),D(-1,b,a,x))});z.click(function(){0>y.css("margin-top").substring(0,y.css("margin-top").length-2)?(aux_opacity=1,aux_display="block",aux_margin_top="0px",aux_height=b.audioPlayerHeight+y.height()+a.playlistTopPos,y.css({display:aux_display}),b.selectedCateg_total_images>a.numberOfThumbsPerScreen&&b.audio4_html5_sliderVertical.css({opacity:1,display:"block"}),m.css({background:a.beneathTitleBackgroundColor_VisiblePlaylist,opacity:a.beneathTitleBackgroundOpacity_VisiblePlaylist/
 100,"border-bottom":a.beneathTitleBackgroundBorderWidth+"px solid "+a.beneathTitleBackgroundBorderColor})):(aux_opacity=0,aux_display="none",aux_margin_top="-20px",b.selectedCateg_total_images>a.numberOfThumbsPerScreen&&b.audio4_html5_sliderVertical.css({opacity:0,display:"none"}),m.css({background:a.beneathTitleBackgroundColor_HiddenPlaylist,opacity:a.beneathTitleBackgroundOpacity_HiddenPlaylist/100,"border-bottom":a.beneathTitleBackgroundBorderWidth+"px solid "+a.beneathTitleBackgroundBorderColor}),
 aux_height=b.audioPlayerHeight);y.animate({opacity:aux_opacity,"margin-top":aux_margin_top},500,"easeOutQuad",function(){y.css({display:aux_display})});B.animate({height:aux_height},500,"easeOutQuad",function(){})});r.click(function(){document.getElementById(b.audioID).muted?(document.getElementById(b.audioID).muted=!1,r.removeClass("VolumeButtonMuted"),b.isFlashNeeded&&(a.initialVolume=b.prevVolumeVal,b.myFlashObject.myAS3function(I(b,a,x,e),a.initialVolume))):(document.getElementById(b.audioID).muted=
 !0,r.addClass("VolumeButtonMuted"),b.isFlashNeeded&&(b.prevVolumeVal=a.initialVolume,a.initialVolume=0,b.myFlashObject.myAS3function(I(b,a,x,e),a.initialVolume)))});x.swipe({swipeStatus:function(c,d,e,f,g,h){"up"!=e&&"down"!=e||0==f||(currentScrollVal=b.audio4_html5_sliderVertical.slider("value"),currentScrollVal="up"==e?currentScrollVal-1.5:currentScrollVal+1.5,b.audio4_html5_sliderVertical.slider("value",currentScrollVal),D(currentScrollVal,b,a,x))},threshold:100,maxTimeThreshold:500,fingers:"all"});
 H.on("click",function(){d(this).val("")});H.on("input",function(){b.search_val=H.val().toLowerCase();N(b,a,e,x,y,F,C,K,L,k,v,A,t,c,h,B)});b.isFlashNeeded&&(b.rndNum=parseInt(998999*Math.random()+1E3),e.append("<div id='swfHolder"+b.rndNum+"'></div>"),swfobject.addDomLoadEvent(function(){b.myFlashObject=swfobject.createSWF({data:a.pathToAjaxFiles+"flash_player.swf",width:"0",height:"0"},{flashvars:"streamUrl="+b.playlist_arr[b.origID].radiostream+"&autoPlay="+a.autoPlay+"&initialVolume="+a.initialVolume},
 "swfHolder"+b.rndNum)}),a.autoPlay&&k.addClass("AudioPause"));M(b,a,x,e,k,v,A,t,c,h);-1==E.indexOf("ipad")&&-1==E.indexOf("iphone")&&-1==E.indexOf("ipod")&&-1==E.indexOf("webos")||k.removeClass("AudioPause");var J=function(){b.prevSongTitle="";""==b.origParentFloat&&(b.origParentFloat=e.parent().css("float"),b.origParentPaddingTop=e.parent().css("padding-top"),b.origParentPaddingRight=e.parent().css("padding-right"),b.origParentPaddingBottom=e.parent().css("padding-bottom"),b.origParentPaddingLeft=
 e.parent().css("padding-left"));a.playerWidth!=a.origWidth||a.playerWidth>d(window).width()?e.parent().css({"float":"none","padding-top":0,"padding-right":0,"padding-bottom":0,"padding-left":0}):e.parent().css({"float":b.origParentFloat,"padding-top":b.origParentPaddingTop,"padding-right":b.origParentPaddingRight,"padding-bottom":b.origParentPaddingBottom,"padding-left":b.origParentPaddingLeft});var c=e.parent().parent().width(),f=b.numberOfButtonsRightSide;e.width()!=c&&(a.playerWidth=a.origWidth>
 c?c:a.origWidth,e.width()!=a.playerWidth&&(e.width(a.playerWidth),b.titleWidth=a.playerWidth-2*a.playlistPadding,v.width(b.titleWidth),t.width(b.titleWidth),h.css({top:"0px",left:parseInt((e.width()-(h.width()+2*a.imageBorderWidth))/2,10)+"px"}),b.imageLeftPos=parseInt(h.css("left").substring(0,h.css("left").length-2),10),b.playTopPos=b.frameBehindPlayerTopPos+parseInt((l.height()-k.height())/2,10),b.playLeftPos=parseInt((l.width()-k.width())/2,10),k.css({top:b.playTopPos+"px",left:b.playLeftPos+
 "px"}),b.previousTopPos=b.playTopPos+parseInt((k.height()-n.height())/2,10),b.previousLeftPos=b.imageLeftPos-n.width()-b.constantDistance,n.css({top:b.previousTopPos+"px",left:b.previousLeftPos+"px"}),b.nextTopPos=b.previousTopPos,b.nextLeftPos=b.imageLeftPos+(h.width()+2*a.imageBorderWidth)+b.constantDistance,p.css({top:b.nextTopPos+"px",left:b.nextLeftPos+"px"}),b.volumeTopPos=b.nextTopPos+Math.floor((p.height()-r.height())/2),b.volumeLeftPos=parseInt((b.previousLeftPos-(r.width()+u.width()+b.constantDistance))/
 2,10),r.css({top:b.volumeTopPos+"px",left:b.volumeLeftPos+"px"}),b.volumesliderTopPos=b.volumeTopPos+Math.floor((r.height()-u.height())/2),b.volumesliderLeftPos=b.volumeLeftPos+r.width()+b.constantDistance,u.css({top:b.volumesliderTopPos+"px",left:b.volumesliderLeftPos+"px"}),355>a.playerWidth?a.showTwitterBut&&--f:f=b.numberOfButtonsRightSide,b.smallButtonDistance=parseInt((a.playerWidth-b.nextLeftPos-p.width()-f*z.width())/(f+1),10),b.facebookTopPos=b.nextTopPos+Math.floor((p.height()-g.height())/
 2),b.facebookLeftPos=b.nextLeftPos+p.width()+b.smallButtonDistance,g.css({top:b.facebookTopPos+"px",left:b.facebookLeftPos+"px"}),a.showFacebookBut||(g.css({display:"none",width:0,height:0,padding:0,margin:0}),b.facebookLeftPos=b.nextLeftPos+p.width()),!a.showTwitterBut||355>a.playerWidth?(q.css({display:"none"}),b.twitterLeftPos=b.facebookLeftPos+g.width()-6):(q.css({display:"block"}),b.twitterTopPos=b.nextTopPos+Math.floor((p.height()-g.height())/2),b.twitterLeftPos=b.facebookLeftPos+g.width()+
 b.smallButtonDistance,q.css({top:b.twitterTopPos+"px",left:b.twitterLeftPos+"px"})),b.showhideplaylistTopPos=b.nextTopPos+Math.floor((p.height()-z.height())/2),b.showhideplaylistLeftPos=b.twitterLeftPos+q.width()+b.smallButtonDistance,z.css({top:b.showhideplaylistTopPos+"px",left:b.showhideplaylistLeftPos+"px"}),y.width(e.width()+2*a.playerPadding),F.width(e.width()),C.width(a.playerWidth-2*a.playlistPadding),G.css({"background-position":a.playerWidth-2*a.playlistPadding-20+"px 50%"}),b.selectedCateg_total_images>
 a.numberOfThumbsPerScreen&&a.showPlaylist?(b.audio4_html5_sliderVertical.css({left:e.width()+2*a.playerPadding-b.audio4_html5_sliderVertical.width()-a.playlistPadding+"px"}),d(".thumbsHolder_ThumbOFF",e).css({width:e.width()+2*a.playerPadding-b.audio4_html5_sliderVertical.width()-2*a.playlistPadding-3+"px"})):d(".thumbsHolder_ThumbOFF",e).css({width:e.width()+2*a.playerPadding-2*a.playlistPadding+"px"}),H.css({width:parseInt(a.playerWidth-2*a.playlistPadding-50,10)+"px"})),a.playerWidth<d(window).width()&&
 e.parent().css({"float":b.origParentFloat,"padding-top":b.origParentPaddingTop,"padding-right":b.origParentPaddingRight,"padding-bottom":b.origParentPaddingBottom,"padding-left":b.origParentPaddingLeft}));445>a.playerWidth?(u.css({display:"none"}),r.css({display:"none"})):(u.css({display:"block"}),r.css({display:"block"}))},P=!1;d(window).resize(function(){doResizeNow=!0;-1!=w&&9==w&&0==b.windowWidth&&(doResizeNow=!1);b.windowWidth==d(window).width()?(doResizeNow=!1,a.windowCurOrientation!=window.orientation&&
 -1!=navigator.userAgent.indexOf("Android")&&(a.windowCurOrientation=window.orientation,doResizeNow=!0)):b.windowWidth=d(window).width();a.responsive&&doResizeNow&&(!1!==P&&clearTimeout(P),P=setTimeout(function(){J()},300))});a.responsive&&J()})};d.fn.audio4_html5.defaults={playerWidth:500,skin:"whiteControllers",initialVolume:.5,autoPlay:!0,loop:!0,playerPadding:0,playerBg:"#000000",volumeOffColor:"#454545",volumeOnColor:"#ffffff",timerColor:"#ffffff",songTitleColor:"#000000",radioStationColor:"#000000",
 frameBehindPlayerColor:"#000000",imageBorderWidth:4,imageBorderColor:"#000000",showFacebookBut:!0,facebookAppID:"499867206825745",facebookShareTitle:"HTML5 Radio Player With Playlist - Shoutcast and Icecast",facebookShareDescription:"A top-notch responsive HTML5 Radio Player compatible with all major browsers and mobile devices.",showVolume:!0,showTwitterBut:!0,showRadioStation:!0,showTitle:!0,showPlaylistBut:!0,showPlaylist:!0,showPlaylistOnInit:!0,showNextPrevBut:!0,autoHidePlayButton:!0,beneathTitleBackgroundColor_VisiblePlaylist:"#c55151",
 beneathTitleBackgroundOpacity_VisiblePlaylist:100,beneathTitleBackgroundColor_HiddenPlaylist:"#c55151",beneathTitleBackgroundOpacity_HiddenPlaylist:100,beneathTitleBackgroundBorderColor:"#000000",beneathTitleBackgroundBorderWidth:3,translateRadioStation:"Radio Channel: ",translateSongTitle:"",translateReadingData:"reading data...",translateAllRadioStations:"ALL RADIO STATIONS",playlistTopPos:6,playlistBgColor:"#c55151",playlistRecordBgOffColor:"#000000",playlistRecordBgOnColor:"#00000",
 playlistRecordBottomBorderOffColor:"#333333",playlistRecordBottomBorderOnColor:"#4d4d4d",playlistRecordTextOffColor:"#777777",playlistRecordTextOnColor:"#00b4f9",categoryRecordBgOffColor:"#000000",categoryRecordBgOnColor:"#252525",categoryRecordBottomBorderOffColor:"#2f2f2f",categoryRecordBottomBorderOnColor:"#2f2f2f",categoryRecordTextOffColor:"#777777",categoryRecordTextOnColor:"#00b4f9",numberOfThumbsPerScreen:7,playlistPadding:18,showCategories:!0,firstCateg:"ALL RADIO STATIONS",selectedCategBg:"#000000",
 selectedCategOffColor:"#FFFFFF",selectedCategOnColor:"#00b4f9",selectedCategMarginBottom:12,showSearchArea:!0,searchAreaBg:"#000000",searchInputText:" search...",searchInputBg:"#ffffff",searchInputBorderColor:"#333333",searchInputTextColor:"#333333",responsive:!1,showPlaylistNumber:!0,nowPlayingInterval:15,grabLastFmPhoto:!0,grabStreamnameAndGenre:!0,pathToAjaxFiles:"",noImageAvailable:"noimageavailable.jpg",lastFMApiKey:"6d38069793ab51b1f7f010d8f4d77000",lastFMSecret:"5f1bb73c21038e2ed7125c9ed6205cb8",
 origWidth:0,isSliderInitialized:!1,isProgressInitialized:!1,isPlaylistSliderInitialized:!1}})(jQuery);