<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Genre;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $thriller = new Genre();
        $thriller->setName('Thriller');
        $thriller->save();

        $drama = new Genre();
        $drama->setName('Drama');
        $drama->save();

        $scifi = new Genre();
        $scifi->setName('Science-Fiction');
        $scifi->save();

        $crime = new Genre();
        $crime->setName('Crime');
        $crime->save();

        $contemporary = new Genre();
        $contemporary->setName('Contemporary');
        $contemporary->save();

        $romance = new Genre();
        $romance->setName('Romance');
        $romance->save();

        /*$book = new Book();
        $book->setTitle('Verblendung');
        $book->setFormat(\App\Format::PAPERBACK);
        $book->genre()->associate($thriller);
        $book->save();

        $author = new \App\Author();
        $author->setFirstName('Stieg');
        $author->setLastName('Larsson');
        $author->save();

        $book->author()->save($author);*/
    }
}
