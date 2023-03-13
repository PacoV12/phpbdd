<?php
  require_once '/Database.php';

  $store = new Database();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Title</title>
  </head>
  <body>
    <div>
      <h2>Films Enregistrés</h2>
    </div>
    <div>
      <form method="get">
        <label for="y">Afficher par année</label>
        <select id="y" name="y">
          <option value="all">Toutes</option>
          <?php foreach ($store->fetchAllYears() as $annee): ?>
            <option><?= $annee ?></option>
          <?php endforeach ?>
        </select>
        <button type="submit">Rechercher</button>
      </form>
    </div>
    <table>
      <tr>
        <th>#</th>
        <th>Titre</th>
        <th>Genre</th>
        <th>Année</th>
      </tr>
      <?php
        $movies = [];
        // Checking if query param "y" is present and use his value to sort movies
        if (isset($_GET['y']) && $_GET['y'] !== 'all') {
          $movies = $store->fetchMoviesFromYear(intval($_GET['y']));
        } else {
          $movies = $store->fetchAll();
        }
      ?>
      <?php foreach ($movies as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= $m['title'] ?></td>
          <td><?= $m['genre'] ?></td>
          <td><?= $m['annee'] ?></td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
