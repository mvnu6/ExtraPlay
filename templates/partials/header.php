
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <title>extraPlay.</title>
    </head>
    <body class="login register order explore">
    
        <header>
            <nav>
                <article>
                    <a href="/"><h1 class="logo">extraPlay.</h1></a>
                </article>

                
                
                <article class="right-side redirection">
                    <section>
                    <?php
                
                    if (isset($_SESSION['username'])) {
                        // Si l'utilisateur est connecté, affiche "Se déconnecter"
                        echo '<a href="/logout" class="account" id="logout">Se déconnecter</a>';
                    } else {
                        // Si l'utilisateur n'est pas connecté, affiche "Inscris-toi"
                        echo '<a href="/register" class="account" id="login">Inscris-toi</a>';
                    }
                    ?>
                        <a href="/login" class="account" id="register">Jouer</a>
                    </section>
                    
                </article>
            </nav>
        </header>



        
