<?php 

require_once "header.php"; 

if(isset($_GET["page"])){
    
    $slug = $_GET["page"];

    $posts = mysqli_query($con, "SELECT * FROM `posts` WHERE `slug` = '$slug' ");

    $row = mysqli_fetch_assoc($posts);

    
}


?>

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $row['title']; ?></h1>
                            <!-- Post meta content-->

                            <?php
                            
                            $user_id = $row["user_id"];
                            $user_info = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$user_id' ");
                            $user_row = mysqli_fetch_assoc($user_info);

                            $cat_id = $row["cat_id"];
                            $cat_info = mysqli_query($con, "SELECT * FROM `categories` WHERE `id` = '$cat_id' ");
                            $cat_row = mysqli_fetch_assoc($cat_info);
                            
                            ?>

                            <div class="text-muted fst-italic mb-2">Posted on <?= date('M d, Y', strtotime($row['created_at'])); ?> by <?= $user_row['name']; ?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= $cat_row['name']; ?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="images/post/<?= $row['image']; ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <?= $row['content']; ?>
                        </section>
                    </article>
                </div>
                <!-- Side widgets-->

                <?php require_once "side-bar.php"; ?>

            </div>
        </div>
        <!-- Footer-->

<?php require_once "footer.php"; ?>