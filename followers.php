<?php
    include("header.php"); 
?>

<?php
if (!isset($_SESSION['connected_id'])){
    echo("Acces refusé! Connectez-vous");
    header("location:login.php");  
}
?>
        <div id="wrapper">          
           
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                while ($post = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article id="liste">
                    <img src="style/user.jpg" alt="blason"/>
                        <h3> <a href="wall.php?user_id=<?php echo $post['id'] ?>"><?php echo $post['alias'] ?> </a></h3>
                        <p> <?php echo $post['id']
                        ?></p>
                    </article>
                <?php
                    }
                ?>
            </main>
        </div>

        