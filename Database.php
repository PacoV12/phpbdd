<?php
  
  require_once 'Database.php';

  $title = $_POST['title'];
  $year = $_POST['year'];
  $genre = $_POST['genre'];
  $db = new Database();


/**
 * Interfacing our web application and our database
 *
 * SQL queries must be run through this class and never outside
 */
class Database {

  private PDO $pdo;

  public function __construct() {
    try {
      $this->pdo = new PDO('mysql:host=localhost; dbname=id20407984_pacov', 'id20407984_pacova', 'KF{[\LwgIH6~#MJr');
    // If connection failed discard this error and die()
    } catch(PDOException $ex) {
      die("Failed to connect to database server");
    }
  }

  /** Get all movies in database */
  public function fetchAll(): array {
    $query = $this->pdo->query('SELECT * FROM movies');

    if ($query) {
      $all = $query->fetchAll(PDO::FETCH_ASSOC);

      if ($all) return $all;
    }

    return [];
  }

  /** Get all years */
  public function fetchAllYears(): array {
    $query = $this->pdo->query('SELECT DISTINCT year FROM movies');
    $all = [];

    if ($query !== false) {
      $all = $query->fetchAll(PDO::FETCH_COLUMN);
    }

    return $all;
  }

  /** Get movies field "year" */
  public function fetchMoviesFromYear(int $annee): array {
    $prep = $this->pdo->prepare('SELECT * FROM movies WHERE annee = ?');

    if ($prep->execute([ $annee ])) {
      $all = $prep->fetchAll(PDO::FETCH_ASSOC);
      if ($all) return $all;
    }

    return [];
  }

  /** Insert new movie in database */
  public function insertMovie(string $title, int $annee, string $genre): bool {
    $prep = $this->pdo->prepare('INSERT INTO movies (title, genre, annee) VALUE (?, ?, ?)');

    if ($prep->execute([ $title, $genre, $annee ])) {
      return true;
    }

    return false;
  }
}
