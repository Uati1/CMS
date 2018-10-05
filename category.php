<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

				<?php

					if(isset($_GET['category'])){
						$cat_id = escape($_GET['category']);
					}

					$query= "SELECT * FROM posts WHERE post_cat_id = $cat_id";
					$select_posts= mysqli_query($connection, $query);

						while($row= mysqli_fetch_assoc($select_posts)){
							$post_id= $row['post_id'];
							$post_title= $row['post_title'];
							$post_author= $row['post_author'];
							$post_date= $row['post_date'];
							$post_img= $row['post_img'];
							$post_content= $row['post_content'];

							?>
							<h1 class="page-header">
								Page Heading
								<small>Secondary Text</small>
							</h1>
							<h2>
								<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
							</h2>
							<p class="lead">
								by <a href="index.php"><?php echo $post_author; ?></a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
							<hr>
							<a href="post.php?p_id=<?php echo $post_id; ?>">
							<img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
							</a>
							<hr>
							<p><?php echo $post_content; ?></p>
							<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

				<?php	} ?>

                
            </div><!-- /.col-md-8 -->

            <?php include('inc/sidebar.php'); ?>

        </div><!-- /.row -->

        <hr>
<?php include("inc/footer.php"); ?>
