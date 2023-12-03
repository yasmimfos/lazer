<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBooksRequest;
use App\Http\Resources\BooksResource;
use App\Models\Books;

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
        $book = Books::create($data);
        return new BooksResource($book);
    }
    public function show($id)
    {
        $book = Books::getById($id);
        return $book;
    }
    public function update(StoreUpdateBooksRequest $request, string $id)
    {
        $data = $request->validated();
        $book = Books::getById($id);
        $book->update($data);
        return new BooksResource($book);
    }
    public function destroy($id)
    {
        $book = Books::getById($id);
        $book->delete();
        return response()->json([], 204);
    }
}
