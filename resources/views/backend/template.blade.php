<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from apro-admin-templates.websitedesignmarketingagency.com/aproadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Jul 2023 18:23:51 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mont Sion Radio">
    <meta name="author" content="Mont Sion Radio">
    <link rel="icon" type="image/png') }}" href="{{ asset ('images/logomini.jpeg') }}">

    <title>Mont Sion - Dashboard</title>
    
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/css/master_style.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/weather-icons/weather-icons.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{asset ('backend/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="{{asset ('backend/assets/vendor_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/toastr.min.css')}}">    
    <link rel="stylesheet" href="{{ asset ('backend/css/quill.snow.css')}}"/>

    
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset ('backend/css/custom.css') }}">

     
  </head>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset ('images/logomini.jpeg') }}" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Mont Sion Radio</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Vous avez 0 message</li>

              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu inner-content-div">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset ('images/user-default.jpeg') }}" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                            User 1
                            <small><i class="fa fa-clock-o"></i> Hier</small>
                          </h4>
                          <span>Ceci est une notification test.</span>
                      </div>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="footer"><a href="#">See all e-Mails</a></li>
            </ul>
          </li>

		      <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="@if (Auth::check() && Auth::user()->pp)
                  {{asset ('storage/'.Auth::user()->pp) }}
                @else
                  {{asset ('images/user-default.png') }}  @endif" 
              class="user-image rounded-circle" alt="User Image">
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- User image -->
              <li class="user-header">
                <img src="@if (Auth::check() && Auth::user()->pp)
                    {{asset ('storage/'.Auth::user()->pp) }}
                  @else
                    {{asset ('images/user-default.png') }}  @endif" 
                class="float-left rounded-circle" alt="User Image">

                <p>
                  @if (Auth::check())
                    {{ Auth::user()->name}}
                    <small class="mb-5">{{ Auth::user()->email}}</small>
                  @else
                  @endif
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row no-gutters">
                  <div class="col-12 text-left">
                    <a href="#"><i class="ion ion-person"></i> Mon Profil</a>
                  </div>
                  <div class="col-12 text-left">
                    <a href="#"><i class="ion ion-email-unread"></i> Boite Mail</a>
                  </div>
                  <div class="col-12 text-left">
                    <a href="#"><i class="ion ion-settings"></i> Paramètre</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-block btn-danger Logout"
                  data-url="{{ route ('logout-admin')}}"
                  ><i class="ion ion-power"></i> Déconnexion</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image float-left">
          <img src="@if (Auth::check() && Auth::user()->pp)
            {{asset ('storage/'.Auth::user()->pp) }}
          @else
            {{asset ('images/user-default.png') }}  @endif"
          class="rounded-circle" alt="User Image">
        </div>
        <div class="info float-left">
          @if (Auth::check())
            <p>{{Auth::user()->name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          @else
          @endif
        </div>
		  <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="active">
          <a href="index.html">
            <i class="fa fa-home"></i> <span>Accueil</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Utilisateurs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('home-users')}}">Gestion des Utilisateurs</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Paramètrages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('company')}}">Information sur l'entreprise</a></li>
            <li><a href="{{ route ('staff-profil')}}">Gestion des profils</a></li>
            <li><a href="{{ route ('staff')}}">Gestion du personnel</a></li>
            <li><a href="{{ route ('achievement')}}">Gestion des réalisations</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i>
            <span>Advertizings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('banner')}}">Gestion de la Bannière</a></li>
            <li><a href="{{ route ('news')}}">Gestion des Actualités</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cube"></i>
            <span>Services</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('product')}}">Gestion des Services</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i>
            <span>Web Radios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('radio')}}"><i class="fa fa-signal pull-left"></i> Gestion des Flux</a></li>
            <li><a href="{{ route ('program')}}"><i class="fa fa-calendar pull-left"></i> Gestion Programmes</a></li>
            <li><a href="{{ route ('podcast')}}"><i class="fa fa-podcast pull-left"></i> Gestion des Poadcasts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-handshake-o"></i>
            <span>Partenaires</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route ('partner')}}">Gestion des Partenaires</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-headphones"></i>
            <span>Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">List des messages</a></li>
          </ul>
        </li>      
        
      </ul>
    </section>
    <!-- /.sidebar -->
    <div class="sidebar-footer">
		<!-- item-->
		<a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="fa fa-cog fa-spin"></i></a>
		<!-- item-->
		<a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="fa fa-envelope"></i></a>
		<!-- item-->
		<a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="fa fa-power-off"></i></a>
	</div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('linking')
    </section>

    <!-- Main content -->
    <section class="content">

        @yield('body')
        
        <!-- /.row -->
      
	  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
    </div>Copyright &copy; <span class="copydate"></span> <a href="https://montsionradio.com">Mont Sion Radio</a>. All Rights Reserved, By <a href="https://polyh-sa.com">POLYH</a>
  </footer>
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
  	
	 
	  
	<!-- jQuery 3 -->
	<script src="{{ asset ('backend/assets/vendor_components/jquery/dist/jquery.js') }}"></script>
	
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset ('backend/assets/vendor_components/jquery-ui/jquery-ui.js') }}"></script>
	
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	
	<!-- popper -->
	<script src="{{ asset ('backend/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

	<!-- Bootstrap 4.0-->
	<script src="{{ asset ('backend/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>	
	<script src="{{ asset ('backend/assets/vendor_components/chart-js/chart.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>	
	<script src="{{ asset ('backend/assets/vendor_plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>
	<script src="{{ asset ('backend/js/template.js') }}"></script>
	<script src="{{ asset ('backend/js/pages/dashboard.js') }}"></script>
	<script src="{{ asset ('backend/js/demo.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_plugins/weather-icons/WeatherIcon.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
  
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/ex-js/jszip.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/ex-js/pdfmake.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/ex-js/vfs_fonts.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js') }}"></script>
  <!-- end - This is for export functionality only -->

  <script src="{{ asset ('backend/js/pages/data-table.js') }}"></script>
	
	<script type="text/javascript">
		WeatherIcon.add('icon1'	, WeatherIcon.SLEET , {stroke:false , shadow:false , animated:true } );
		WeatherIcon.add('icon2'	, WeatherIcon.SNOW , {stroke:false , shadow:false , animated:true } );
		WeatherIcon.add('icon3'	, WeatherIcon.LIGHTRAINTHUNDER , {stroke:false , shadow:false , animated:true } );

    var data = new Date();
    $('.copydate').text(data.getFullYear());

    </script>
    <script src="{{ asset ('backend/js/quill.js') }}"></script>
    <script src="{{ asset ('backend/assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{asset("backend/js/toastr.min.js")}}"></script>  

    <!-- Custom JS -->
    <script src="{{ asset ('backend/js/script.js') }}"></script>
    <script src="{{ asset ('backend/js/user.js') }}"></script>
    <script src="{{ asset ('backend/js/company.js') }}"></script>
    <script src="{{ asset ('backend/js/banner.js') }}"></script>	
    <script src="{{ asset ('backend/js/news.js') }}"></script>	
    <script src="{{ asset ('backend/js/product.js') }}"></script>
    <script src="{{ asset ('backend/js/partner.js') }}"></script>
    <script src="{{ asset ('backend/js/achievement.js') }}"></script>
    <script src="{{ asset ('backend/js/staff-profil.js') }}"></script>
    <script src="{{ asset ('backend/js/staff.js') }}"></script>
    <script src="{{ asset ('backend/js/podcast.js') }}"></script>
    <script src="{{ asset ('backend/js/radio.js') }}"></script>
    <script src="{{ asset ('backend/js/program.js') }}"></script>
</body>

<!-- Mirrored from apro-admin-templates.websitedesignmarketingagency.com/aproadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Jul 2023 18:24:44 GMT -->
</html>
