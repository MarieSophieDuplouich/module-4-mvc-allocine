<?php
require_once(__DIR__."/../models/FilmModel.php");

$filmModel = new FilmModel();

$id = $_POST['id'] ?? null;
$nom = $_POST['nom'] ?? '';
$date_sortie = $_POST['date_sortie'] ?? '';
$genre = $_POST['genre'] ?? '';
$auteur = $_POST['auteur'] ?? '';

if ($id) {
    $filmModel->edit($id, $nom, $date_sortie, $genre, $auteur);
}

header('Location: /admin/dashboard');
exit;
