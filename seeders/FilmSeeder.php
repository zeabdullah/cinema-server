<?php
require '../models/Film.php';

class FilmSeeder extends Seeder
{
    public static function seed(): bool
    {
        $filmsToCreate = [
            [
                'title' => 'Gladiator',
                'genre' => 'action',
                'release_year' => 2000,
                'duration' => 155,
                'description' => 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.',
                'trailer_url' => 'https://www.youtube.com/watch?v=owK1qxDselE',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/f/fb/Gladiator_%282000_film_poster%29.png/250px-Gladiator_%282000_film_poster%29.png',
            ],
            [
                'title' => 'The Matrix',
                'genre' => 'sci-fi',
                'release_year' => 1999,
                'duration' => 136,
                'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'trailer_url' => 'https://www.youtube.com/watch?v=vKQi3bBA1y8',
                'poster_url' => 'https://m.media-amazon.com/images/I/51vpnbwFHrL._AC_SY679_.jpg',
            ],
            [
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'genre' => 'fantasy',
                'release_year' => 2001,
                'duration' => 178,
                'description' => 'A meek Hobbit and eight companions set out on a journey to destroy the One Ring and save Middle-earth from the Dark Lord Sauron.',
                'trailer_url' => 'https://www.youtube.com/watch?v=V75dMMIW2B4',
                'poster_url' => 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p28828_p_v8_ao.jpg',
            ],
            [
                'title' => 'Titanic',
                'genre' => 'drama',
                'release_year' => 1997,
                'duration' => 195,
                'description' => 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.',
                'trailer_url' => 'https://www.youtube.com/watch?v=kVrqfYjkTdQ',
                'poster_url' => 'https://www.themoviedb.org/t/p/w1280/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg',
            ],
            [
                'title' => 'Jurassic Park',
                'genre' => 'thriller',
                'release_year' => 1993,
                'duration' => 127,
                'description' => 'During a preview tour, a theme park suffers a major power breakdown that allows its cloned dinosaur exhibits to run amok.',
                'trailer_url' => 'https://www.youtube.com/watch?v=lc0UehYemQA',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjM2MDgxMDg0Nl5BMl5BanBnXkFtZTgwNTM2OTM5NDE@._V1_.jpg',
            ],
            [
                'title' => 'Fight Club',
                'genre' => 'drama',
                'release_year' => 1999,
                'duration' => 139,
                'description' => 'An insomniac office worker and a soap maker form an underground fight club that evolves into something much more.',
                'trailer_url' => 'https://www.youtube.com/watch?v=SUXWAEX2jlg',
                'poster_url' => 'https://m.media-amazon.com/images/I/51v5ZpFyaFL._AC_SY679_.jpg',
            ],
            [
                'title' => 'The Lion King',
                'genre' => 'animation',
                'release_year' => 1994,
                'duration' => 88,
                'description' => 'Lion prince Simba and his father are targeted by his bitter uncle, who wants to ascend the throne himself.',
                'trailer_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'poster_url' => 'https://i.ebayimg.com/images/g/uMwAAOSwux5YLgjU/s-l1200.jpg',
            ],
            [
                'title' => 'Saving Private Ryan',
                'genre' => 'drama',
                'release_year' => 1998,
                'duration' => 169,
                'description' => 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.',
                'trailer_url' => 'https://www.youtube.com/watch?v=zwhP5b4tD6g',
                'poster_url' => 'https://www.movieposters.com/cdn/shop/products/a50e840fe702c59aa6633693faf23366_c6d6de8b-59f0-4145-8e5c-6e7cd71dc52e.jpg?v=1573593806',
            ],
            [
                'title' => 'The Social Network',
                'genre' => 'biography',
                'release_year' => 2010,
                'duration' => 120,
                'description' => 'The story of the founding of Facebook and the resulting lawsuits.',
                'trailer_url' => 'https://www.youtube.com/watch?v=lB95KLmpLR4',
                'poster_url' => 'https://www.movieposters.com/cdn/shop/products/84d64a25ef3d23b652c5ea42f419e0d8_a1f6f969-9077-4792-83f6-a20e83fea71a_480x.progressive.jpg?v=1573591596',
            ],
        ];

        foreach ($filmsToCreate as $f) {
            Film::create($f);
        }

        return true;
    }
}