<?php

namespace App\Http\Controllers;

use App\Author;
use App\Director;
use App\Format;
use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function all(Request $request) {
        $formats = Format::all();
        $genres = Genre::all();
        return response()->json([
            'genres' => $genres,
            'formats' => $formats
        ]);
    }

    public function authors(Request $request) {
        $authors = Author::all();
        return response()->json([
            'artists' => $authors
        ]);
    }

    public function author(Request $request, $id) {
        $author = Author::findOrFail($id);
        return response()->json([
            'author' => $author
        ]);
    }

    public function updateAuthor(Request $request, $id) {
        $author = Author::findOrFail($id);
        try {
            $newAuthor = (object)$request->json('author');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('An error occured while parsing author from request: ' . $e->getMessage());
        }
        Log::info($request->json('author'));
        $updateInfo = [
            'firstName' => $newAuthor->firstName,
            'lastName' => $newAuthor->lastName,
            'fullName' => $newAuthor->firstName . ' ' . $newAuthor->lastName
        ];

        $author->fill($updateInfo);
        $author->save();

        return response()->json([
            'author' => $author
        ]);
    }

    public function directors(Request $request) {
        $directors = Director::all();
        return response()->json([
            'artists' => $directors
        ]);
    }
}
