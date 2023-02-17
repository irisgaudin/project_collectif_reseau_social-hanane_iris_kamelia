<?php
session_start();
$userid = $_SESSION['connected_id'];
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration </title> 
        <meta name="author" content="Team Tech Empowerment">
        <link rel="stylesheet" href="style/style.css"/>


    </head>

    <body>

        
        <header>
                <img src="style/resoc.jpg" alt="Logo de notre réseau social"/>
                <nav id="menu">
                    <a href="news.php">plop</a>
                    <a href="wall.php?user_id=<?=$userid?>">Mur</a>
                    <a href="feed.php?user_id=<?=$userid?>">Flux</a>
                    <a href="tags.php?tag_id=1">Mots-clés</a>
                </nav>
                <nav id="user">
                    <a href="#">Profil</a>
                    <ul>
                        <li><a href="settings.php?user_id=<?=$userid?>">Paramètres</a></li>
                        <li><a href="followers.php?user_id=<?=$userid?>">Mes suiveurs</a></li>
                        <li><a href="subscriptions.php?user_id=<?=$userid?>">Mes abonnements</a></li>
                    </ul>

                </nav>

        </header>

