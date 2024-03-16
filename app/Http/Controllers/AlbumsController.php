<?php

namespace App\Http\Controllers;

use App\Enums\Selected;
use App\Models\Album;
use Illuminate\Support\Facades\Log;

class AlbumsController extends Controller
{
    public function index()
    {
        return view('albums.index', [
            'albums' => Album::query()
                ->where('selected', Selected::NO)
                ->latest()
                ->simplePaginate(500),
            'songs' => Album::where('selected',Selected::NO)->count(),
            'title' => 'Albums',
        ]);
    }


    public function select(Album $album)
    {
        $album
            ->update([
                'selected' => Selected::YES,
            ]);

        Log::info($album->id . ' selected');
        return response('success');
    }
    public function selected()
    {
        $albums = Album::query()
            ->where('selected',Selected::YES)
            ->orderBy('name','asc')
            ->get();
        return view('albums.selected',[
            'albums' => $albums,
            'albums_count' => $albums->count(),
            'title' => 'Selected Albums'
        ]);
    }


    public function delete(Album $album)
    {
        Log::info($album->id . ' deleted');
        $album->delete();

        return response('success');
    }


    public function deleted()
    {
    }


    public function recycle(Album $album)
    {
        Log::info($album->id . ' recylcled');

    }
}
