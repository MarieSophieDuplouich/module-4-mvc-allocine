<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un film</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Ajouter un film</h1>
    <form action="/film/add" method="post">
        <label>Nom du film</label>
        <input type="text" name="nom" required>
        
        <label>Date de sortie</label>
        <input type="date" name="date_sortie" required>
        
        <label>Genre</label>
        <input type="text" name="genre" required>
        
        <label>Auteur</label>
        <input type="text" name="auteur" required>
        
        <button type="submit">Ajouter</button>
    </form>
    <a href="/admin/dashboard">Retour au dashboard</a>
</body>
</html>
