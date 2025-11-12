<!-- app/views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <!-- <link rel="stylesheet" href="/public/css/style.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* outline: 1px red solid; */
        }

        body {
            background: #000200;
            color: #fecc00;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* --- Carrousel 3D --- */
        .box {
            position: relative;
            width: 800px;
            height: 400px;
            margin: 50px auto 20px auto;
            /* espace pour les boutons */
            perspective: 1000px;
        }



        .box .item {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 300px;
            transform-style: preserve-3d;
            transform-origin: center center;
            transition: 0.5s;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
            user-select: none;
            transform: translate(-50%, -50%) rotateY(0deg);
            /* <-- centrer */
        }



        .box .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .box .item h3 {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: #fecc00;
            margin: 0;
            padding: 5px 0;
        }

        /* Positions initiales 3D */
   .box .item:nth-child(1) { transform: translate3d(-250px,-50%,0) scale(0.8) rotateY(25deg); z-index:1; }
.box .item:nth-child(2) { transform: translate3d(-150px,-50%,0) scale(0.9) rotateY(15deg); z-index:2; }
.box .item:nth-child(3) { transform: translate3d(0,-50%,0) scale(1) rotateY(0deg); z-index:3; }
.box .item:nth-child(4) { transform: translate3d(150px,-50%,0) scale(0.9) rotateY(-15deg); z-index:2; }
.box .item:nth-child(5) { transform: translate3d(250px,-50%,0) scale(0.8) rotateY(-25deg); z-index:1; }

        /* --- Boutons --- */
        .buttons {
            position: relative;
            /* plus absolute */
            margin: 20px auto 0 auto;
            /* centré et juste au-dessus du CRUD */
            display: flex;
            gap: 20px;
            justify-content: center;
            z-index: 10;
            /* au-dessus des cards si besoin */
        }


        .buttons span {
            width: 50px;
            height: 50px;
            border: 2px solid #fecc00;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.5;
            transition: 0.3s;
        }

        .buttons span:hover {
            opacity: 1;
        }

        .buttons span::before {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            border-top: 2px solid #fecc00;
            border-left: 2px solid #fecc00;
        }

        .buttons span:first-child::before {
            transform: rotate(-45deg);
        }

        .buttons span:last-child::before {
            transform: rotate(135deg);
        }

        /* --- CRUD --- */
        .crud {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: #111;
            padding: 20px;
            border-radius: 8px;
        }

        .film-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            color: #000;
        }

        .film-table th,
        .film-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .film-table th {
            background-color: #333;
            color: #fff;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-delete:hover {
            background-color: #da190b;
        }

        .actions {
            margin-bottom: 15px;
        }

        .btn {
            background-color: #fecc00;
            color: #000;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #d4b100;
        }
    </style>
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


    <!-- CRUD en-dessous des films-->


    <div class="crud">

        <main class="main-content">
            <div class="actions">
                <a href="/admin/film/add" class="btn">Ajouter un film</a>
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