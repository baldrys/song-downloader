<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YoutubeApiService;
use App\Song;
use App\Jobs\DownloadSongJob;

class SongsController extends Controller
{

    public function search(Request $request, YoutubeApiService $youtubeApi) {
        $songs = $youtubeApi->getListOfVideosByTitle($request->title);
        return response()->json([
            "songs" => $songs
        ]);
    }

    public function prepare(Request $request)
    {
        $this->validate($request, [
            'videoId' => 'required'
        ]);
        $song = Song::create([
            'videoId' => $request->videoId
        ]);
        
        DownloadSongJob::dispatch($song);
        return response()->json([
            "id" => $song->id,
        ]);
    }

    public function getStatus(Song $song)
    {
        return response()->json([
            "id" => $song->id,
            "status" => $song->status
        ]);
    }

    public function download(Song $song)
    {
        abort_if($song->status !== 'completed', 404);
        return response()->download($song->path)->deleteFileAfterSend();
    }
}
