

<?php
    // Connect to database
    $db = new mysqli("localhost", "root", "root", "socialnetwork");

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get post ID
    $postID = $_GET['postID'];

    // Check if post has already been liked by current user
    $sql_check = "SELECT * FROM likes WHERE post_id = '$postID' AND user_id = '$user_id'";
    $result = mysqli_query($db, $sql_check);
    if (mysqli_num_rows($result) > 0) {
        // Post has already been liked
        echo "Post has already been liked";
    } else {
        // Post has not been liked, so add like to database
        $sql_insert = "INSERT INTO likes (post_id, user_id) VALUES ('$postID', '$user_id')";
        if (mysqli_query($db, $sql_insert)) {
            echo "Post liked";
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($db);
        }
    }

    // Close connection
    mysqli_close($db);
?>






<?php
    // Connect to database
    $db = new mysqli("localhost", "root", "root", "socialnetwork");

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get post ID
    $postID = $_GET['postID'];

    // Check if post has already been liked by current user
    $sql_check = "SELECT * FROM likes WHERE post_id = '$postID' AND user_id = '$user_id'";
    $result = mysqli_query($db, $sql_check);
    if (mysqli_num_rows($result) > 0) {
        // Post has already been liked, so remove like from database
        $sql_delete = "DELETE FROM likes WHERE post_id = '$postID' AND user_id = '$user_id'";
        if (mysqli_query($db, $sql_delete)) {
            echo "Post unliked";
        } else {
            echo "Error: " . $sql_delete . "<br>" . mysqli_error($db);
        }
    } else {
        // Post has not been liked
        echo "Post has not been liked";
    }

    // Close connection
    mysqli_close($db);
?>

                    

                    ?>
                     <form action="news.php" method="post" >
                          <input type="hidden" name="like_number" value="1">
                           <input type="submit" value="♥ <?php echo $fetchInfo['like_number'] ?> ">  <!-- //ici la valeur/montant des likes est dynamique -->

                     </form>