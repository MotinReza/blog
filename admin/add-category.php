<?php

if(isset($_POST["save"])){
    
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $status = isset($_POST["status"]) ? $_POST["status"]:'' ;

    $create = $_SESSION["u_id"];

    $error = [];

    if(empty($name)){
        $error["name"] = "Name field is required!";
    }
    if(empty($slug)){
        $error["slug"] = "Slug field is required!";
    }
    if(empty($status)){
        $error["status"] = "Status field is required!";
    }

    if(empty($error)){

        $check_name = mysqli_query($con, "SELECT * FROM `categories` WHERE `name` = '$name' ");

        if(mysqli_num_rows($check_name) == 0){
            
            $result = mysqli_query($con, "INSERT INTO `categories`(`name`, `slug`, `status`, `create_by`) VALUES ('$name','$slug','$status','$create') ");
    
            if($result){
                $_SESSION["success"] = "Data insert success!";
            }else{
                $_SESSION["error"] = "Data not save!";
            }
            
        }else{
            $name_exists = "This name or slug already exists!";
        }
    }
}

?>

<div class="row justify-content-md-center">
    <div class="col-md-6">

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
                <h3>Add category form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name"  id="name" class="form-control" value="<?= isset($name) ? $name:''; ?>" onkeyup="string_to_slug(this.value)">
                        <span class="text-danger"><?php if(isset($error["name"])){ echo $error["name"]; } ?></span>
                        <span class="text-danger"><?php if(isset($name_exists)){ echo $name_exists; } ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="slug" name="slug"  id="slug" class="form-control" value="<?= isset($slug) ? $slug:''; ?>">
                        <span class="text-danger"><?php if(isset($error["slug"])){ echo $error["slug"]; } ?></span>
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
                    <button type="submit" name="save" class="btn btn-primary">Add category</button>
                </form>
            </div>
        </div>
    </div>
</div>