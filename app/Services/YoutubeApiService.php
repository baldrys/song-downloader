<?php

namespace App\Services;

use Madcoda\Youtube\Youtube;

class YoutubeApiService
{
	private $youtubeApi;


    const NUM_OF_VIDEOS = 5;

	function __construct()
	{
		$apiKey = \Config::get('youtubeapi.youtubeApiKey');
		$this->youtubeApi = new Youtube(array('key' => $apiKey));
	}

    
    public function getListOfVideosByTitle(String $title) {
		$array = $this->youtubeApi->searchVideos($title,  $maxResults = self::NUM_OF_VIDEOS);
		$proccesedArray = array_map(function ($item) {
			return [
				"id" => $item->id->videoId,
				"title" => $item->snippet->title
			];
		}, $array);
        return $proccesedArray;
    }

}