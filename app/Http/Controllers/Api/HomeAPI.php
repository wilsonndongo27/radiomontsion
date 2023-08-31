<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\{NewsResource, BannerResource, ProgramResource, PodcastResource};
use App\Models\{Programs, Banners, Podcasts, News};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allbanner = BannerResource::collection(
            Banners::where('is_active', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allnews = NewsResource::collection(
            News::where('is_active', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allprogram = ProgramResource::collection(
            Programs::where('is_active', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        $allpodcast = PodcastResource::collection(
            Podcasts::where('is_active', 1)
            ->OrderBy('created_at', 'DESC')
            ->paginate(5)
        );

        return response([ 
            'status' => 200,
            'allbanner' => $allbanner,
            'allprogram' => $allprogram,
            'allpodcast' => $allpodcast,
            'allnews' => $allnews,
            'message' => 'Opération réussi!',
        ]);
    }
}
