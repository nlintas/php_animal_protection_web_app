<?php
include("functions.php");

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Notifications</title>
    </head>
    <body>
        <div class="container py-4">
            <button type="button" class="btn btn-primary btn btn-info" data-toggle="modal" data-target="#exampleModalScrollable">
                Notifications
                <?php
                $query = "SELECT * from `notification` where `status` = 'unread' order by `date_created` DESC";
                if(count(fetchAll($query))>0){
                ?>
                <span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
                <?php
                }
                ?>
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade " id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Notifications:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <?php
                        $query = "SELECT * from `notification` order by `date_created` DESC";
                        if(count(fetchAll($query))>0){
                            foreach(fetchAll($query) as $i){
                        ?>
                        <a style ="
                                   <?php
                                if($i['status']=='unread'){
                                    echo "font-weight:bold;";
                                }
                                   ?>
                                   " class="dropdown-item alert alert-primary" href="view.php?notificationID=<?php echo $i['notificationID'] ?>">
                            <small><i><?php echo date('F j, Y, g:i a',strtotime($i['date_created'])) ?></i></small><br/>
                            <?php 

                                       $usernameQuery = 'SELECT username FROM user, comment, notification where comment.notificationID = notification.notificationID and user.userID = comment.userID;';

                                $usernameLikeQuery = 'SELECT username FROM user, user_likes, notification where user_likes.notificationID = notification.notificationID and user.userID = user_likes.userID;';

                                $usernameReply = 'SELECT username FROM reply, comment, user WHERE reply.newCommentID = comment.commentID and comment.userID = user.userID; ';




                                if($i['type']=='comment'){
                                    foreach(fetchAll($usernameQuery) as $k){
                                        echo ucfirst($k['username'])." commented on your post.";//pass here the variable for the username
                                    }
                                }else if($i['type']=='like'){
                                    foreach(fetchAll($usernameLikeQuery) as $l){
                                        echo ucfirst($l['username'])." liked your post.";
                                    }
                                }
                                else{
                                    foreach(fetchAll($usernameReply) as $ur){
                                        echo ucfirst($ur['username'])." replied to your comment.<br/>"; 

                                    }
                                }

                            ?>
                        </a>
                        <?php
                            }
                        }
                        else{
                            echo "No Records yet.";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn btn-info" data-dismiss="modal">Close</button>
                        <!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div>
            </div>
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>