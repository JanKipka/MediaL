<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Format;
use App\Genre;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function all(Request $request) {
        $books = Book::with('format', 'genre')->whereHas('users', function ($query) {
            return $query->where('users.id', '=', Auth::id());
        })->get();
        foreach ($books as $item) {
            $hasRead = DB::table('user_book')->select('read')->where([
                'user_id' => Auth::id(),
                'book_id' => $item->getId()
            ])->first();
            $item->{'read'} = $hasRead->read;
        }
        $movies = Movie::with('format', 'genre')->whereHas('users', function ($query) {
            return $query->where('users.id', '=', Auth::id());
        })->get();
        return response()->json([
            'books' => $books,
            'movies' => $movies
        ]);
    }

    public function addBook(Request $request)
    {
        $user = Auth::user();
        $book = null;
        try {
            $book = $request->json('media');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json('Error occured while parsing json from request: ' . $exception->getMessage(), 500);
        }

        $book = (object)$book;

        $authors = $book->authors;
        Log::info($authors);
        $authorArray = [];


        try {

            DB::transaction(function () use ($user, $book, $authors, $authorArray) {
                // add authors if not existing
                foreach ($authors as $author) {
                    $authorNew = Author::where('fullName', $author)->first();
                    if (is_null($authorNew)) {
                        $authorNew = new Author();
                        $authorNew->setFullName($author);
                        $authorNew->save();
                    }
                    array_push($authorArray, $authorNew);
                }
                $newBook = new Book([
                    'title' => $book->title,
                    'isbn' => $book->isbn ?? null,
                    'imageLink' => $book->imageLink ?? '',
                    'pageCount' => $book->pageCount ?? 0,
                    'publishedDate' => $book->publishedDate ?? null,
                    'textSnippet' => $book->textSnippet ?? '',
                    'format_id' => $book->format,
                    'genre_id' => $book->genre
                ]);
                $newBook->save();
                $newBook->users()->save($user);
                $read = $book->read ?? false;
                if ($read) {
                    DB::table('user_book')
                        ->where([
                            ['user_id', $user->id],
                            ['book_id', $newBook->getId()]
                        ])->update(['read' => 1]);
                }

                foreach ($authorArray as $eAuthor) {
                    $eAuthor->books()->save($newBook);
                }
            });
            return response()->json('success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('Error occured while saving book: ' . $e->getMessage(), 500);
        }

    }

    public function booksByAuthor(Request $request, $id) {
        $books = Book::with('format', 'genre')->whereHas('users', function ($query) {
            return $query->where('users.id', '=', Auth::id());
        })->get();
        $filtered = $books->filter(function ($book) use ($id) {
            Log::info($id);
            $authors = $book->author;
            foreach ($authors as $author) {
                $authorId = $author->id;
                if ($authorId == $id) {
                    return true;
                }
            }
            return false;
        })->values();
        return response()->json([
            'books' => $filtered
        ]);
    }
}
