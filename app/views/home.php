<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css" class="css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Accueil Allociné</title>
</head>

<body>
    <header>
     <h1>Allociné</h1>
    <div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>



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