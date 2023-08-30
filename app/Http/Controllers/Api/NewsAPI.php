<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{ NewsResource};
use App\Models\{News, User};

class NewsAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allnews = NewsResource::collection(
            News::where('is_active', 1)
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allnews->nextPageUrl();
        $previouspage = $allnews->previousPageUrl();
        $page = $allnews->currentPage();
        $isfirstpage = $allnews->onFirstPage();
        $hasmorepage = $allnews->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allnews' => $allnews,
            'message' => 'Opération réussi!',
        ]);
    }

    
}
