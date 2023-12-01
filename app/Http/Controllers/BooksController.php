<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBooksRequest;
use App\Http\Resources\BooksResource;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all();
        return BooksResource::collection($books);
    }
    public function store(StoreUpdateBooksRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $book = Books::create($data);
        return new BooksResource($book);
    }
    public function show($id)
    {
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return new BooksResource($book);

    }
    public function update(StoreUpdateBooksRequest $request, string $id)
    {
        $data = $request->all();
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $data['user_id'] = $request->user()->id;
        $book->update($data);

        return new BooksResource($book);
    }
    public function destroy($id)
    {
        $book = Books::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json([], 204);
    }
}
