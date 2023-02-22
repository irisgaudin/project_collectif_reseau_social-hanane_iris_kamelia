<?php
$postId = $post['postId'];
$enCoursDeTraitement = isset($_POST[$postId]);

                    if ($enCoursDeTraitement)
                    {  
                        //recupere les data envoyees en post
                        $new_like_count = $_POST['like_number'];
                        $new_user_id = $userid;
                        $new_post_id = $postId;
                        

                        //converti les donnees
                        $new_user_id  = $mysqli->real_escape_string($new_user_id);
                        $new_post_id  = $mysqli->real_escape_string($new_post_id);
                        
                        //check if a unique row exists with the combination  of userId and PostID 
                        $requeteSQL = "SELECT * FROM likes WHERE user_id=$new_user_id AND post_id=$new_post_id";
                        $rowExist = $mysqli->query($requeteSQL)->fetch_all();
                
                        if($rowExist == []) {//insert
                            $lInstructionSql = "INSERT INTO likes "
                                . "(id, user_id, post_id) "
                                . "VALUES (NULL, "
                                . $new_user_id . ", "
                                . $new_post_id . "); "
                                ;
               
                             $ok = $mysqli->query($lInstructionSql);
                             
                                if (!$ok) {
                                    echo "like erreur" . $mysqli->error . $lInstructionSql;   
                                }

                        }

                    }
                        

                    ?>
                   

                    

                  
                     <form  method="post" >
                          <input type="hidden" name=<?php echo $postId ?> value="1">
                          <input id="likebutton" type="submit" value="♥ <?php echo $post['like_number'] ?> ">  <!-- //ici la valeur/montant des likes est dynamique -->

                     </form>
                     