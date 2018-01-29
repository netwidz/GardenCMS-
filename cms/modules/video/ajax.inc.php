<?php
require_once ('../../../config.inc.php');

if(isset($_POST)){

    $ObjVideo = new video();

    //add new item
    if(isset($_POST['_task']) && ($_POST['_task']=='add')){

        $ObjVideo -> setVideo_name(db::addslash($_POST['video_name']));
        $ObjVideo -> setArtist_id(db::addslash('3'));
        $limit_size = 8388608;
        $file_size = $_FILES['file_name']['size'];
        if($file_size >= $limit_size)
        {
            echo "<div class='warning'>Unable to upload file.</div>";
        }
        else
        {
            $allowedUploads = 3;
            $query = sprintf("SELECT COUNT(artist_id) AS artistCount FROM artist_videos WHERE artist_id='3' GROUP BY artist_id");
            $result = db::execute_query($query);
            $limit = mysql_fetch_row($result);
            if($limit[0] >= $allowedUploads )
            {
                echo "<div class='warning'>You cannot upload more than 3 videos.</div>";
            }
            else
            {
                $ObjVideo -> uploadFile('file_name',$_FILES['file_name']['name']);
                $ObjVideo -> save();
                echo "<div class='success'>Video added successfully.</div>";
            }
        }
    }

    if(isset($_POST['_task']) && ($_POST['_task']=='edit')){

        $ObjVideo -> setId(db::addslash($_POST['id']));
        $ObjVideo -> setVideo_name(db::addslash($_POST['video_name']));
        $ObjVideo -> setStatus(db::addslash($_POST['status']));
        $ObjVideo -> update();
    }

    if(isset($_POST['_task']) && ($_POST['_task']=='delete')){
        $ObjVideo -> setId($_POST['cid']);
        if($ObjVideo -> delete()){
            echo "<div class='success'>deleted successfully</div>";
        }
        else echo "<div class='warning'>Unable to delete the user</div>";
    }
}

?>
