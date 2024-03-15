<?php

namespace App\Http\Controllers;


use App\Models\Album;
use SpotifyWebAPI\SpotifyWebAPI;

class HomeController extends Controller
{
    public function index(string $token)
    {
        set_time_limit(0);
        $api = new SpotifyWebAPI();
        $api->setAccessToken($token);

        $offset = 0;
        for ($counter = 1; $counter < 35; $counter++) {
            $data = $api->getPlaylistTracks(config('services.spotify.playlist_id'), [
                'offset' => $counter * 100,
            ]);

            $items = collect(array_map(function ($item) {

                $artists = [];
                foreach ($item->track->album->artists as $artist) {
                    $artists[] = $artist->name;
                }
                return [
                    'album_id' => $item->track->album->id,
                    'name' => $item->track->album->name,
                    'image_url' => isset($item->track->album->images[0]) ? $item->track->album->images[0]->url : NULL,
                    'artists' => implode(', ', $artists),
                ];
            },response()
                ->json($data)
                ->original->items));


            $albumIds = Album::all(['album_id'])
                ->unique('album_id')
                ->pluck('album_id')
                ->toArray();

            Album::insert($items
                ->unique('album_id')
                ->whereNotIn('album_id', $albumIds)
                ->toArray());

            sleep(2);
        }
    }
}
