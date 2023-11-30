<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::select('titulo', 'autor', 'genero', 'formato')->get();
        return response()->json($books, 200);
    }
    public function store(Request $request)
    {
        //hashear a senha
        $book = Books::create($request->all());
        return response()->json(['message' => 'Livro cadastrado com sucesso'], 201);
    }
    public function show($id)
    {
        $book = Books::findOrFail($id)->select('titulo', 'autor', 'genero', 'formato')->get();
        try {
            return response()->json($book[0], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $book = Books::find($id)->update($request->all());

        return response()->json($book, 200);

        //não está captando o body -> resolver

        // $book->update($data);
        // return response()->json($book, 200);
    }
    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();
        return response()->json('Livro Apagado com sucesso', 200);
    }
}
