<?php

namespace App\Http\Controllers;


use SpotifyWebAPI\SpotifyWebAPI;

class HomeController extends Controller
{
    public function index(string $token)
    {
        $api = new SpotifyWebAPI();
        $api->setAccessToken($token); // Fetch the saved access token
        // Example: Get the currently authenticated user's data
//        $userData = $api->me();
        $tracks = [];
        $offset = 0;
        for ($counter = 0; $counter < 4; $counter++) {
            $data = $api->getPlaylistTracks('2XICHivZc0s0hCRSBEtiZS', [
                'offset' => $offset
            ]);
            $items = response()->json($data)->original->items;
            foreach ($items as $item) {
                $artists = '';
                foreach ($item->track->album->artists as $artist) {
                    $artists .= $artist->name;
                }
                $tracks[$artists . $item->track->album->name] = [
                    'album_name' => $item->track->album->name,
                    'poster' => $item->track->album->images[0]->url,
                ];
            }
            sleep(10);
            $offset += 100;
        }
        dd($tracks);


    }

}
