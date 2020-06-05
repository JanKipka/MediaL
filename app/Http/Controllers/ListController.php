<?php

namespace App\Http\Controllers;

use App\Book;
use App\Movie;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ListController extends Controller
{
    private $mediaRepository;

    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->middleware('auth');
        $this->mediaRepository = $mediaRepository;
    }

    public function list(Request $request) {
        $type = $request['type'];
        if ($type === 'book') {
            $mediaItems = Book::all();
        } else {
            $mediaItems = Movie::all();
        }
        return view('list', ['type' => $type, 'mediaItems' => $mediaItems]);
    }
}
