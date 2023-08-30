<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Banners, News, Partners, Staff, InfoCompany, Achievement, ProductService, StaffProfil, Programs, Podcasts};

class listController extends Controller
{
    public function listServiceMethod(){
        $data['allproduct'] = ProductService::where('is_active', 1)->get();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        return view('frontend.list-service', $data);
    }

    public function listNewsMethod(){
        $data['company'] = InfoCompany::first();

        $data['allnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();
        
        $data['allproduct'] = ProductService::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        return view('frontend.list-news', $data);
    }

    public function listProgramMethod(){
        $data['company'] = InfoCompany::first();
        
        $data['allprogram'] = Programs::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->paginate(15);

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();
        
        $data['allproduct'] = ProductService::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        return view('frontend.list-program', $data);
    }

    public function listPodcastMethod(){

        $data['company'] = InfoCompany::first();

        $data['allpodcast'] = Podcasts::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->paginate(15);

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();

        $data['allproduct'] = ProductService::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        return view('frontend.list-podcast', $data);
    }

    
    public function listPodcastProgramMethod($id){

        $data['company'] = InfoCompany::first();

        $data['program'] = Programs::where('is_active', 1)
        ->where('id', $id)
        ->first();

        $data['allpodcast'] = Podcasts::where('is_active', 1)
        ->where('program', $id)
        ->OrderBy('updated_at', 'DESC')
        ->paginate(15);

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();

        $data['allproduct'] = ProductService::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        return view('frontend.list-podcast', $data);
    }
}
