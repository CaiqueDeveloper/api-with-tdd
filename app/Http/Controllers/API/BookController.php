<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Book $book)
    {
        return response()->json($book->all());
    }

    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());
        
        return response()->json($book);
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json([],204);
    }
}
