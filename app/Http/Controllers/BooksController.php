<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateBooksRequest;
use App\Http\Resources\BooksResource;
use App\Models\Books;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::getAll();
        return $books;
    }
    public function store(StoreUpdateBooksRequest $request)
    {
        $user_id = auth()->user()->id;
        $data = $request->validated();
        $data['user_id'] = $user_id;

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
        $user_id = $request->user()->id;
        $data = $request->validated();

        $book = Books::getById($id);
        $data['user_id'] = $user_id;

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
