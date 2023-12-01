<?php

namespace App\Models;

use App\Http\Resources\BooksResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected function getAll()
    {
        $books = Books::where('user_id', auth()->user()->id)->get()->first();
        if (!$books) {
            return response()->json(['message' => 'No books yet...'], 404);
        }
        return BooksResource::collection($books);
    }
    protected function getById($id)
    {
        $book = Books::where('id', $id)->where('user_id', auth()->user()->id)->get()->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return new BooksResource($book);
    }

    protected $table = "books";

    protected $fillable = [
        'title',
        'author',
        'user_id',
        'category',
        'format'
    ];
}
