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
use App\Models\{Banners, User, News, Podcasts, Programs};

class podcastController extends Controller
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
            $podcasts = Podcasts::all();
            $allpodcast = array();
            foreach ($podcasts as $item) {
                $author = User::where('id', $item->author)->first();
                $program = Programs::where('id', $item->program)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'program' => $program->title,
                    'programid' => $program->id,
                    'audio' => $item->audio,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allpodcast, $format_data);
            }
            $allprogram = Programs::where('is_active', 1)->get();
            return view('backend.podcast', compact('allpodcast', 'allprogram'));
        }else{ 
            return view('backend.403');
        }
    }

    /**Create Podcast */
    public function createPodcastMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'label' => 'required',
                'description' => 'required',
                'program' => 'required',
                'audio' => 'required',
                'cover' => 'required',
                'author' => 'required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $program = $request->input('program');
            $author = $request->input('author');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $file = $request->file('cover');
            $audio = $request->file('audio');

            if( $request->hasFile('cover')){
                $extensioncover = strtolower($file->getClientOriginalExtension());
                $filenamecover = $file->getClientOriginalName();
            }else{
                $extensioncover = '';
                $filenamecover = '';
            }

            if( $request->hasFile('audio')){
                $extensionaudio = strtolower($audio->getClientOriginalExtension());
                $filenameaudio = $audio->getClientOriginalName();
            }else{
                $extensionaudio = '';
                $filenameaudio = '';
            }

            if($validator->fails()){
                return response()->json([
                    'message' => 'Une erreur dans le formulaire',
                    'status' => 500
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filenamecover.'.'.$extensioncover, File::get($file));

                /**Enregistrement de l'audio */
                Storage::disk('public')->put($filenameaudio.'.'.$extensionaudio, File::get($audio));

                /**Sauvegarde des donnees */
                $podcast = new Podcasts();
                $podcast->title = $title;
                $podcast->label = $label;
                $podcast->description = $description;
                $podcast->program = $program;
                $podcast->author = $author;
                $podcast->cover = $filenamecover.'.'.$extensioncover;
                $podcast->audio = $filenameaudio.'.'.$extensionaudio;
                $podcast->created_at = $time;
                $podcast->save();
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

    /**************************Mise a jour des Podcast **************************** */
    public function updatePodcastMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $program = $request->input('program');
            $file = $request->file('cover');
            $audio = $request->file('audio');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current banner object */
            $podcast = Podcasts::where('id', $id)->first();

            if( $request->hasFile('cover')){
                
                //code for remove old file
                Storage::disk('public')->delete($podcast->cover);

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $podcast->cover = $filename.'.'.$extension;
            }

            if( $request->hasFile('audio')){

                //code for remove old file
                Storage::disk('public')->delete($podcast->audio);

                $extensionaudio = strtolower($audio->getClientOriginalExtension());
                $filenameaudio = $audio->getClientOriginalName();

                Storage::disk('public')->put($filenameaudio.'.'.$extensionaudio,  File::get($audio));
                
                $podcast->audio = $filenameaudio.'.'.$extensionaudio;
            }

            $podcast->title = $title;
            $podcast->label = $label;
            $podcast->description = $description;
            $podcast->program = $program;
            $podcast->updated_at = $time;
            $podcast->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des podcast *************** */
    public function deletePodcastMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            $podcast = Podcasts::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($podcast->cover);
            Storage::disk('public')->delete($podcast->audio);
            // delete object
            $podcast->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une podcast (Bloquer ou Débloquer) **************************** */
    public function statuspodcastMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $podcast = Podcasts::where('id', $id)->first();
            if($podcast->is_active == 1){
                $podcast->is_active = 0;
            }else{
                $podcast->is_active = 1;
            }
            $podcast->save();
            $newstatus = $podcast->is_active;
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
