<?php


namespace App\Repositories;


interface MediaRepositoryInterface
{

    public function getAllMediaForUser($id);

    public function getAllBooksForUser();

    public function getAllMoviesForUser();

    public function getMediaByID($mediaId);

    public function persistBook($title, $format, $author, $genre);

    public function persistMovie($title, $format, $director, $genre);

    public function getNumberOfGenres();

}
