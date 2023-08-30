@extends('backend.template')
@section('linking')
<h1>
    Bannières
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="breadcrumb-item active">Bannières</li>
</ol>
@endsection
@section('body')
<div class="col-12">
    <div class="box">
        <div class="box-header headerpage">
            <div class="col-lg-8">
                <h3 class="box-title">Liste des Bannières</h3>
            </div>
            <div class="col-md-4">
                <i class="fa fa-plus-circle addbtn" id="newbanner"></i>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Label</th>
                        <th>Auteur</th>
                        <th>Date de création</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allbanner ?? '')
                        @foreach ($allbanner as $item)
                            <tr>
                                <td class="imagecolumn">
                                    <a href="Javascript:void()" id="detailmodal"
                                    data-name="{{ $item->title }}"
                                    data-phone="{{ $item->label }}"
                                    data-email="{{ $item->description }}"
                                    data-status="{{ $item->is_active }}"
                                    data-photo="{{ asset('storage/'.$item->cover) }}"
                                    >
                                        <img class="zoom"  style="border-radius: 10px;"
                                        @if ($item->cover) 
                                            src="{{ asset('storage/'.$item->cover) }}" 
                                        @else
                                            src="{{ asset('image/user-default.png') }}" 
                                        @endif 
                                        alt="{{$item->cover}}" alt="" />
                                    </a>
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->author }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->is_active == 1)
                                        <span class="activeitem">Actif</span>
                                    @else
                                        <span class="activeitem">inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btnoptions">Options</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item statusForm" href="javascript:void()"
                                                data-id="{{$item->id}}"
                                                data-message="Le status de cet bannière sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-banner')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="fa fa-ban"></i> Activer/Désactiver</a>
                                            <a class="dropdown-item" href="javascript:void()" id="updatebanner"
                                                data-id="{{ $item->id }}"
                                                data-title="{{ $item->title }}"
                                                data-label="{{ $item->label }}"
                                                data-description="{{ $item->description }}"
                                                data-cover="{{ asset('storage/'.$item->cover) }}">
                                                <i class="fa fa-edit"></i> Modifier
                                            </a>
                                            <a class="dropdown-item deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cette bannière sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-banner')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr >
                            <td colspan="7" class="text-primary text-center" >
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucune bannière enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter une Bannière -->
    <div id="AddBannerModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Ajouter une Bannière</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-banner')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="author" value="{{Auth::user()->id}}">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Titre</p>
                                <div class="form-group label-floating">
                                    <input class="form-control"  name="title" required placeholder="titre de la bannière..." />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Libellé</p>
                                <div class="form-group label-floating">
                                    <input type="text" class="form-control"  name="label" required placeholder="Libellé..." />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Description</p>
                                <div class="form-group label-floating">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content" name="description" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" >
                                <p>Image de la bannière</p>
                                <div class="form-group label-floating" >
                                    <input type="file" class="form-control" id="cover" name="cover" required  />
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="buttomcreate btn btn-primary newBtn">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale modifier une bannière -->
    <div id="updateBannerModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Modifier cette Bannière</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-banner')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="bannerid">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Titre</p>
                                <div class="form-group label-floating">
                                    <input class="form-control"  name="title" id="bannertitle" placeholder="titre de la bannière..." />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Libellé</p>
                                <div class="form-group label-floating">
                                    <input type="text" class="form-control" id="bannerlabel"  name="label" placeholder="Libellé..." />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Description</p>
                                <div class="form-group label-floating">
                                    <div class="editorupdate" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content-update"  name="description" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <img src="" alt="" class="updateimage" id="bannercover">
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p>Image de la bannière</p>
                                <div class="form-group label-floating" >
                                    <input type="file" class="form-control" id="cover" name="cover"  />
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="buttonupdate btn-primary newBtn">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

</div>
@endsection