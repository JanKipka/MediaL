<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Director;
use App\Format;
use App\Genre;
use App\Repositories\MediaRepositoryInterface;
use GuzzleHttp\Client;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function addBook(Request $request)
    {
        $user = Auth::user();
        $book = null;
        try {
            $book = $request->json('book');
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
                    'isbn' => $book->isbn,
                    'imageLink' => $book->imageLink,
                    'pageCount' => $book->pageCount,
                    'publishedDate' => $book->publishedDate,
                    'textSnippet' => $book->textSnippet,
                    'format_id' => $book->format,
                    'genre_id' => $book->genre
                ]);
                $newBook->save();
                $newBook->users()->save($user);

                if ($book->read) {
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

    public function queryBookApi(Request $request)
    {
        $base_uri = 'https://www.googleapis.com/books/v1/volumes?q=';
        try {
            $searchAuthor = $request['queryAuthor'];
            $searchTitle = $request['queryTitle'];
            $searchISBN = $request['queryISBN'];
            $plusNeeded = false;
            $client = new Client();// add title query
            if (isset($searchTitle)) {
                $searchTitle = trim($searchTitle);
                $searchTitle = str_replace(' ', '+', $searchTitle);
                $base_uri = $base_uri . $searchTitle;
                $plusNeeded = true;
            }
            if (isset($searchAuthor)) {
                $searchAuthor = trim($searchAuthor);
                $searchAuthor = str_replace(' ', '+', $searchAuthor);
                $base_uri = $base_uri . ($plusNeeded ? '+' : '') . 'inauthor:' . $searchAuthor;
                $plusNeeded = true;
            }
            if (isset($searchISBN)) {
                $base_uri = $base_uri . ($plusNeeded ? '+' : '') . 'isbn:' . $searchISBN;
            }
            $base_uri = $base_uri . '&maxResults=10';
            $base_uri = $base_uri . '&printType=books';
            $base_uri = $base_uri . '&key=' . env('GOOGLE_API_KEY');
            Log::info('Calling ' . $base_uri);
            $response = $client->get($base_uri);
            Log::info($response->getStatusCode());
            $jsonBody = json_decode($response->getBody(), true);
            if ($response->getStatusCode() != 200) {
                return response()->json('Error occured: ' . $response->getStatusCode(), 500);
            } else {
                return response()->json($jsonBody);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('Internal error occured: ' . $e->getMessage(), 500);
        }
    }
}
