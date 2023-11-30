<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movies::select('titulo', 'genero', 'assistir')->get();
        return response()->json($movies, 200);
    }
    public function store(Request $request)
    {
        $movie = Movies::create($request->all());
        return response()->json('Filme cadastrado com sucesso!', 201);
    }
    public function show($id)
    {
        $movie = Movies::find($id)->select('titulo', 'genero', 'assistir')->get();
        return response()->json($movie, 200);
    }
    public function update(Request $request, $id)
    {
        $movie = Movies::find($id)->update($request->all());
        return response()->json('Atualizado!', 200);
        //não está atualizando
    }
    public function destroy($id)
    {
        $movie = Movies::find($id)->delete();
        return response()->json('Deletado!', 200);
    }
}
