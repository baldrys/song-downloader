<?php

namespace App\Services;

use YoutubeDl\YoutubeDl;
use Madcoda\Youtube\Youtube;

class SongDlService
{
	private $youtubeApi;
	private $youtubeDl;

	function __construct()
	{
		$apiKey = \Config::get('youtubeapi.youtubeApiKey');
		$this->youtubeApi = new Youtube(array('key' => $apiKey));
		$this->youtubeDl = new YoutubeDl([
			'extract-audio' => true,
			'audio-format' => 'mp3',
			'audio-quality' => 0, // best
			'output' => '%(title)s.%(ext)s',
		]);
		$this->youtubeDl->setDownloadPath(storage_path('app/public/downloads'));
		// $this->youtubeDl->onProgress(function ($progress) {
		// 	$percentage = $progress['percentage'];
		// 	$size = $progress['size'];
		// 	$speed = $progress['speed'] ?? null;
		// 	$eta = $progress['eta'] ?? null;
			
		// 	logger()->info("Percentage: $percentage; Size: $size");
		// 	echo "Percentage: $percentage; Size: $size";
		// 	if ($speed) {
		// 		echo "; Speed: $speed";
		// 		logger()->info("; Speed: $speed");
		// 	}
		// 	if ($eta) {
		// 		echo "; ETA: $eta";
		// 		logger()->info("; ETA: $eta");
		// 	}
		// 	// Will print: Percentage: 21.3%; Size: 4.69MiB; Speed: 4.47MiB/s; ETA: 00:01
		// });
	}

	public function getYoutubeApi()
	{
		return $this->youtubeApi;
	}
	public function getYoutubeDl()
	{
		return $this->youtubeDl;
	}

	public function downloadSong($title) {
		$video = $this->youtubeApi->searchVideos($title,  $maxResults = 1);
        $videId = $video[0]->id->videoId;
        return $this->youtubeDl->download('https://www.youtube.com/watch?v='.$videId);
	}
}
