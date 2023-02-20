<?php
$enCoursDeTraitement = isset($_POST['following_id']);
                    if ($enCoursDeTraitement)
                    {
                        
                        $new_followingId = $_POST['following_id'];
                        $new_followedId = $_POST['followed_id'];
                       
                        $new_followingId  = intval($mysqli->real_escape_string($new_followingId));
                        $new_followedId  = intval($mysqli->real_escape_string($new_followedId));                      
                        $lInstructionSql = "INSERT INTO followers "
                                . "(id, followed_user_id, following_user_id) "
                                . "VALUES (NULL, "
                                . $new_followedId . ", "
                                . $new_followingId. "); "
                                ;
                       
                        $ok = $mysqli->query($lInstructionSql);
                        if ( ! $ok)
                        {
                            echo "Impossible d'ajouter aux abonnements: " . $mysqli->error;
                        } else
                        {
                            echo "Vous êtes abonné.e";
                        }
                        
                    }
                    ?>
                  <?php if ($userId != $_SESSION['connected_id']) { ?>

                <form action="wall.php?user_id=<?php echo $userId; ?>" method="post">
                  <input type='hidden' name='following_id' value='<?php echo $_SESSION['connected_id']?>'>
                  <input type='hidden' name='followed_id' value='<?php echo  $userId?>'>
                  <input type="submit" value="S'abonner" id="abonnement">
                </form>
                <?php }?>