<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use SpotifyWebAPI\Session as SpotifySession;

class SpotifyAuthController extends Controller
{
    public function login()
    {
        $session = new SpotifySession(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET'),
            env('SPOTIFY_REDIRECT_URI')
        );

        $options = [
            'scope' => ['playlist-read-private', 'user-read-private'],
        ];
        return redirect()->away($session->getAuthorizeUrl($options));
    }


    public function callback(Request $request)
    {

        $session = new SpotifySession(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET'),
            env('SPOTIFY_REDIRECT_URI')
        );


        $session->requestAccessToken($request->input('code'));
        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        session([
            'access-token'=>$accessToken,
            'refresh-token'=>$refreshToken
        ]);

        return redirect()->route('home',[
            'token' => $accessToken
        ]);


    }
}
