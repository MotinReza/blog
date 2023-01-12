                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <form action="search.php">
                            <div class="card-body">
                                <div class="input-group">
                                    <input class="form-control" name="search" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">

                            <?php
                            
                            $result = mysqli_query($con, "SELECT * FROM `categories` ");
                            
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="category.php?category=<?= $row['slug']; ?>"><?= $row["name"]; ?></a></li>
                                    </ul>
                                </div>
                                <?php
                            }
                            
                            ?>

                            </div>
                        </div>
                    </div>
                </div>