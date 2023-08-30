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
use App\Models\{Country, City, User, State, Staff, StaffProfil};

class StaffProfilController extends Controller
{
    /**Verificateur d'accès superadmin  */
    public function can_access(){
        if(Auth::check() && Auth::user()->is_superadmin == 1){
            return true;
        }else{
            return false;
        }
        return true;
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
            $profils = StaffProfil::all();
            $allprofil = array();
            foreach ($profils as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allprofil, $format_data);
            }
            return view('backend.staff-profil', compact('allprofil'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Staff Profil */
    public function createProfilMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'name' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $name = $request->input('name');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{

                /**Sauvegarde des donnees */
                $profil = new StaffProfil();
                $profil->name = $name;
                $profil->author = $author;
                $profil->created_at = $time;
                $profil->save();
            }
            return response()->json([
                'message' => 'L\'opération a réussi!',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Une erreur est survenue contacter l\'useristrateur',
                'status' => 500
            ]);
        }
    }

    /**************************Mise a jour des profiles **************************** */
    public function updateProfilMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $name = $request->input('name');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current profil object */
            $profil = StaffProfil::where('id', $id)->first();
            $profil->name = $name;
            $profil->updated_at = $time;
            $profil->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des profils *************** */
    public function deleteProfilMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            $profil = StaffProfil::where('id', $id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un profil (Bloquer ou Débloquer) **************************** */
    public function statusProfilMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current profil object */
            $profil = StaffProfil::where('id', $id)->first();
            if($profil->is_active == 1){
                $profil->is_active = 0;
            }else{
                $profil->is_active = 1;
            }
            $profil->save();
            $newstatus = $profil->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }
}
