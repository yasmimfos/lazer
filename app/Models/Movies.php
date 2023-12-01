<?php

namespace App\Models;

use App\Http\Resources\MoviesResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected function getAll()
    {
        $movies = Movies::all();
        return MoviesResource::collection($movies);
    }
    protected function getById($id)
    {
        $movie = Movies::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return new MoviesResource($movie);
    }
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'category',
        'watch_on',
        'user_id'
    ];
}
