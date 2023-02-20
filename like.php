<?php

$postId = $post['postId'];

$enCoursDeTraitement = isset($_POST['like_number']);

                    if ($enCoursDeTraitement)
                    { 
                        $new_like_count = $_POST['like_number'];
                        $new_user_id = $userid;
                        $new_post_id = $postId;

           
                       
                        $new_user_id  = $mysqli->real_escape_string($new_user_id);
                        $new_post_id  = $mysqli->real_escape_string($new_post_id);
                        
                       
                        $lInstructionSql = "INSERT INTO likes "
                        . "(id, user_id, post_id) "
                        . "VALUES (NULL, "
                        . $new_user_id . ", "
                        . $new_post_id . "); "
                        ;
       
               
                        $ok = $mysqli->query($lInstructionSql);
                        if ( ! $ok)
                        {
                            echo "like erreur" . $mysqli->error . $lInstructionSql;
                        } else
                        {
                            echo "like saved";
                        }
                        
                    }

                    

                    ?>
                     <form action="news.php" method="post" >
                          <input type="hidden" name="like_number" value="1">
                           <input type="submit" value="♥ <?php echo $post['like_number'] ?> ">  <!-- //ici la valeur/montant des likes est dynamique -->

                     </form>