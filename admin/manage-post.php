<?php

if(isset($_GET["delete"])){
    
    $id = $_GET["delete"];
    
    $result = mysqli_query($con, "DELETE FROM `posts` WHERE `id` = '$id' ");
    
    if($result){
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?page=manage-post";
            </script>
        <?php
    }

}


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Post</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Create By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    $result = mysqli_query($con, "SELECT * FROM `posts` ");

                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?= $row["title"]; ?></td>
                            <td><img style="width:80px;" src="../images/post/<?= $row["image"]; ?>" alt=""></td>
                            <td>

                            <?php
                            
                            $cat_id = $row["cat_id"];
                            $cat_info = mysqli_query($con, "SELECT * FROM `categories` WHERE `id` = '$cat_id' ");
                            $cat_row = mysqli_fetch_assoc($cat_info);
                            echo $cat_row["name"];
                            
                            ?>

                            </td>
                            <td><span class="text-<?= getStatusColor($row['status']); ?>"><?= getStatus($row["status"]); ?></span></td>
                            <td>
                            
                            <?php
                            
                            $user_id = $row["user_id"];
                            $user_info = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$user_id' ");
                            $user_row = mysqli_fetch_assoc($user_info);
                            echo $user_row["name"];
                            
                            ?>

                            </td>
                            <td>
                                <a href="?page=manage-post&&delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                <a href="?page=edit-post&&edit=<?= $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
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
