<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un film</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Modifier un film</h1>
    <form action="/film/edit/<?= $film->getId() ?>" method="post">
        <label>Nom du film</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($film->getName()) ?>" required>
        
        <label>Date de sortie</label>
        <input type="date" name="date_sortie" value="<?= $film->getDateSortie() ?>" required>
        
        <label>Genre</label>
        <input type="text" name="genre" value="<?= $film->getGenre() ?>" required>
        
        <label>Auteur</label>
        <input type="text" name="auteur" value="<?= htmlspecialchars($film->getAuteur()) ?>" required>
        
        <button type="submit">Mettre à jour</button>
    </form>
    <a href="/admin/dashboard">Retour au dashboard</a>
</body>
</html>
