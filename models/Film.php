<?php
require_once 'Model.php';

class Film extends Model
{
    private string $title;
    private string $genre;
    private int $release_year;
    private int $duration;
    private string|null $description;
    private string|null $trailer_url;
    private string $poster_url;

    private array $reviews = [];
    private array $cast = [];

    protected static string $table_name = 'films';

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->title = $data['title'];
        $this->genre = $data['genre'];
        $this->description = $data['description'] ?? null;
        $this->release_year = $data['release_year'];
        $this->trailer_url = $data['trailer_url'] ?? null;
        $this->poster_url = $data['poster_url'] ?? null;
        $this->duration = $data['duration'];
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getReleaseYear()
    {
        return $this->release_year;
    }
    public function getTrailerUrl()
    {
        return $this->trailer_url;
    }
    public function getPosterUrl()
    {
        return $this->poster_url;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function getReviews()
    {
        return $this->reviews;
    }
    public function getCast()
    {
        return $this->cast;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }
    public function setReleaseYear(int $release_year)
    {
        $this->release_year = $release_year;
    }
    public function setTrailerUrl(string $trailer_url)
    {
        $this->trailer_url = $trailer_url;
    }
    public function setPosterUrl(string $trailer_url)
    {
        $this->trailer_url = $trailer_url;
    }
    public function setDuration(int $duration)
    {
        $this->duration = $duration;
    }

    public static function search(string $search = '', int $page = 1, string $genre = null)
    {
        $db = Database::getInstance();

        $page = max($page, 1);
        $isGenreSet = isset($genre) && $genre !== '';

        $dataSql = sprintf(
            "SELECT * FROM %s 
                WHERE title LIKE ? %s
                LIMIT %d
                OFFSET %d
            ",
            static::$table_name,
            $isGenreSet ? "AND genre like ?" : "",
            static::LIMIT,
            static::LIMIT * ($page - 1)
        );
        $countSql = sprintf(
            "SELECT COUNT(*) 
                FROM %s 
                WHERE title LIKE ? %s
            ",
            static::$table_name,
            $isGenreSet ? "AND genre like ?" : "",
        );

        $dataQuery = $db->prepare($dataSql);
        $countQuery = $db->prepare($countSql);

        $searchWithWildcard = "%$search%";
        if ($isGenreSet) {
            $dataQuery->bind_param('ss', $searchWithWildcard, $genre);
            $countQuery->bind_param('ss', $searchWithWildcard, $genre);
        } else {
            $dataQuery->bind_param('s', $searchWithWildcard);
            $countQuery->bind_param('s', $searchWithWildcard);
        }

        $dataQuery->execute();
        $films = $dataQuery->get_result()->fetch_all(MYSQLI_ASSOC);

        $countQuery->execute();
        $count = $countQuery->get_result()->fetch_row()[0];

        return [
            'page' => $page,
            'count' => $count,
            'limit' => static::LIMIT,
            'data' => $films,
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'genre' => $this->genre,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'trailer_url' => $this->trailer_url,
            'poster_url' => $this->poster_url,
            'duration' => $this->duration,
        ];
    }
}