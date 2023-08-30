@extends('backend.template')
@section('linking')
<h1>
    Entreprise
</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="breadcrumb-item active">Entreprise</li>
</ol>
@endsection
@section('body')
<div class="box">
    <div class="box-header headerpage">
        <div class="col-lg-8">
            <h3 class="box-title">Information de l'entreprise</h3>
            <h6 class="box-subtitle">Vous pouvez extraire ou imprimer la liste au format (excel, csv et pdf)</h6>
        </div>
        <div class="col-md-4">
            <a href="javascript:void()" 
                id="updatecompany"
                @if ($company ?? '')
                    data-name="{{$company->name}}"
                    data-vision="{{$company->vision}}"
                    data-objectif="{{$company->objectif}}"
                    data-maplink="{{$company->map}}"
                    data-logo="{{ asset ('storage/'.$company->logo) }}"
                    data-cover="{{ asset ('storage/'.$company->cover) }}"
                @endif
                >
                @if ($company ?? '')
                    <i class="fa fa-edit addbtn"></i>
                @endif
            </a>
        </div>
    </div>
    <table id="articles-table" class="table shadow-card">
        @if ($company ?? '')
            <tr>
                <td colspan="7" class="text-primary text-left infocompanyview" >
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-xs-12 BlockInfo">
                            <p>Nom : <span class="valuetextent">{{$company->name}}</span></p>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <p>Email : <span class="valuetextent">{{$company->email1}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr >
                <td colspan="7" class="text-primary text-left infocompanyview">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-xs-12 BlockInfo">
                            <p>Vision : <span class="valuetextent">{{$company->vision}}</span></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-xs-12">
                            <p>Mission : <span class="valuetextent">{{$company->mission}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="7" class="text-primary text-left infocompanyview">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-xs-12 BlockInfo">
                            <p>Objectif : <span class="valuetextent">{!! html_entity_decode($company->objectif) !!}</span></p>
                        </div>
                        <div class="col-lg-5 col-md-12 col-xs-12">
                            <p>Map : <span class="valuetextent">{{$company->map}}</span></p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-primary text-left infocompanyview">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-xs-12 BlockInfo">
                            <p>Logo de l'company</p>
                            <img src="{{ asset ('storage/'.$company->logo) }}" alt="">
                        </div>
                        <div class="col-lg-5 col-md-12 col-xs-12">
                            @if ($company->cover ?? '')
                                <p>Photo de couverture de l'company</p>
                                <img src="{{ asset ('storage/'.$company->cover) }}" alt="">
                            @else
                                <p>Aucune photo de couverture enregistrer!</p>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @else
            <tr >
                <td colspan="7" class="text-primary text-center" >
                    <a href="#" class="btn btn-primary" id="addCompany">
                        Aucune information enregistrer, veuillez cliquer ici pour enregistrer!
                    </a>
                </td>
            </tr>
        @endif
    </table>

    <!-- modale de add infos company -->
    <div id="companyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Ajouter les informations de entreprise</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="createform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmission()" action="{{ route('create-company')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Nom de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="name" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>La vision de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <textarea class="form-control" name="vision"  required rows="6" placeholder="La vision de l'entreprise"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Objectifs de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <div class="editor" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content" name="objectif" type="hidden"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Adresse google map de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="mapLink" required placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Logo de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="logo" name="logo" required  />
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Photo de couverture de l'entreprise (Optionnel)</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="cover" name="cover"  />
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

    <!-- Modale pour mettre les informations de l'entreprise -->
    <div id="updateCompanyModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row">
                    <img class="col-lg-2 logoform" src="{{asset('images/logomini.jpeg')}}"/>
                    <h4 class="col-lg-7 modal-title">Mise à jour des informations de l'entreprise</h4>
                    <button type="button" class="col-lg-2 close" data-dismiss="modal">&times;</button>
                </div>
                <form class="updateform" lpformnum="1"  method="post" enctype="multipart/form-data" onsubmit="postSubmissionUpdate()" action="{{ route('update-company')}}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Nom de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" name="name" id="companyname" required placeholder="Nom" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>La vision de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <textarea class="form-control" name="vision" id="companyvision"  required rows="6" placeholder="La vision de l'company"></textarea>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Objectifs de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <div class="editorupdate" style="height:40vh">
                                    </div>
                                    <input class="form-control post-content-update" name="objectif" type="hidden"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p>Adresse google map de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input class="form-control" id="companymap" name="mapLink" placeholder="Map" />
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12">
                                <img src="" alt="" class="updateimage" id="companylogo">
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Logo de l'entreprise</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="logo" name="logo"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-12 col-xs-12" >
                                <img src="" alt="" class="updateimage" id="companycover">
                            </div>
                            <div class="col-lg-5 col-md-12 col-xs-12 col-xs-12" >
                                <p>Photo de couverture de l'entreprise (Optionnel)</p>
                                <div class="form-group label-floating">
                                    <input type="file" class="form-control" id="cover" name="cover"  />
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-bg-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary newBtn buttonupdate">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end popup -->
</div>
@endsection

