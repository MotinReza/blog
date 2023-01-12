<?php

$categories = mysqli_query($con, "SELECT * FROM `categories` WHERE `status` = 'active' ");

if(isset($_POST["save"])){
    
    $cat_id = $_POST["cat_id"];
    $title = $_POST["title"];
    $slug = $_POST["slug"];
    $content = $_POST["content"];
    $status = isset($_POST["status"]) ? $_POST["status"]:'';

    $user_id = $_SESSION["u_id"];

    $file_exp = explode('.', $_FILES["image"]["name"]);
    $file_end = end($file_exp);
    $file_name = date("ymdhis.").$file_end;


    $error = [];

    if(empty($cat_id)){
        $error["cat_id"] = "Category name field is required!";
    }
    if(empty($title)){
        $error["title"] = "Title field is required!";
    }
    if(empty($slug)){
        $error["slug"] = "Slug field is required!";
    }
    if(empty($content)){
        $error["content"] = "Content field is required!";
    }
    if(empty($status)){
        $error["status"] = "Status field is required!";
    }
    if(empty($_FILES["image"]["name"])){
        $error["file_name"] = "Image field is required!";
    }

    if(empty($error)){
        
        $result = mysqli_query($con, "INSERT INTO `posts`(`cat_id`, `title`, `slug`, `content`, `image`, `status`, `user_id`) VALUES ('$cat_id','$title','$slug','$content','$file_name','$status','$user_id') ");
    
        if($result){
            move_uploaded_file($_FILES["image"]["tmp_name"], "../images/post/".$file_name);
            $_SESSION["success"] = "Data insert success!";
            header("location: index.php?page=add-post");
        }else{
            $_SESSION["error"] = "Data not save!";
    
        }
        
    }



}

?>

<div class="row justify-content-md-center">
    <div class="col-md-8">

        <?php
        
        if(isset($_SESSION["success"])){
            echo "<div class='alert alert-info'>".$_SESSION["success"]."</div>";
            unset($_SESSION["success"]);
        }

        if(isset($_SESSION["error"])){
            echo "<div class='alert alert-danger'>".$_SESSION["error"]."</div>";
            unset($_SESSION["error"]);
        }
        
        ?>

        <div class="card">
            <div class="card-header">
                <h3>Add post form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="cat_id" class="form-label">Category:</label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">Select</option>

                            <?php foreach($categories as $category): ?>

                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>

                            <?php endforeach; ?>

                        </select>
                        <span class="text-danger"><?php if(isset($error["cat_id"])){ echo $error["cat_id"]; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title"  id="title" class="form-control" value="<?= isset($title) ? $title:''; ?>" onkeyup="string_to_slug(this.value)">
                        <span class="text-danger"><?php if(isset($error["title"])){ echo $error["title"]; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="slug" name="slug"  id="slug" class="form-control" value="<?= isset($slug) ? $slug:''; ?>">
                        <span class="text-danger"><?php if(isset($error["slug"])){ echo $error["slug"]; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <span class="text-danger"><?php if(isset($error["file_name"])){ echo $error["file_name"]; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content2" class="form-control"></textarea>
                        <span class="text-danger"><?php if(isset($error["content"])){ echo $error["content"]; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                        <span class="text-danger"><?php if(isset($error["status"])){ echo $error["status"]; } ?></span>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Add post</button>
                </form>
            </div>
        </div>
    </div>
</div>