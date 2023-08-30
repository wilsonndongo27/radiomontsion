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
use App\Models\{Banners, User, News, ProductService};

class productServiceController extends Controller
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
            $products = ProductService::all();
            $allproduct = array();
            foreach ($products as $item) {
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
                array_push($allproduct, $format_data);
            }
            return view('backend.service', compact('allproduct'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Product */
    public function createProductMethod(Request $request){
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
                $product = new ProductService();
                $product->title = $title;
                $product->label = $label;
                $product->description = $description;
                $product->author = $author;
                $product->cover = $filename.'.'.$extension;
                $product->created_at = $time;
                $product->save();
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

    /**************************Mise a jour des produits **************************** */
    public function updateProductMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $title = $request->input('title');
            $label = $request->input('label');
            $description = $request->input('description');
            $file = $request->file('cover');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current banner object */
            $product = ProductService::where('id', $id)->first();

            if( $request->hasFile('cover')){

                //code for remove old file
                Storage::disk('public')->delete($product->cover);

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $product->cover = $filename.'.'.$extension;
            }
            $product->title = $title;
            $product->label = $label;
            $product->description = $description;
            $product->updated_at = $time;
            $product->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des produits *************** */
    public function deleteProductMethod(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $product = ProductService::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($product->cover);
            // delete object
            $product->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un produit (Bloquer ou Débloquer) **************************** */
    public function statusProductMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $product = ProductService::where('id', $id)->first();
            error_log($product);
            if($product->is_active == 1){
                $product->is_active = 0;
            }else{
                $product->is_active = 1;
            }
            $product->save();
            $newstatus = $product->is_active;
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
