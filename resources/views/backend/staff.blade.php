@extends('backend.template')
@section('linking')
<h1>
    Employés
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="breadcrumb-item active">Employés</li>
</ol>
@endsection
@section('body')
<div class="col-12">
    <div class="box">
        <div class="box-header headerpage">
            <div class="col-lg-8">
                <h3 class="box-title">Liste des Employés</h3>
                <h6 class="box-subtitle">Vous pouvez extraire ou imprimer la liste au format (excel, csv et pdf)</h6>
            </div>
            <div class="col-md-4">
                <i class="fa fa-plus-circle addbtn" id="newstaff"></i>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover display nowrap margin-top-10 table-responsive global-data-table">
                <thead>
                    <tr>
                        <th>Photos</th>
                        <th>Noms</th>
                        <th>Poste</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Adresses</th>
                        <th>Status</th>
                        <th>></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($allstaff ?? '')
                        @foreach ($allstaff as $item)
                            <tr>
                                <td class="imagecolumn">
                                    <a href="Javascript:void()" id="detailmodal"
                                    data-name="{{ $item->name }}"
                                    data-profil="{{ $item->profil }}"
                                    data-email="{{ $item->email }}"
                                    data-phone="{{ $item->phone }}"
                                    data-status="{{ $item->is_active }}"
                                    data-photo="{{ asset('storage/'.$item->pp) }}"
                                    >
                                        <img class="zoom"  style="border-radius: 100%;"
                                        @if ($item->pp) 
                                            src="{{ asset('storage/'.$item->pp) }}" 
                                        @else
                                            src="{{ asset('image/user-default.png') }}" 
                                        @endif 
                                        alt="{{$item->pp}}" alt="" />
                                    </a>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->profil }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->city }}</td>
                                <td>{{ $item->address }}</td>
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
                                                data-message="Le status de cette employé sera mis à jour!"
                                                data-type="warning"
                                                data-url="{{ route ('status-staff')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="fa fa-ban"></i> Activer/Désactiver</a>
                                            <a class="dropdown-item" href="javascript:void()" id="updatestaff"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-email="{{ $item->email }}"
                                                data-phone="{{ $item->phone }}"
                                                data-profil="{{ $item->profil }}"
                                                data-profilid="{{ $item->profilid }}"
                                                data-country="{{ $item->country }}"
                                                data-countryid="{{ $item->countryid }}"
                                                data-state="{{ $item->state }}"
                                                data-stateid="{{ $item->stateid }}"
                                                data-city="{{ $item->city }}"
                                                data-cityid="{{ $item->cityid }}"
                                                data-address="{{ $item->address }}"
                                                data-description="{{ $item->description }}"
                                                data-pp="{{ asset('storage/'.$item->pp) }}">
                                                <i class="fa fa-edit"></i> Modifier
                                            </a>
                                            <a class="dropdown-item deleteForm" 
                                                href="javascript:void()" 
                                                data-id="{{$item->id}}"
                                                data-message="Cette employé sera supprimer!"
                                                data-type="warning"
                                                data-url="{{ route ('delete-staff')}}"
                                                data-token="{{csrf_token()}}">
                                                <i class="fa fa-trash"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr >
                            <td colspan="12" class="text-primary text-center" >
                                <p style="font-size: 14px; margin-top:50px; color:#888">Aucun employé enregistré pour l'instant!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->     
    
    <!-- modale ajouter un Employé -->
    <div id="AddStaffModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Ajouter un employé</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route ('create-staff')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p style="color: #888">Nom complet</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="name" required placeholder="nom de l'employé" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" id="country-dropdown" required name="country" url="{{ route ('get-states-by-country')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner le pays de résidence</option>
                                        @foreach ($countries as $country) 
                                            <option value="{{$country->id}}">
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Région</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" id="state-dropdown" required name="state" url="{{ route ('get-cities-by-state')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner la Région</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Ville</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" name="city" id="city-dropdown" required>
                                        <option value="">Selectionner le pays</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="text" class="form-control" name="address" required placeholder="adresse de l'employé" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Numéro de téléphone</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control"  name="phone" required placeholder="numéro de téléphone de l'employé" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse email</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" autocomplete="off" class="form-control" name="email" required placeholder="email de l'employé" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Bibliographie</p>
                                <div class="form-group label-floating">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content"  name="description" type="hidden"/>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Poste de l'enployé</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" required name="profil">
                                        <option value="">Selectionner le poste</option>
                                        @foreach ($allprofil as $staff) 
                                            <option value="{{$staff->id}}">
                                                {{$staff->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de l'employé</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="photo" required  />
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttomcreate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->

    <!-- modale modifier un staff -->
    <div id="UpdateStaffModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Modifier cet Employé</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route ('update-staff')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="staffid">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Nom complet</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input class="form-control"  name="name" id="staffname" placeholder="nom de l'employé" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Poste de l'enployé</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control" name="profil" id="staffprofil">
                                        @foreach ($allprofil as $staff) 
                                            <option value="{{$staff->id}}">
                                                {{$staff->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Pays de résidence</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control staffcountry" id="country-dropdown-update" name="country" url="{{ route ('get-states-by-country')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner le pays</option>
                                        @foreach ($countries as $country) 
                                            <option value="{{$country->id}}">
                                                {{$country->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Région</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control staffstate" id="state-dropdown-update" name="state" url="{{ route ('get-cities-by-state')}}" token="{{csrf_token()}}">
                                        <option value="">Selectionner la Région</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Ville</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <select class="form-control staffcity" name="city" id="city-dropdown-update">
                                        <option value="">Selectionner le pays</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="text" class="form-control" name="address" id="staffaddress" placeholder="adresse de l'employé" />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Numéro de téléphone</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="number" class="form-control"  name="phone" id="staffphone" placeholder="numéro de téléphone de l'employé" />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <p style="color: #888">Adresse email</p>
                                <div class="form-group label-floating" style="width: 100%;">
                                    <input type="email" autocomplete="off" class="form-control" name="email" id="staffemail" placeholder="email de l'employé" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Bibliographie</p>
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
                                <img src="" alt="" id="staffpp" class="updateimage">
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <p style="color: #888">Photo de profile</p>
                                <div class="form-group label-floating" style="width: 100%;" >
                                    <input type="file" class="form-control" id="photo" name="photo"  />
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="buttonupdate btn btn-primary newBtn">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->
</div>
@endsection