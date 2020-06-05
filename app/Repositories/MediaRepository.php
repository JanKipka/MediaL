<?php


namespace App\Repositories;


use App\Book;
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

    public function persistMedia($media)
    {

    }
}
