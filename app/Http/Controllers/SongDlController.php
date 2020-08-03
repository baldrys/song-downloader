<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SongDlService;

class SongDlController extends Controller
{
    public function index(SongDlService $songDownload)
    {
        $x = $songDownload->getYoutubeApi()->searchVideos("Дудь",  $maxResults = 10);
        dd($x);
        return view('songdl');
    }
}
