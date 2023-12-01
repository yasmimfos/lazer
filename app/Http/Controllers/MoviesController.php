<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateMoviesRequest;
use App\Http\Resources\MoviesResource;
use App\Models\Movies;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movies::getAll();
        return $movies;
    }
    public function store(StoreUpdateMoviesRequest $request)
    {
        $user_id = $request->user()->id;

        $data = $request->validated();
        $data["user_id"] = $user_id;

        $movie = Movies::create($data);

        return new MoviesResource($movie);
    }
    public function show($id)
    {
        $movie = Movies::getById($id);
        return $movie;
    }
    public function update(StoreUpdateMoviesRequest $request, $id)
    {
        $data = $request->validated();
        $movie = Movies::getById($id);
        $movie->update($data);
        return $movie;
    }
    public function destroy($id)
    {
        $movie = Movies::getById($id);
        $movie->delete();
        return response()->json([], 204);
    }
}
