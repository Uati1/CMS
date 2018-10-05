<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

				<?php

					$per_page = 3;

					if(isset($_GET['page'])){
						$page = $_GET['page'];
					}else{
						$page = 1;
					}
					
					if($page == 0 || $page == 1){
						$page_1 = 0;
					}else{
						$page_1 = ( $page * $per_page) - $per_page;
					}
					$count_query = "SELECT * FROM posts WHERE post_status = 'published' ";
					$find_posts = mysqli_query($connection, $count_query);
					$num = mysqli_num_rows($find_posts);
					$count = ceil($num / $per_page);

					$query1 = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,{$per_page} ";
					$select_posts= mysqli_query($connection, $query1);

						while($row = mysqli_fetch_assoc($select_posts)){
							$post_id= $row['post_id'];
							$post_title= $row['post_title'];
							$post_author= $row['post_author'];
							$post_date= $row['post_date'];
							$post_img= $row['post_img'];
							$post_content= substr($row['post_content'], 0, 100);

							?>
							<h1 class="page-header">
								Page heading
								<small>Nice to see you</small>
							</h1>
							<h2>
								<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
							</h2>
							<p class="lead">
								by <a href="post_author.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
							<hr>
							<a href="post.php?p_id=<?php echo $post_id; ?>">
							<img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
							</a>
							<hr>
							<p><?php echo $post_content; ?></p>
							<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

				<?php	} ?>

                
            </div><!-- /.col-md-8 -->

            <?php include('inc/sidebar.php'); ?>

        </div><!-- /.row -->

        <hr>

		<ul class="pager">
			<?php

			for( $j =1; $j <= $count; $j++){
				if($j == $page){
					echo "<li ><a class= 'active' href='index.php?page={$j}' >{$j}</a></li>";
				}else{
					echo "<li><a href='index.php?page={$j}'>{$j}</a></li>";
				}
			}

			?>

		</ul>

<?php include("inc/footer.php"); ?>
