<?php


namespace App\Repositories;


interface MediaRepositoryInterface
{

    public function getAllMediaForUser($id);

    public function getAllBooksForUser();

    public function getAllMoviesForUser();

    public function getMediaByID($mediaId);

    public function persistMedia($media);

}
