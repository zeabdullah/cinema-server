<?php
require_once 'Model.php';

class Film extends Model
{
    private string $title;
    private string|null $description;
    private string $genre;
    private int $release_year;
    private string|null $trailer_url;
    private int $duration;

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
        $this->duration = $data['duration'];
    }

    public static function create(array $data): self
    {
        $newFilmId = self::saveToDb($data);
        $data['id'] = $newFilmId;

        return new self($data);
    }

    public function save(): bool
    {
        $newUserId = self::saveToDb([
            'title' => $this->title,
            'genre' => $this->genre,
            'description' => $this->description,
            'release_year' => $this->release_year,
            'trailer_url' => $this->trailer_url,
            'duration' => $this->duration,
        ]);
        $this->id = $newUserId;

        return true;
    }

    private static function saveToDb(array $data): int
    {
        global $mysqli;

        $sql = sprintf(
            "INSERT INTO %s 
                (title, genre, description, release_year, trailer_url, duration) 
                values (?, ?, ?, ?, ?, ?)",
            static::$table_name
        );

        $query = $mysqli->prepare($sql);
        $query->execute([
            $data['title'],
            $data['genre'],
            $data['description'] ?? null,
            $data['release_year'],
            $data['trailer_url'] ?? null,
            $data['duration'],
        ]);

        return $query->insert_id;
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
            'duration' => $this->duration,
            'reviews' => $this->reviews,
            'cast' => $this->cast,
        ];
    }
}