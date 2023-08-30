<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{NewsResource};
use App\Models\{Radios};

class RadioAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allradio = NewsResource::collection(
            Radios::where('is_active', 1)
            ->paginate(5)
        );
        return response([ 
            'status' => 200,
            'allradio' => $allradio,
            'message' => 'Opération réussi!',
        ]);
    }
}
