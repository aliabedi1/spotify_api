<?php /** @noinspection LaravelFunctionsInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use SpotifyWebAPI\Session as SpotifySession;

class SpotifyAuthController extends Controller
{
    public function login()
    {
        $session = new SpotifySession(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        $options = [
            'scope' => ['playlist-read-private', 'user-read-private'],
        ];
        return redirect()->away($session->getAuthorizeUrl($options));
    }


    public function callback(Request $request)
    {

        $session = new SpotifySession(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
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
