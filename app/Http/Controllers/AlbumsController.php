<?php

namespace App\Http\Controllers;

use App\Enums\Selected;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        return view('albums.index', [
            'albums' => Album::query()
                ->where('selected', Selected::NO)
                ->latest()
                ->simplePaginate(5),
            'songs' => Album::count(),
            'title' => 'Albums',
        ]);

    }


    public function select(Album $album)
    {
        $album
            ->update([
                'selected' => Selected::YES,
            ]);

        return response('album selected successfully.', 200);
    }

    public function delete(Album $album)
    {
        $album->delete();
        return response('album removed successfully.', 200);
    }

    public function deleted()
    {

    }

    public function recycle(Album $album)
    {

    }
}
