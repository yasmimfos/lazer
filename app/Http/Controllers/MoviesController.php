<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateMoviesRequest;
use App\Http\Resources\MoviesResource;
use App\Models\Movies;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movies::all();
        return MoviesResource::collection($movies);
    }
    public function store(StoreUpdateMoviesRequest $request)
    {
        $data = $request->validated();
        $movie = Movies::create($data);
        return new MoviesResource($movie);
    }
    public function show($id)
    {
        $movie = Movies::find($id);
        return new MoviesResource($movie);
    }
    public function update(StoreUpdateMoviesRequest $request, $id)
    {
        $data = $request->validated();

        $movie = Movies::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $movie = Movies::update($data);

        return new MoviesResource($movie);
    }
    public function destroy($id)
    {
        $book = Movies::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json([], 204);
    }
}
