<h1>Notifications</h1>

<?php

//do an interface for this shit

include("functions.php");

//$commentDescription =

$usernameQuery = 'SELECT username FROM user, comment, notification where comment.notificationID = notification.notificationID and user.userID = comment.userID;';

$usernameLikeQuery = 'SELECT username FROM user, user_likes, notification where user_likes.notificationID = notification.notificationID and user.userID = user_likes.userID;';

$descritpion = 'SELECT description FROM comment, notification WHERE notification.notificationID = comment.notificationID; ';

$reply = 'SELECT description FROM comment, reply WHERE comment.commentID = reply.newCommentID';

$usernameReply = 'SELECT username FROM reply, comment, user WHERE reply.newCommentID = comment.commentID and comment.userID = user.userID; ';

$id = $_GET['notificationID'];

$query ="UPDATE `notification` SET `status` = 'read' WHERE `notificationID` = $id;";
performQuery($query);

$q = "SELECT likes FROM comment WHERE notificationID = $id; ";
foreach(fetchAll($q) as $ql);

$query = "SELECT * from `notification` where `notificationID` = '$id';";
if(count(fetchAll($query))>0){
    foreach(fetchAll($query) as $i){
//         echo "{$ql['likes']}";
        if($i['type']=='like'){
            foreach(fetchAll($usernameLikeQuery) as $l){
                if($ql['likes'] > 4){
                     echo ucfirst($l['username'])." liked your comment on the post. <br/>".$i['date_created'];
                }
                else{
                    echo "You have {$ql['likes']} likes";
                }
//
            }
        }else if(($i['type']=='comment')){
            foreach(fetchAll($usernameQuery) as $k){
                foreach(fetchAll($descritpion) as $d){
                    echo ucfirst($k['username'])." commented: <br/>".$d['description'];
                }
            }
            //add a query to get the description from the template
        }else{
            foreach(fetchAll($usernameReply) as $ur){
                foreach(fetchAll($reply) as $r){
                    echo ucfirst($ur['username'])." replied to your comment:<br/>".$r['description'];
                }
            }
        }
    }
}


?><br/>
<a href="notification.php">Back</a>
<!doctype html>
