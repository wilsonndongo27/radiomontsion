<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Banners, News, Partners, Staff, InfoCompany, Achievement, ProductService, StaffProfil};

class detailController extends Controller
{
    public function detailNewsMethod($id){
        $data['allproduct'] = ProductService::where('is_active', 1)->get();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        $data['allbanner'] = Banners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();
        
        $data['news'] = News::where('id', $id)->first();

        return view('frontend.detail-news', $data);
    }

    public function detailProductMethod($id){
        $data['product'] = ProductService::where('id', $id)->first();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.detail-product', $data);
    }

    public function detailPartnerMethod($id){
        $data['partner'] = Partners::where('id', $id)->first();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.detail-partner', $data);
    }

    
    public function detailStaffMethod($id){
        $data['staff'] = Staff::where('id', $id)->first();
        
        $data['profil'] = StaffProfil::where('id', Staff::where('id', $id)->first()->id)->first();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.detail-staff', $data);
    }

    public function detailAchievementMethod($id){
        $data['achievement'] = Achievement::where('id', $id)->first();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.detail-achievement', $data);
    }

    public function detailBannerMethod($id){
        $data['banner'] = Banners::where('id', $id)->first();

        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.detail-banner', $data);
    }

    public function contactMethod(){
        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();
        
        return view('frontend.contact', $data);
    }

    public function aboutMethod(){
        $data['company'] = InfoCompany::first();
        
        $data['allpartner'] = Partners::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        $data['allproduct'] = ProductService::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->get();

        $data['lastnews'] = News::where('is_active', 1)
        ->OrderBy('updated_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();
        
        return view('frontend.about', $data);
    }
}
