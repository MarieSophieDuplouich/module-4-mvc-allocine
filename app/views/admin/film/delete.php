<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un film</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Supprimer le film</h1>
    <p>Êtes-vous sûr de vouloir supprimer le film "<strong><?= htmlspecialchars($film->getName()) ?></strong>" ?</p>
    
    <form action="/film/del/<?= $film->getId() ?>" method="post">
        <button type="submit">Oui, supprimer</button>
        <a href="/admin/dashboard">Annuler</a>
    </form>
</body>
</html>
