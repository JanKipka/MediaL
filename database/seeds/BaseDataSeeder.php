<?php

use App\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseDataSeeder extends Seeder
{
    /**
     * Run the database seeds for base data, including some default genre and format values.
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
    }
}
