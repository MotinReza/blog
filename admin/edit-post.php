<?php

if(isset($_GET["edit"])){

    $id = $_GET["edit"];
    
    $result = mysqli_query($con, "SELECT * FROM `posts` WHERE `id` = '$id' ");
    $row = mysqli_fetch_assoc($result);
    
}

$categories = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = 'active' ");

if(isset($_POST["save"])){
    
    $cat_id = $_POST["cat_id"];
    $title = $_POST["title"];
    $slug = $_POST["slug"];
    $content = $_POST["content"];
    $status = $_POST["status"];

    $user_id = $_SESSION["u_id"];

    $file_exp = explode('.', $_FILES["image"]["name"]);
    $file_end = end($file_exp);
    $file_name = date("ymdhis.").$file_end;

    
    $result = mysqli_query($con, "UPDATE `posts` SET `cat_id`='$cat_id',`title`='$title',`slug`='$slug',`content`='$content',`image`='$file_name',`status`='$status',`user_id`='$user_id' WHERE `id` = '$id' ");

    if($result){
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/post/".$file_name);
        $_SESSION["success"] = "Data insert success!";
        header("location: index.php?page=manage-post");
    }else{
        $_SESSION["error"] = "Data not save!";

    }
        



}

?>

<div class="row justify-content-md-center">
    <div class="col-md-8">

        <?php
        
        if(isset($_SESSION["success"])){
            echo "<div class='alert alert-info'>".$_SESSION["success"]."</div>";
        }

        if(isset($_SESSION["error"])){
            echo "<div class='alert alert-danger'>".$_SESSION["error"]."</div>";
            
        }
        
        ?>

        <div class="card">
            <div class="card-header">
                <h3>Update post form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="cat_id" class="form-label">Category:</label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">Select</option>

                            <?php foreach($categories as $category): ?>

                            <option <?= $row["cat_id"] == $category["id"] ? 'selected':'';  ?> value="<?= $category['id']; ?>"><?= $category['name']; ?></option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title"  id="title" class="form-control" value="<?= $row['title']; ?>" onkeyup="string_to_slug(this.value)">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="slug" name="slug"  id="slug" class="form-control" value="<?= $row['slug']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image"  id="image" class="form-control">
                        <img style='width: 80px;' src="../images/post/<?= $row['image']; ?>" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content2" class="form-control"><?= $row['content']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?= $row['status'] == 'active' ? 'checked':''; ?> id="active" value="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" <?= $row['status'] == 'inactive' ? 'checked':''; ?> id="inactive" value="inactive">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Update post</button>
                </form>
            </div>
        </div>
    </div>
</div>