<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Format;
use App\Genre;
use App\MediaFormat;
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
        return view('home', [
            'countOfBooks' => count($books),
            'countOfMovies' => count($movies)
        ]);
    }

    public function add(Request $request)
    {
        $formatType = $request['type'] === 'book' ? MediaFormat::BOOK : MediaFormat::MOVIE;
        $formats = Format::where('mediaFormat', $formatType)->get();
        $genres = Genre::all();
        $authors = Author::all();
        return view('add', [
            'type' => $request['type'],
            'genres' => $genres,
            'authors' => $authors,
            'formats' => $formats
        ]);
    }

    public function persist(Request $request)
    {
        $title = $request['title'];
        $artistTabChoice = $request['artistTabChoice'];
        $artist = $request['artist'];
        $artist_first = $request['artist_first'];
        $artist_last = $request['artist_last'];
        $genre = $request['genre'];
        $format = $request['format'];
        $type = $request['type'];
        $user = Auth::user();

        $format = Format::find($format);
        $genre = Genre::find($genre);

        if ($type === 'book') {
            if ($artistTabChoice === 'new') {
                $author = new Author();
                $author->setFirstName($artist_first);
                $author->setLastName($artist_last);
                $author->save();
            } else {
                $author = Author::find($artist);
            }

            $book = new Book();
            $book->setTitle($title);
            $book->format()->associate($format);
            $book->genre()->associate($genre);
            $book->save();
            $book->users()->save($user);

            $author->books()->save($book);
        }

        $books = $this->mediaRepository->getAllBooksForUser();
        $movies = $this->mediaRepository->getAllMoviesForUser();

        return view('home',
            [
                'countOfBooks' => count($books),
                'countOfMovies' => count($movies)
            ]);
    }
}
