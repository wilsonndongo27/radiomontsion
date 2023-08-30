<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{ProgramResource};
use App\Models\{Programs};

class ProgramAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allprogram = ProgramResource::collection(
            Programs::where('is_active', 1)
            ->paginate(10)
        );

        /**Manage Pagination */
        $nextpage = $allprogram->nextPageUrl();
        $previouspage = $allprogram->previousPageUrl();
        $page = $allprogram->currentPage();
        $isfirstpage = $allprogram->onFirstPage();
        $hasmorepage = $allprogram->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allprogram' => $allprogram,
            'message' => 'Opération réussi!',
        ]);
    }
    
}
