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

        $formatData = [
            [
                'name' => 'Paperback',
                'mediaFormat' => \App\MediaFormat::BOOK
            ], [
                'name' => 'Hardcover',
                'mediaFormat' => \App\MediaFormat::BOOK
            ], [
                'name' => 'Bluray',
                'mediaFormat' => \App\MediaFormat::MOVIE
            ], [
                'name' => 'DVD',
                'mediaFormat' => \App\MediaFormat::MOVIE
            ]
        ];

        DB::table('formats')->insert($formatData);
        $paperback = \App\Format::find(1);
        $bluray = \App\Format::find(3);
        $genreIds = Genre::all()->pluck('id')->toArray();

        factory(Book::class, 50)->create([
            'format_id' => $paperback->id
        ]);
        factory(\App\Movie::class, 50)->create([
            'format_id' => $bluray->id
        ]);
        factory(\App\Author::class, 30)->create();
        factory(\App\Director::class, 20)->create();
        factory(\App\User::class, 10)->create()->each(function ($user) {
            $user->profile()->save(factory(\App\Profile::class)->make());
        });

        $books = Book::all();
        $authors = \App\Author::all();
        $movies = \App\Movie::all();
        $directors = \App\Director::all();

        $books->each(function ($book) use ($authors) {
            $book->author()->attach(
                $authors->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        $movies->each(function ($movie) use ($directors) {
            $movie->directors()->attach(
                $directors->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        /*\App\Author::all()->each(function ($author) use ($books) {
            $author->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
            );
        });*/

        \App\User::all()->each(function ($user) use ($books) {
            $user->books()->attach(
                $books->random(rand(1, 10))->pluck('id')->toArray()
            );
        });

        \App\User::all()->each(function ($user) use ($movies) {
            $user->movies()->attach(
                $movies->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

        /*$thriller = new Genre();
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

        $formatData = [
            [
                'name' => 'Paperback',
                'mediaFormat' => \App\MediaFormat::BOOK
            ], [
                'name' => 'Hardcover',
                'mediaFormat' => \App\MediaFormat::BOOK
            ], [
                'name' => 'Bluray',
                'mediaFormat' => \App\MediaFormat::MOVIE
            ], [
                'name' => 'DVD',
                'mediaFormat' => \App\MediaFormat::MOVIE
            ]
        ];

        DB::table('formats')->insert($formatData);*/

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
