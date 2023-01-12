<?php

if(isset($_GET["edit"])){
    
    $id = $_GET["edit"];

    $result = mysqli_query($con, "SELECT * FROM `categories` WHERE `id` = '$id' ");
    $row = mysqli_fetch_assoc($result);
    
}

if(isset($_POST["save"])){
    
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $status = $_POST["status"];

    $create = $_SESSION["u_id"];

    $result = mysqli_query($con, "UPDATE `categories` SET `name`='$name',`slug`='$slug',`status`='$status',`create_by`='$create' WHERE `id` = '$id' ");
    
    if($result){
        $success = "Data insert success!";
        header("location: index.php?page=manage-category");
    }

}

?>

<div class="row justify-content-md-center">
    <div class="col-md-6">

        <?php
        
        if(isset($success)){
            echo "<div class='alert alert-info'>".$success."</div>";
        }
        
        ?>

        <div class="card">
            <div class="card-header">
                <h3>Edit category form</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name"  id="name" class="form-control" value="<?= $row['name']; ?>" onkeyup="string_to_slug(this.value)">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="slug" name="slug"  id="slug" class="form-control" value="<?= $row['slug']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active" <?= $row['status'] == 'active' ? 'checked':''; ?> value="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive" <?= $row['status'] == 'inactive' ? 'checked':''; ?> value="inactive">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Update category</button>
                </form>
            </div>
        </div>
    </div>
</div>