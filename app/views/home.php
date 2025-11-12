<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css" class="css">
    <title>Accueil Allociné</title>
</head>

<body>
    <header>
     <h1>Accueil Allociné</h1>
    
    </header>
   

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
    </form>
    <div class="buttons">
        <span class="prev"></span>
        <span class="next"></span>
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