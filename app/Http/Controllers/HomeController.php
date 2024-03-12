<?php

namespace App\Http\Controllers;


use App\Models\Album;
use SpotifyWebAPI\SpotifyWebAPI;

class HomeController extends Controller
{
    public function index(string $token)
    {
        $api = new SpotifyWebAPI();
        $api->setAccessToken($token);

        $offset = 0;
        for ($counter = 0; $counter < 32; $counter++) {
            $data = $api->getPlaylistTracks(config('services.spotify.playlist_id'), [
                'offset' => $offset,
            ]);

            $tracks = [];
            $items = response()->json($data)->original->items;

            foreach ($items as $item) {

                $artists = [];
                foreach ($item->track->album->artists as $artist) {
                    $artists[] = $artist->name;
                }

                $tracks[] = [
                    'album_id' => $item->track->album->id,
                    'album_name' => $item->track->album->name,
                    'image_url' => isset($item->track->album->images[0]) ? $item->track->album->images[0]->url : NULL,
                    'artists' => implode(', ', $artists),
                ];

                Album::insertOrIgnore($tracks);

                sleep(5);
                $offset = ($counter+1) + 100;
            }
        }
    }
}
