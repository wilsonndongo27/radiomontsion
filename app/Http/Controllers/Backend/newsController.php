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
use App\Models\{Banners, User, News};

class newsController extends Controller
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
            $news = News::all();
            $allnews = array();
            foreach ($news as $item) {
                $author = User::where('id', $item->author)->first();
                $data = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'label' => $item->label,
                    'description' => $item->description,
                    'author' => $author->name,
                    'created_at' => $item->created_at,
                    'cover' => $item->cover,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allnews, $format_data);
            }
            return view('backend.news', compact('allnews'));
        }else{
            return view('backend.403');
        }
    }

    /**Create News */
    public function createNewsMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'title' => 'required',
                'label' => 'required',
                'description' => 'required',
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
            $video = $request->file('video');

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
                $news = new News();
                $news->title = $title;
                $news->label = $label;
                $news->description = $description;
                $news->author = $author;
                $news->cover = $filename.'.'.$extension;
                if( $request->hasFile('video')){
                    $videoextension = strtolower($video->getClientOriginalExtension());
                    $videofilename = $video->getClientOriginalName();
                    Storage::disk('public')->put($videofilename.'.'.$videoextension, File::get($video));
                    $news->video = $videofilename.'.'.$videoextension;
                    $news->has_video = '1';
                }
                $news->created_at = $time;
                $news->save();
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

    /**************************Mise a jour des news **************************** */
    public function updateNewsMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $file = $request->file('cover');
            $video = $request->file('video');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current banner object */
            $news = News::where('id', $id)->first();

            if( $request->hasFile('cover')){
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();
                
                //code for remove old file
                Storage::disk('public')->delete($news->cover);

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $news->cover = $filename.'.'.$extension;
            }

            if( $request->hasFile('video') && $news->video){
                $videoextension = strtolower($video->getClientOriginalExtension());
                $videofilename = $video->getClientOriginalName();

                //code for remove old file
                Storage::disk('public')->delete($news->video);

                Storage::disk('public')->put($videofilename.'.'.$videoextension,  File::get($video));
                
                $news->video = $videofilename.'.'.$videoextension;
                $news->has_video = '1';
            }

            $news->title = $title;
            $news->label = $label;
            $news->description = $description;
            $news->updated_at = $time;
            $news->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des news *************** */
    public function deleteNewsMethod(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $news = News::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($news->cover);
            if($news->video){
                Storage::disk('public')->delete($news->video);
            }
            // delete object
            $news->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'une news (Bloquer ou Débloquer) **************************** */
    public function statusNewsMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $news = News::where('id', $id)->first();
            if($news->is_active == 1){
                $news->is_active = 0;
            }else{
                $news->is_active = 1;
            }
            $news->save();
            $newstatus = $news->is_active;
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
