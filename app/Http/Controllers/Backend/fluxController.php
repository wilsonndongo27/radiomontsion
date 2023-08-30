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
use App\Models\{Banners, User, News, Radios};

class fluxController extends Controller
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
            $radios = Radios::all();
            $allradio = array();
            foreach ($radios as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'flux' => $item->flux,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allradio, $format_data);
            }
            return view('backend.radio', compact('allradio'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Flux Radio */
    public function createRadioMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'description' => 'required',
                'flux' => 'required',
                'cover' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $description = $request->input('description');
            $flux = $request->input('flux');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $file = $request->file('cover');

            if( $request->hasFile('cover')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();
            }else{
                $extension = '';
                $filename = '';
            }

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filename.'.'.$extension, File::get($file));

                /**Sauvegarde des donnees */
                $radio = new Radios();
                $radio->title = $title;
                $radio->description = $description;
                $radio->author = $author;
                $radio->cover = $filename.'.'.$extension;
                $radio->created_at = $time;
                $radio->flux = $flux;
                $radio->save();
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

    /**************************Mise a jour des radios **************************** */
    public function updateRadioMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $description = $request->input('description');
            $flux = $request->input('flux');
            $file = $request->file('cover');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current banner object */
            $radio = Radios::where('id', $id)->first();

            if( $request->hasFile('cover')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $radio->cover = $filename.'.'.$extension;
            }
            $radio->title = $title;
            $radio->description = $description;
            $radio->flux = $flux;
            $radio->updated_at = $time;
            $radio->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des radios *************** */
    public function deleteRadioMethod(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $radio = Radios::where('id', $id)->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une radio (Bloquer ou Débloquer) **************************** */
    public function statusRadioMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $radio = Radios::where('id', $id)->first();
            if($radio->is_active == 1){
                $radio->is_active = 0;
            }else{
                $radio->is_active = 1;
            }
            $radio->save();
            $newstatus = $radio->is_active;
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
