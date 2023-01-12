<?php

if(isset($_GET["delete"])){
    
    $id = $_GET["delete"];
    
    $result = mysqli_query($con, "DELETE FROM `categories` WHERE `id` = '$id' ");
    
    if($result){
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?page=manage-category";
            </script>
        <?php
    }

}


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Create By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    $result = mysqli_query($con, "SELECT * FROM `categories` ");

                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?= $row["name"]; ?></td>
                            <td><?= $row["slug"]; ?></td>
                            <td><span class="text-<?= getStatusColor($row['status']); ?>"><?= getStatus($row["status"]); ?></span></td>
                            <td>
                            
                            <?php
                            
                            $create_by = $row["create_by"];
                            $user_info = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$create_by' ");
                            $user_row = mysqli_fetch_assoc($user_info);
                            echo $user_row["name"];
                            
                            ?>

                            </td>
                            <td>
                                <a href="?page=manage-category&&delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                <a href="?page=edit-category&&edit=<?= $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
