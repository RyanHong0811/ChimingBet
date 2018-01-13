<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class SoccerGameController extends Controller
{
    /**
     * 回應對 GET /edititem/todb 的請求
     */
    public function getGame($cc = 'gb')
    {
    	$day = Carbon::tomorrow()->format('Ymd');
    	$token = env('API_TOKEN');
		$url = "https://api.betsapi.com/v1/events/upcoming?token={$token}&sport_id=1&LNG_ID=2&day={$day}&cc={$cc}";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		if ($data === false) {
		    $info = curl_getinfo($ch);
		    curl_close($ch);
		    die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($ch);
		$game = json_decode($data, true)['results'];
        return view('admin.game.bet', ['games' => $game]);
    }
}