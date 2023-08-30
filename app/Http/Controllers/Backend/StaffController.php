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

class StaffController extends Controller
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
            $allprofil = StaffProfil::where('is_active', $item->author)->get();
            $staffs = Staff::all();
            $allstaff = array();
            foreach ($staffs as $item) {
                $country = Country::where('id', $item->country)->first();
                $city = City::where('id', $item->city)->first();
                $state = State::where('id', $item->state)->first();
                $profil = StaffProfil::where('id', $item->profil)->first();
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'profil' => $profil->name,
                    'profilid' => $profil->id,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'country' => $country->name,
                    'countryid' => $country->id,
                    'state' => $state->name,
                    'stateid' => $state->id,
                    'city' => $city->name,
                    'cityid' => $city->id,
                    'address' => $item->address,
                    'description' => $item->description,
                    'pp' => $item->pp,
                    'is_active' => $item->is_active
                ];
                $format_data = json_decode(json_encode($data), FALSE);
                array_push($allstaff, $format_data);
            }
            return view('backend.staff', compact('allstaff', 'countries', 'allprofil'));
        }else{
            return view('backend.403');
        }
    }

    /**Create Staff */
    public function createStaffMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            /**Controle de validation des inputs */
            $rules = array(
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'profil' => 'required',
                'author' => 'required',
                'description' => 'required',
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
            $author = $request->input('author');
            $profil = $request->input('profil');
            $description = $request->input('description');
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
                $staff = new Staff();
                $staff->name = $name;
                $staff->email = $email;
                $staff->phone = $phone;
                $staff->country = $country;
                $staff->state = $state;
                $staff->city = $city;
                $staff->address = $address;
                $staff->pp = $filename.'.'.$extension;
                $staff->author = $author;
                $staff->profil = $profil;
                $staff->description = $description;
                $staff->created_at = $time;
                $staff->save();
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

    /**************************Mise a jour du personnel **************************** */
    public function updateStaffMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $this->validate($request,[
                'id' => 'required',
            ]);
            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $profil = $request->input('profil');
            $address = $request->input('address');
            $description = $request->input('description');
            $file = $request->file('photo');
            $time = \Carbon\Carbon::now()->toDateTimeString();

            /**get the current staff object */
            $staff = Staff::where('id', $id)->first();

            if( $request->hasFile('photo')){
                
                //code for remove old file
                Storage::disk('public')->delete($staff->pp);

                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $file->getClientOriginalName();

                Storage::disk('public')->put($filename.'.'.$extension,  File::get($file));
                
                $staff->pp = $filename.'.'.$extension;
            }
            $staff->name = $name;
            $staff->email = $email;
            $staff->phone = $phone;
            $staff->country = $country;
            $staff->state = $state;
            $staff->city = $city;
            $staff->address = $address;
            $staff->profil = $profil;
            $staff->description = $description;
            $staff->updated_at = $time;
            $staff->save();

            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }


    }

    /***************suppression du personnel *************** */
    public function deleteStaffMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            $staff = Staff::where('id', $id)->first();
            //code for remove file
            Storage::disk('public')->delete($staff->cover);
            // delete object
            $staff->delete();
            return response()->json(['message'=>'L\'opération a Réussi!', 'status'=> 200]);
        }else{
            return response()->json(['message'=>'Une erreur c\'est produite dans le formulaire!', 'status'=> 500]);
        }
    }

    /**************************Mise a jour du  status d'un personnel (Bloquer ou Débloquer) **************************** */
    public function statusStaffMethod(Request $request){
        if($this->can_access() == true || $this->can_access_admin() == true){
            $id = $request->input('id');
            /**get the current staff object */
            $staff = Staff::where('id', $id)->first();
            if($staff->is_active == 1){
                $staff->is_active = 0;
            }else{
                $staff->is_active = 1;
            }
            $staff->save();
            $newstatus = $staff->is_active;
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
