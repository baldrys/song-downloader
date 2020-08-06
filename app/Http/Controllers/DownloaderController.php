<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Services\SongDlService;
use App\Services\YoutubeApiService;
use App\Services\Y;
use App\Song;
use App\Jobs\DownloadSongJob;

class DownloaderController extends Controller
{
    public function prepare(Request $request, YoutubeApiService $youtubeAp)
    {


        $songs = $youtubeAp->getListOfVideosByTitle($request->input('songTitle'));
        dd($songs);

        $this->validate($request, [
            'songTitle' => 'required'
        ]);
        $song = Song::create([
            'searchTitle' => $request->input('songTitle')
        ]);
        DownloadSongJob::dispatch($song);
        return redirect()->route('status', ['song' => $song]);
    }

    public function status(Song $song)
    {
        return view('status', ['song' => $song]);
    }
    public function download(Song $song)
    {
        abort_if($song->status !== 'completed', 404);
        return response()->download($song->path)->deleteFileAfterSend();
    }
}
