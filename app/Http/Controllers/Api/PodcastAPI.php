<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\{PodcastResource};
use App\Models\{Podcasts, Programs, User};

class PodcastAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $allpodcast = PodcastResource::collection(
            Podcasts::where('is_active', 1)
            ->paginate(10)
        );

        
        /**Manage Pagination */
        $nextpage = $allpodcast->nextPageUrl();
        $previouspage = $allpodcast->previousPageUrl();
        $page = $allpodcast->currentPage();
        $isfirstpage = $allpodcast->onFirstPage();
        $hasmorepage = $allpodcast->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'allpodcast' => $allpodcast,
            'message' => 'Opération réussi!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function podcast_program($program)
    {
        $allpodcast = Podcasts::where('program', $program) 
        ->where('is_active', 1)
        ->paginate(10);

        $podcastprogram = array();
        foreach ($allpodcast as $item) {
            $author = User::where('id', $item->author)->first();
            $currentprogram = Programs::where('id', $program)->first();
            $data = [
                'id' => $item->id,
                'title' => $item->title,
                'label' => $item->label,
                'description' => $item->description,
                'program' => $currentprogram->title,
                'programid' => $currentprogram->id,
                'author' => $author->name,
                'created_at' => $item->created_at,
                'cover' => $item->cover,
                'audio' => $item->audio,
                'is_active' => $item->is_active
            ];
            $format_data = json_decode(json_encode($data), FALSE);
            array_push($podcastprogram, $format_data);
        }

        /**Manage Pagination */
        $nextpage = $allpodcast->nextPageUrl();
        $previouspage = $allpodcast->previousPageUrl();
        $page = $allpodcast->currentPage();
        $isfirstpage = $allpodcast->onFirstPage();
        $hasmorepage = $allpodcast->hasMorePages();

        return response([ 
            'status' => 200,
            'page' => $page,
            'next_page' => $nextpage,
            'previous_page' => $previouspage,
            'isfirstpage' => $isfirstpage,
            'hasmorepage' => $hasmorepage,
            'podcastprogram' => $podcastprogram,
            'message' => 'Opération réussi!',
        ]);
    }
}
