<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Services\SongDlService;
use App\Song;
use App\Jobs\DownloadSongJob;

class DownloaderController extends Controller
{
    public function prepare(Request $request)
    {
        $this->validate($request, [
            'songTitle' => 'required'
        ]);
        // try {          
        //     $download = $songDlService->downloadSong($request->songTitle);
        //     $file = $download->getFile();
        //     dd($download->getTitle(), $file);
        //     return response()->download($file->getRealPath())->deleteFileAfterSend();   
        // } catch (\Throwable $exception) {
        //     $request->session()->flash('error', 'Could not download the given link!');
        //     logger()->critical($exception->getMessage());
        //     return back();
        // }
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
