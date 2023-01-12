

<?php 

require_once "header.php"; 

if(isset($_GET["search"])){

    $search = $_GET["search"];

    $category = mysqli_query($con, "SELECT * FROM `posts` WHERE `title` LIKE '%$search%'; ");

    ?>

        <!-- Page content-->
        <div class="container mt-4">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">

                    <?php
                    
                    if(mysqli_num_rows($category) == 0){
                        echo "<h1 class='text-center text-danger'>Post not found!</h1>";
                    }
                    
                    ?>

                    <?php foreach($category as $row): 
                        
                    $user_id = $row["user_id"];
                    $user_info = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$user_id' ");
                    $user_row = mysqli_fetch_assoc($user_info);
                        
                    ?>

                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="images/post/<?= $row['image']; ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">Posted on <?= date("M d,Y", strtotime($row["created_at"])); ?> by <?= $user_row["name"]; ?></div>
                            <h2 class="card-title"><?= $row["title"]; ?></h2>
                            <p class="card-text"><?= substr($row["content"], 0,200); ?></p>
                            <a class="btn btn-primary" href="post.php?page=<?= $row['slug']; ?>">Read more →</a>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>

                <!-- Side widgets-->
                <?php require_once "side-bar.php"; ?>

            </div>
        </div>

    <?php

}

?>



<?php require_once "footer.php"; ?>