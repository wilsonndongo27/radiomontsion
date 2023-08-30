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
use App\Models\{Banners, User, News, Programs};

class programController extends Controller
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
            $programs = Programs::all();
            $allprogram = array();
            foreach ($programs as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'label' => $item->label,
                    'date' => $item->date,
                    'time_start' => $item->time_start,
                    'time_end' => $item->time_end,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allprogram, $format_data);
            }
            return view('backend.program', compact('allprogram'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Program */
    public function createProgramMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'label' => 'required',
                'description' => 'required',
                'date' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
                'cover' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $file = $request->file('cover');
            $date = $request->input('date');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');

            if( $request->hasFile('cover')){
                $extensioncover = strtolower($file->getClientOriginalExtension());
                $filenamecover = $file->getClientOriginalName();
            }else{
                $extensioncover = '';
                $filenamecover = '';
            }

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filenamecover.'.'.$extensioncover, File::get($file));

                /**Sauvegarde des donnees */
                $program = new Programs();
                $program->title = $title;
                $program->label = $label;
                $program->description = $description;
                $program->date = $date;
                $program->time_start = $time_start;
                $program->time_end = $time_end;
                $program->author = $author;
                $program->cover = $filenamecover.'.'.$extensioncover;
                $program->created_at = $time;
                $program->save();
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

    /**************************Mise a jour des Prorammes **************************** */
    public function updateProgramMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $file = $request->file('cover');
            $date = $request->input('date');
            $time_start = $request->input('time_start');
            $time_end = $request->input('time_end');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current banner object */
            $program = Programs::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($program->cover);

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $program->cover = $filename.'.'.$extension;
            }

            $program->title = $title;
            $program->label = $label;
            $program->description = $description;
            $program->date = $date;
            $program->time_start = $time_start;
            $program->time_end = $time_end;
            $program->updated_at = $time;
            $program->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des Program *************** */
    public function deleteProgramMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            $program = Programs::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($program->cover);
            // delete object
            $program->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un programme (Bloquer ou Débloquer) **************************** */
    public function statusProgramMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $program = Programs::where('id', $id)->first();
            if($program->is_active == 1){
                $program->is_active = 0;
            }else{
                $program->is_active = 1;
            }
            $program->save();
            $newstatus = $program->is_active;
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
