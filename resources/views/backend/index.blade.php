@extends('backend.template')
@section('linking')
<h1>
    Accueil
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection
@section('body')
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-xl-3 col-md-6 col-12">
    <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

    <div class="info-box-content">
        <span class="info-box-number">000</span>
        <span class="info-box-text">Visiteurs</span>
    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-xl-3 col-md-6 col-12">
    <div class="info-box">
    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

    <div class="info-box-content">
        <span class="info-box-number">{{$alluser}}</span>
    <span class="info-box-text">Utilisateurs</span>
    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix visible-sm-block"></div>

<div class="col-xl-3 col-md-6 col-12">
    <div class="info-box">
    <span class="info-box-icon bg-purple"><i class="fa fa-cubes"></i></span>

    <div class="info-box-content">
        <span class="info-box-number">{{$allproduct}}</span>
        <span class="info-box-text">Services & Produits</span>
    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-xl-3 col-md-6 col-12">
    <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-handshake-o"></i></span>

    <div class="info-box-content">
        <span class="info-box-number">{{$allpartner}}</span>
        <span class="info-box-text">Partenaires</span>
    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
</div>
 <!-- /.row -->
<div class="row">
    <!-- /.col -->        
    <div class="col-xl-12 connectedSortable">
    <!-- MAP & BOX PANE -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">Nos visiteurs</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
        <div class="row">
            <div class="col-lg-9 col-md-8">
            <div class="pad">
                <!-- Map will be created here -->
                <div id="visitfromworld" style="height: 300px;"></div>
            </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-md-4">
            <div class="row pad box-pane-right bg-blue m-0">
                <div class="col-4 col-sm-12 description-block margin-bottom p-0">
                <div class="sparkbar pad" data-color="#fff">80,60,95,70,75,80,50</div>
                <h5 class="description-header">7458</h5>
                <span class="description-text">bloc produits</span>
                </div>
                <!-- /.description-block -->
                <div class="col-4 col-sm-12 description-block margin-bottom p-0">
                <div class="sparkbar pad" data-color="#fff">70,40,85,70,61,93,63</div>
                <h5 class="description-header">56%</h5>
                <span class="description-text">bloc partenaires</span>
                </div>
                <!-- /.description-block -->
                <div class="col-4 col-sm-12 description-block p-0">
                <div class="sparkbar pad" data-color="#fff">80,55,91,70,81,43,67</div>
                <h5 class="description-header">85%</h5>
                <span class="description-text">bloc news</span>
                </div>
                <!-- /.description-block -->
            </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->          
    </div>		  
</div>   
@endsection