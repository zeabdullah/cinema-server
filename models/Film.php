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
        ];
    }
}