<?php


namespace App\Repositories;


use App\Book;
use App\Movie;
use Illuminate\Support\Facades\Auth;

class MediaRepository implements MediaRepositoryInterface
{

    public function getAllMediaForUser($id)
    {
        // TODO: Implement getAllBooksForUser() method.
    }

    public function getAllBooksForUser()
    {
        $user = Auth::user();
        return $user->books;
    }

    public function getAllMoviesForUser()
    {
        $user = Auth::user();
        return $user->movies;
    }

    public function getMediaByID($mediaId)
    {
        // TODO: Implement getMediaByID() method.
    }

    public function persistBook($title, $format, $author, $genre)
    {
        $user = Auth::user();
        $book = new Book();
        $book->setTitle($title);
        $book->format()->associate($format);
        $book->genre()->associate($genre);
        $book->save();
        $book->users()->save($user);
        $author->books()->save($book);
    }

    public function persistMovie($title, $format, $director, $genre)
    {
        $user = Auth::user();
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->format()->associate($format);
        $movie->genre()->associate($genre);
        $movie->save();
        $movie->users()->save($user);
        $director->movies()->save($movie);
    }

    public function getNumberOfGenres()
    {
        $user = Auth::user();
        $books = $user->books();
        $movies = $user->movies();
        $booksArray = $books->pluck('genre_id')->toArray();
        $moviesArray = $movies->pluck('genre_id')->toArray();
        $allMedia = array_merge($booksArray, $moviesArray);
        $genres = array();
        foreach ($allMedia as $book) {
            $genreId = $book;
            if (!in_array($genreId, $genres, true)) {
                array_push($genres, $genreId);
            }
        }
        return count($genres);
    }
}
