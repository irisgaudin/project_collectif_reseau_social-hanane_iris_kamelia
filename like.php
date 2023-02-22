<?php

$postId = $post['postId'];
//ajouter une verif si le post a deja ete liké (peut etre check la requete SQL pour recup le post id)
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
                      
                        }
                        
                        
                    }

                    

                    ?>
                     <form action="news.php" method="post" >
                          <input type="hidden" name="like_number" value="1">
                          <input id="likebutton" type="submit" value="♥ <?php echo $post['like_number'] ?> ">  <!-- //ici la valeur/montant des likes est dynamique -->

                     </form>
                     