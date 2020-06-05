<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Director;
use App\Format;
use App\Genre;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddController extends Controller
{

    private $mediaRepository;

    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->middleware('auth');
        $this->mediaRepository = $mediaRepository;
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

            $this->mediaRepository->persistBook($title, $format, $author, $genre);
        } else {
            if ($artistTabChoice === 'new') {
                $director = new Director();
                $director->setFirstName($artist_first);
                $director->setLastName($artist_last);
                $director->save();
            } else {
                $director = Author::find($artist);
            }
            $this->mediaRepository->persistMovie($title, $format, $director, $genre);
        }
        return redirect()->route('home');
    }
}
