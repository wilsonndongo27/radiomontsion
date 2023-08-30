@extends('backend.template')
@section('linking')
<h1>
    Error 403
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="breadcrumb-item active">Error 403</li>
</ol>
@endsection
@section('body')
	<div class="error-body">
      <div class="error-page">
        <div class="error-content">
         	<div class="container">
         	
        		<h2 class="headline text-red">403</h2>
        		
			  <h3 class="margin-top-0"><i class="fa fa-warning text-red"></i> Forbidden !</h3>

			  <p>
				Désolé vous ne pouvez pas avoir accès à cette page!
			  </p>
				<div class="text-center">
				  <a href="{{ route ('login')}}" class="btn btn-info btn-block btn-flat margin-top-10">Reconnecter vous!</a>
				</div>

          </div>
        </div>
      </div>
      <!-- /.error-page -->
     </div> 
@endsection
