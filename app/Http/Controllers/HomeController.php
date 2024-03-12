<?php

namespace App\Http\Controllers;


use App\Models\Album;
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
        for ($counter = 0; $counter < 32; $counter++) {
            $data = $api->getPlaylistTracks('2XICHivZc0s0hCRSBEtiZS', [
                'offset' => $offset
            ]);
            $items = response()->json($data)->original->items;
//            dd($items[0]);
            foreach ($items as $item) {
                $artists = '';
                foreach ($item->track->album->artists as $artist) {
                    $artists .= $artist->name;
                }
                $tracks[] = [
                    'album_id' => $item->track->album->id,
                    'album_name' => $item->track->album->name,
                    'poster' => isset($item->track->album->images[0]) ? $item->track->album->images[0]->url : null,
                    'artists' => $artists
                ];
            }
            sleep(5);
            $offset += 100;
        }
//        Album::


    }

}
