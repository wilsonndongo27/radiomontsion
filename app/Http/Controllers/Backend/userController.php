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
use App\Models\{Country, City, User, State};

class userController extends Controller 
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
            $countries = Country::get(["name","id"]);
            $users = User::all();
            $allusers = array();
            foreach ($users as $item) {
                $country = Country::where('id', $item->country)->first();
                $city = City::where('id', $item->city)->first();
                $state = State::where('id', $item->state)->first();
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'country' => $country->name,
                    'countryid' => $country->id,
                    'state' => $state->name,
                    'stateid' => $state->id,
                    'city' => $city->name,
                    'cityid' => $city->id,
                    'address' => $item->address,
                    'pp' => $item->pp,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allusers, $format_data);
            }
            return view('backend.users', compact('allusers', 'countries'));
        }else{
            return view('backend.403');
        }
    }

    /**Create User */
    public function createUserMethod(Request $request){
        if($this->can_access() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'password' => 'required',
                'is_admin' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            /**initialisation des variables */
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $is_admin = $request->input('is_admin');
            $password = $request->input('password');
            $time = \Carbon\Carbon::now()->toDateTimeString();
            $file = $request->file('photo');

            if( $request->hasFile('photo')){
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
            }else if($this->Check_email_exist($request->input('email')) == true){
                return response()->json([
                    'message' => 'Cette adresse email existe déjà.',
                    'status' => 403
                ]);
            }else{
                /**Enregistrement de la photo */
                Storage::disk('public')->put($filename.'.'.$extension, File::get($file));

                /**Sauvegarde des donnees */
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->country = $country;
                $user->state = $state;
                $user->city = $city;
                $user->address = $address;
                $user->password = Hash::make($password);
                $user->pp = $filename.'.'.$extension;
                $user->is_admin = $is_admin;
                $user->created_at = $time;
                $user->save();
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

    /**************************Mise a jour des utilisateurs **************************** */
    public function updateUserMethod(Request $request){
        if($this->can_access() == true){
            $this->validate($request,[
                'user_id' => 'required',
            ]);
            $user_id = $request->input('user_id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $file = $request->file('photo');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current user object */
            $user = User::where('id', $user_id)->first();

            if( $request->hasFile('photo')){
                //code for remove old file
                Storage::disk('public')->delete($user->cover);

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $user->pp = $filename.'.'.$extension;
            }
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->country = $country;
            $user->state = $state;
            $user->city = $city;
            $user->address = $address;
            $user->updated_at = $time;
            $user->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression des utilisateurs *************** */
    public function deleteUserMethod(Request $request){
        if($this->can_access() ==  true){
            $id = $request->input('id');
            $user = User::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($user->pp);
            // delete object
            $user->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un utilisateur (Bloquer ou Débloquer) **************************** */
    public function statusUserMethod(Request $request){
        if($this->can_access() == true){
            $id = $request->input('id');
            /**get the current admin object */
            $user = User::where('id', $id)->first();
            if($user->is_active == 1){
                $user->is_active = 0;
            }else{
                $user->is_active = 1;
            }
            $user->save();
            $newstatus = $user->is_active;
            return response()->json([
                'message' => 'L\opération a réussi!',
                'newstatus' => $newstatus,
                'status' => 200
            ]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  mot de passe **************************** */
    public function passwordUserMethod(Request $request){
        if($this->can_access() == true){
            $id = $request->input('id');

            /**get the current admin object */
            $user = User::where('id', $id)->first();
            $password1 = $request->input('password1');
            $password2 = $request->input('password2');
            if($password1 == $password2){
                $user->password = Hash::make($password1);
                $user->save();
                return response()->json([
                    'message' => 'L\opération a réussi!',
                    'status' => 200
                ]);
            }else{
                return response()->json(['message'=>'Les mots de passe sont différents vérifier!', 'status'=> 403]);
            }
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**
     * Authenticate the admin user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)){
            Auth::login(Auth::user());
            $datauser = Auth::user();
            return response()->json([
                'message'=>'Connexion réussi!',
                'status'=> 200]);
        }else {
            return response()->json([
                'message'=>'Mot de passe ou Email incorrect!', 
                'status'=> 500
            ]);
        }


    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to('dashboard');
    }

}
