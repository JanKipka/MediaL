<?php

namespace App\Http\Controllers;

use App\Author;
use App\Director;
use App\Format;
use App\Genre;
use Illuminate\Http\Request;

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

    public function directors(Request $request) {
        $directors = Director::all();
        return response()->json([
            'artists' => $directors
        ]);
    }
}
