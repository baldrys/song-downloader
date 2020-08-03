<?php

namespace App\Services;

use YoutubeDl\YoutubeDl;
use Madcoda\Youtube\Youtube;

class SongDlService
{
	private $youtubeApi;
	private $youtubeDl;

	function __construct($downloadPath = __DIR__ . '/../downloads')
	{
		$apiKey = \Config::get('youtubeapi.youtubeApiKey');
		$this->youtubeApi = new Youtube(array('key' => $apiKey));
		$this->youtubeDl = new YoutubeDl([
			'extract-audio' => true,
			'audio-format' => 'mp3',
			'audio-quality' => 0, // best
			'output' => '%(title)s.%(ext)s',
		]);
	}

	public function getYoutubeApi()
	{

		return $this->youtubeApi;
	}
	public function getYoutubeDl()
	{

		return $this->youtubeDl;
	}
}
