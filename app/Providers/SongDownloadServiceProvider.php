<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Services\SongDlService;
use Madcoda\Youtube\Youtube;

class SongDownloadServiceProvider extends ServiceProvider
{
	public function register()
	{
		$apiKey = \Config::get('youtubeapi.youtubeApiKey');
		$this->app->singleton(SongDlService::class, function ($app) use ($apiKey) {
			return new Youtube(array('key' => $apiKey));
		});
	}
}
