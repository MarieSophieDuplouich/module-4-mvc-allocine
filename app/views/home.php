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
    
    </header>
    <h1>Accueil Allociné</h1>
    


  
    <div class="box">
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
        <div class="item"><img src="http://unsplash.it/100/100" alt=""></div>
    </div>
    <div class="buttons">
        <span class="prev"></span>
         <span class="next"></span>
    </div>

   


    <script>

        let prev = document.querySelector('.prev');
        let next = document.querySelector('.next');

        next.addEventListener('click',function(){
        let items = document.querySelectorAll('.item');
        document.querySelector  ('.box').appendChild(items[0]);

        })

            prev.addEventListener('click',function(){
        let items = document.querySelectorAll('.item');
        document.querySelector  ('.box').prepend(items[items.length -1]);

        })
    </script>
</body>

</html>