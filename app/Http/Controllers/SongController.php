<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Models\Song;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        return response()->json($songs);
    }
    public function store(StoreSongRequest $request)
    {
        $song = Song::create($request->validated());
    
        return response()->json([
            'message' => 'Song created',
            'data'    => $song
        ], 201);
    }
    
    public function show(Song $song)
    {
        return response()->json($song);
    }

    public function update(UpdateSongRequest $request, Song $song)
    {
        $validated = $request->validate([
            'title'  => 'required|string',
            'artist' => 'required|string',
            'url'    => 'required|url'
        ]);
    
        $song->update($validated);
    
        return response()->json($song);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(null, 204);
    }
}
