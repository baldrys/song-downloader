<?php

namespace App\Jobs;

use App\Services\SongDlService;
use App\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadSongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $song;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SongDlService $songDlService)
    {
        try {
            // $download = $songDlService->downloadSong($this->song->searchTitle);
            $download = $songDlService->downloadSongById($this->song->videoId);
            $file = $download->getFile();
            $this->song->title = $download->getTitle();
            $this->song->path = $file->getRealPath();
            $this->song->status = 'completed';
            $this->song->save();
            return response()->download($file->getRealPath())->deleteFileAfterSend();
        } catch (\Throwable $exception) {
            logger('Could not download the given link!');
            $this->song->status = 'failed';
            $this->song->save();
            throw new $exception;
        }
    }
}
