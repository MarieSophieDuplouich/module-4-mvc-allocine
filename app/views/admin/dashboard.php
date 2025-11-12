<!-- app/views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/public/css/style.css">
 
</head>

<body>
    <h1>Tableau de bord - Administration</h1>
    <p>Bienvenue dans l’espace d’administration du site !</p>
    <nav>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Utilisateurs</a></li>
        </ul>
    </nav>

        <!-- CRUD au-dessus des films-->


    <div class="crud">

        <main class="main-content">
            <div class="actions">
                <!-- //controleur/class et méthode controller filmcontroller methode add-->
                <a href="/film/add" class="btn">Ajouter un film</a>
            </div>

            <table class="film-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Date sortie</th>
                        <th>Genre</th>
                        <th>Auteur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="">
                    <?php if (!empty($getFilms) && is_array($getFilms)): ?>
                        <?php foreach ($getFilms as $film): ?>
                            <tr>
                                <td><?= $film->getId() ?></td>
                                <td><?= htmlspecialchars($film->getName()) ?></td>
                                <td><?= $film->getDateSortie() ?></td>
                                <td><?= $film->getGenre() ?></td>
                                <td><?= htmlspecialchars($film->getAuteur()) ?></td>
                                <td>
                                    <a href="/admin/film/edit/<?= $film->getId() ?>" class="btn-edit">Modifier</a>
                                    <a href="/admin/film/delete/<?= $film->getId() ?>" class="btn-delete">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Aucun film disponible</td>
                        </tr>
                    <?php endif; ?>
                    </form>
                </tbody>
            </table>
        </main>
    </div>

    <form action="">
        <div class="box">


            <?php if (!empty($getFilms) && is_array($getFilms)): ?>

                <?php foreach ($getFilms as $getFilm): ?>
                    <div class="item">
                        <h3><?= htmlspecialchars($getFilm->getName()) ?></h3>
                        <img src="http://unsplash.it/100/100" alt="<?= htmlspecialchars($getFilm->getName()) ?>">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun film disponible</p>
            <?php endif; ?>
        </div>
        <div class="buttons">
            <span class="prev"></span>
            <span class="next"></span>
        </div>
    </form>




    <script>
        let prev = document.querySelector('.prev');
        let next = document.querySelector('.next');

        next.addEventListener('click', function() {
            let items = document.querySelectorAll('.item');
            document.querySelector('.box').appendChild(items[0]);

        })

        prev.addEventListener('click', function() {
            let items = document.querySelectorAll('.item');
            document.querySelector('.box').prepend(items[items.length - 1]);

        })
    </script>

</body>

</html>