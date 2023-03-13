<?php if ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Title</title>
    </head>
    <body>
      <div>
        <h1>Ajouter un film</h1>
      </div>
      <?php if (isset($_GET['e'])): ?>
        <div>
          <h3 style="color: red">Impossible d'ajouter un film</h3>
        </div>
      <?php endif ?>
      <div>
        <form method="post">
          <label for="title">Titre</label>
          <input type="text" name="title" id="title">
          <label for="year">Année</label>
          <input type="number" name="annee" id="annee">
          <label for="genre">Genre</label>
          <input type="text" name="genre" id="genre">
          <button type="submit">Enregistrer</button>
        </form>
      </div>
    </body>
  </html>
<?php else: ?>
  <?php
    require_once '../Database.php';

    $title = $_POST['title'];
    $annee = $_POST['annee'];
    $genre = $_POST['genre'];
    $db = new Database();

    if ($db->insertMovie($title, $annee, $genre)) {
      header('Location: /');
    } else {
      header('Location: /add.php?e=1');
    }
  ?>
<?php endif ?>