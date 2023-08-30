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
use App\Models\{Country, City, User, State, Partners, ProductService};

class dashboardController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->can_access() == true || $this->can_access_admin() == true){
            $data['allpartner'] = Partners::all()->count();
            $data['alluser'] = User::all()->count();
            $data['allproduct'] = ProductService::all()->count();
            return view('backend.index', $data);
        }else{
            return view('backend.login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('backend.login');
    }

}
