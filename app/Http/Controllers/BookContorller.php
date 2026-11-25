<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookContorller extends Controller
{
    public function getAll(): JsonResponse {
        $books = Book::all();

        return response()->json($books);
    }

    public function get(int $id): JsonResponse {
        $book = Book::find($id);

        return response()->json($book);
    }

    public function create(BookFormRequest $request): JsonResponse {
        $validated = $request->validated();

        $book = Book::create($validated);

        return response()->json($book, Response::HTTP_CREATED);
    }

    public function update(BookFormRequest $request, int $id): JsonResponse {
        $book = Book::find($id);

        if ($book) {
            $book->update($request->validated());

            return response()->json($book, Response::HTTP_OK);
        }

        return response()->json('', Response::HTTP_NOT_FOUND);
    }

    public function delete(int $id): Response {
        $book = Book::find($id);

        if ($book) {
            $book->delete();
        }

        return response("", 204);
    }
}
