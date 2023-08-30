<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\{Country, City, User, State, InfoCompany};

class companyController extends Controller
{
    /**Verificateur d'accès superadmin  */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return true;
        }else{
            return false;
        }
    }

    /**Verificateur d'accès admins  */
    public function can_access_admin(){
        if(Auth::check() && Auth::user()->is_admin == 1){
            return true;
        }else{
            return false;
        }
    }

    /**Verification si l'email existe dans le system ou pas */
    public function Check_email_exist($data){
        $user = DB::table('users')->where('email', $data)->first();
        if($user === null){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $data['company'] = InfoCompany::where('is_active', 1)->first();
            return view('backend.company', $data);
        }else{
            return view('backend.403');
        }
    }

    /**Create Company */
    public function createCompanyMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            #controle de validation des elements
            $this->validate($request,[
                'name'=>'required',
                'vision'=>'required',
                'objectif'=>'required',
                'mapLink'=>'required',
                'logo'=>'required'
            ]);

            $name = $request->input('name');
            $contexte = $request->input('contexte');
            $vision = $request->input('vision');
            $objectif = $request->input('objectif');
            $mapLink = $request->input('mapLink');
            $logo = $request->file('logo');
            $cover = $request->file('cover');

            #enregistrement du logo
            $extensionlogo = $logo->getClientOriginalExtension();
            Storage::disk('public')->put($logo->getFilename().'.'.$extensionlogo,  File::get($logo));

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $company = new InfoCompany();

            #enregistrement de la photo de couverture
            if($cover != null){
                $extensioncover = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extensioncover,  File::get($cover));
                $company->cover = $cover->getFilename().'.'.$extensioncover;
            }

            $company->name = $name;
            $company->vision = $vision;
            $company->objectif = $objectif;
            $company->map = $mapLink;
            $company->logo = $logo->getFilename().'.'.$extensionlogo;
            $company->created_at = $time;
            $company->updated_at = $time;
            $company->save();
            return response()->json([
                'message' => 'L\'opération a réussi!',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Une erreur est survenue contacter l\'administrateur',
                'status' => 500
            ]);
        }
    }

    /**************************Mise a jour de l'entreprise **************************** */
    public function updateCompanyMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $name = $request->input('name');
            $vision = $request->input('vision');
            $objectif = $request->input('objectif');
            $mapLink = $request->input('mapLink');
            $logo = $request->file('logo');
            $cover = $request->file('cover');

            $time = \Carbon\Carbon::now()->toDateTimeString();

            $company = InfoCompany::where('id', 1)->first();

            #enregistrement du logo
            if($logo != null){
                //code for remove old file
                Storage::disk('public')->delete($company->logo);

                $extensionlogo = $logo->getClientOriginalExtension();
                Storage::disk('public')->put($logo->getFilename().'.'.$extensionlogo,  File::get($logo));
                $company->logo = $logo->getFilename().'.'.$extensionlogo;
            }

            #enregistrement de la photo de couverture
            if($cover != null){
                //code for remove old file
                Storage::disk('public')->delete($company->cover);

                $extensioncover = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extensioncover,  File::get($cover));
                $company->cover = $cover->getFilename().'.'.$extensioncover;
            }

            $company->name = $name;
            $company->vision = $vision;
            $company->objectif = $objectif;
            $company->map = $mapLink;
            $company->updated_at = $time;
            $company->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }
}
