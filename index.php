<?php 

require_once "header.php"; 

$total_row = mysqli_query($con, "SELECT * FROM `posts` WHERE `status` = 'active' ORDER BY id DESC ");

$total_data = mysqli_num_rows($total_row);
$par_page = 5;
$total_page = ceil($total_data/$par_page);

if(isset($_GET["page"])){
    $page_no = $_GET["page"];
}else{
    $page_no = 1;
}

$limit = ($page_no - 1) * $par_page;

$posts = mysqli_query($con, "SELECT * FROM `posts` WHERE `status` = 'active' ORDER BY id ASC LIMIT $limit,$par_page");


?>
        <!-- Page content-->
        <div class="container mt-4">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">

                    <?php
                    
                    if(mysqli_num_rows($posts) == 0){
                        echo "<h1 class='text-center text-danger'>Post not found!</h1>";
                    }
                    
                    ?>

                    <?php foreach($posts as $row): 
                        
                    $user_id = $row["user_id"];
                    $user_info = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '$user_id' ");
                    $user_row = mysqli_fetch_assoc($user_info);
                        
                    ?>

                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="post.php?page=<?= $row['slug']; ?>" class="text-decoration-none text-dark"><img class="card-img-top" src="images/post/<?= $row['image']; ?>" alt="..." />
                            <div class="card-body" style="padding-bottom: 0px !important;">
                                <div class="small text-muted">Posted on <?= date("M d,Y", strtotime($row["created_at"])); ?> by <?= $user_row["name"]; ?></div>
                                <h2 class="card-title"><?= $row["title"]; ?></h2>
                                <p class="card-text"><?= substr($row["content"], 0,200); ?></p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-0">
                            <a class="btn btn-primary" href="post.php?page=<?= $row['slug']; ?>">Read more →</a>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>

                <!-- Side widgets-->
                <?php require_once "side-bar.php"; ?>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>

                        <?php for($page = 1; $page <= $total_page; $page++): ?>

                        <li class="page-item"><a class="page-link" href="index.php?page=<?= $page; ?>"><?= $page; ?></a></li>

                        <?php endfor; ?>

                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
<?php require_once "footer.php"; ?>