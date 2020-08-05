<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Services\SongDlService;

class DownloaderController extends Controller
{
    public function prepare(Request $request, SongDlService $songDlService)
    {
        $this->validate($request, [
            'songTitle' => 'required'
        ]);
        try {          
            $download = $songDlService->downloadSong($request->songTitle);
            $file = $download->getFile();
            // dd($download, $file);
            return response()->download($file->getRealPath())->deleteFileAfterSend();   
        } catch (\Throwable $exception) {
            $request->session()->flash('error', 'Could not download the given link!');
            logger()->critical($exception->getMessage());
            return back();
        }
    }
}
