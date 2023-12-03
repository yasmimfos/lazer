<?php

namespace App\Models;

use App\Http\Resources\MoviesResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    protected function getById($id)
    {
        $movie = Movies::where('id', $id)->get()->first();
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
