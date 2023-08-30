<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from apro-admin-templates.websitedesignmarketingagency.com/aproadmin/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Jul 2023 18:40:08 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Radio Mont Sion">
    <meta name="keywords" content="Mont Sion, Radio, Dieu, Message, Bible, Bonne Nouvelle">
    <meta name="author" content="Radio Mon Sion">
    <link rel="icon" type="image/png') }}" href="{{ asset ('images/logomini.jpeg') }}">

    <title>Mont Sion Radio - Admin Connexion </title>

    
    <link rel="stylesheet" href="{{ asset ('backend/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('backend/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">
    <link rel="stylesheet" href="{{ asset ('backend/assets/vendor_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('backend/assets/vendor_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('backend/css/master_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('backend/css/skins/_all-skins.css') }}">	
    <link rel="stylesheet" href="{{asset('backend/css/toastr.min.css')}}">    

    
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset ('backend/css/custom.css') }}">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Mont Sion Radio</b> Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Connectez vous pour commencer votre session</p>

    <form id="loginadminform" lpformnum="1" method="post" enctype="multipart/form-data" action="{{ route('login-admin') }}">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" required class="form-control" placeholder="Email">
        <span class="ion ion-email form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback"> 
        <div class="input-group" id="show_hide_password">
            <input class="form-control py-4" id="inputPassword" style="font-size:14px" @error('password') 
            is-invalid @enderror type="password" name="password" required autocomplete="current-password" 
            placeholder="Enter password" />
            <div class="input-group-addon">
                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="checkbox">
            <input type="checkbox" id="basic_checkbox_1" >
			      <label for="basic_checkbox_1">Remember Me</label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-6">
         <div class="fog-pwd">
          	<a href="javascript:void(0)"><i class="ion ion-locked"></i> Mot de passe oublié?</a><br>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" id="buttonlogin" class="btn btn-block btn-flat margin-top-10 btn-primary">Connexion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


	<!-- jQuery 3 -->
	<script src="{{ asset ('backend/assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/popper/dist/popper.min.js') }}"></script>
	<script src="{{ asset ('backend/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{asset("backend/js/toastr.min.js")}}"></script>  
  <script src="{{ asset ('backend/js/login.js') }}"></script>

</body>

<!-- Mirrored from apro-admin-templates.websitedesignmarketingagency.com/aproadmin/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Jul 2023 18:40:08 GMT -->
</html>
