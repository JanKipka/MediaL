<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Director;
use App\Format;
use App\Genre;
use App\MediaFormat;
use App\Movie;
use App\Repositories\MediaRepositoryInterface;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $mediaRepository;

    /**
     * Create a new controller instance.
     *
     * @param MediaRepositoryInterface $mediaRepository
     */
    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->middleware('auth');
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = $this->mediaRepository->getAllBooksForUser();
        $movies = $this->mediaRepository->getAllMoviesForUser();
        $numGenres = $this->mediaRepository->getNumberOfGenres();
        $user = Auth::user();
        return view('home', [
            'countOfBooks' => count($books),
            'countOfMovies' => count($movies),
            'countOfGenres' => $numGenres,
            'totalCount' => count($books) + count($movies),
            'user' => $user
        ]);
    }

    public function add(Request $request)
    {
        $formatType = $request['type'] === 'book' ? MediaFormat::BOOK : MediaFormat::MOVIE;
        $formats = Format::where('mediaFormat', $formatType)->get();
        $genres = Genre::all();
        if ($formatType === MediaFormat::BOOK) {
            $artists = Author::all();
            $mediaItems = Book::all();
        } else {
            $artists = Director::all();
            $mediaItems = Movie::all();
        }
        return view('add', [
            'type' => $request['type'],
            'genres' => $genres,
            'artists' => $artists,
            'formats' => $formats,
            'mediaItems' => $mediaItems
        ]);
    }
}
