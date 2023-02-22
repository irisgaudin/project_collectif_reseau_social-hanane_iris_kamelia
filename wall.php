<?php

session_start();
$userid = $_SESSION['connected_id'];
// var_dump($userid);
?>


<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration </title> 
        <meta name="author" content="Team Tech Empowerment">
        <link rel="stylesheet" href="style/wall.css"/>


    </head>

    <body>


       

                <header>
               
                <nav id="menu">
                    <a href="news.php">Actualités</a>
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
                        <li><a href="logout.php">Déconnexion</a></li>
                        
                    </ul>

                </nav>

        </header>

        
        
        



<?php

if (!isset($_SESSION['connected_id'])){
    // echo("Acces refusé! Connectez-vous");
    header("location:login.php");
}
?>  

        <div id="wrapper">
            <?php
            /**
             * Etape 1: Le mur concerne un utilisateur en particulier
             * La première étape est donc de trouver quel est l'id de l'utilisateur
             * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
             * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
             * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
             */
            $userId =intval($_GET['user_id']);
            ?>
            <?php
            /**
             * Etape 2: se connecter à la base de donnée
             */
            $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            ?>

            
                
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */                
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
               // echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                
                
                    <?php  include("abonnement.php");?>
                
           
            
            <main>
           
            <article id="message">
           
                        <h2>Poster un message</h2>

                        <?php
                        /**
                         * BD
                         */
                        $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                        /**
                         * Récupération de la liste des auteurs
                         */


                        /**
                         * TRAITEMENT DU FORMULAIRE
                         */
                        // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                        // si on recoit un champs email rempli il y a une chance que ce soit un traitement
                        $enCoursDeTraitement = isset($_POST['content']);
                        if ($enCoursDeTraitement)
                        {
                        //     // on ne fait ce qui suit que si un formulaire a été soumis.
                        //     // Etape 2: récupérer ce qu'il y a dans le formulaire @todo: c'est là que votre travaille se situe
                        //     // observez le résultat de cette ligne de débug (vous l'effacerez ensuite)
                        // // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                        //     // et complétez le code ci dessous en remplaçant les ???
                        //     $authorId = $_POST['user_id'];
                            $postContent = $_POST['content'];


                        //     //Etape 3 : Petite sécurité
                        //     // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                        //     $authorId = intval($mysqli->real_escape_string($authorId));
                            $postContent = $mysqli->real_escape_string($postContent);

                            //Etape 4 : construction de la requete
                            $lInstructionSql = "INSERT INTO posts (id, user_id, content, created, parent_id) "
                        . "VALUES (NULL, "
                        . $userid . ", "
                        . "'" . $postContent . "', "
                        . "NOW(), "
                        . "NULL);";
                            // Etape 5 : execution
                            $ok = $mysqli->query($lInstructionSql);
                            if ( ! $ok)
                            {
                                echo "Impossible d'ajouter le message: " . $mysqli->error;
                            } 
                        }
                        ?> 

                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
                                // collect value of input field
                                $data = $_REQUEST['content'];
                               
                                if (empty($data)) {
                                    echo "data is empty";
                                }
                               }
                               
                        ?>



                        <form action="wall.php?user_id=<?php echo $userid ?>" method="post">
                            <input type='hidden' name='auteur' value='<?php echo $userid ?>'>
                            <dl>
                            
                                <dt><label for='message'>Message</label></dt>
                                <dd><textarea name='content'  cols="35" rows="8"  ></textarea></dd>
                            </dl>
                            <input type='submit' >
                        </form>      

                </article>

            
                <?php
                /**
                 * Etape 3: récupérer tous les messages de l'utilisatrice
                 */
                $laQuestionEnSql = "
                    SELECT posts.content, 
                    posts.created,
                     users.alias as author_name, 
                    posts.id as postId,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                 */
                while ($post = $lesInformations->fetch_assoc())
                {

                   // echo "<pre>" . print_r($post, 1) . "</pre>";
                    ?>  
                    <div >              
                    <article id="post">
                    
                        <h3>
                             <time><?php echo $post['created'] ?></time>
                        </h3>
                        <address> par <?php echo $post['author_name'] ?></address>
                        <div>
                        <p><?php echo $post['content'] ?></p>
                        </div>                                            
                        <footer>
                        <small><?php include('like.php') ?> </small>    
                            <?php $arrTags=explode(',',$post['taglist']);        
                            foreach ($arrTags as $tag) {           
                                 ?>         
                                   <a href="">#<?php echo $tag ?> </a>        
                                   <?php       
                                 }       
                                  ?>
                        </footer>
                        
                    </article>
                                </div>
                <?php } ?>


            </main>
        </div>

        </body>
</html>