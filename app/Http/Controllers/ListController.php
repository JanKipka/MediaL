<?php

namespace App\Http\Controllers;

use App\Book;
use App\Movie;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $mediaItems = Book::with('format', 'genre')->whereHas('users', function ($query) {
                return $query->where('users.id', '=', Auth::id());
            })->get();
        } else {
            $mediaItems = Movie::with('format', 'genre')->whereHas('users', function ($query) {
                return $query->where('users.id', '=', Auth::id());
            })->get();
        }
        foreach ($mediaItems as $item) {
            $hasRead = DB::table('user_book')->select('read')->where([
                'user_id' => Auth::id(),
                'book_id' => $item->getId()
            ])->first();
            $item->{'read'} = $hasRead->read;
        }
        return view('list', ['type' => $type, 'mediaItems' => $mediaItems]);
    }
}
