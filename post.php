<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

				<?php

					if(isset($_GET['p_id'])){
						$p_id = $_GET['p_id'];

						$views_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = '{$p_id}' " ;
						$update_views= mysqli_query($connection, $views_query);

						$query= "SELECT * FROM posts WHERE post_id = $p_id ";
						$one_posts= mysqli_query($connection, $query);

						while($row= mysqli_fetch_assoc($one_posts)){
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
								<a href="#"><?php echo $post_title; ?></a>
							</h2>
							<p class="lead">
								by <a href="index.php"><?php echo $post_author; ?></a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
							<hr>
							<img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
							<hr>
							<p><?php echo $post_content; ?></p>
							
				<?php	}
				
					}else{
					
						header("Location: index.php");

					}
				 ?>

                <?php include "inc/comments.php"; ?>

            </div><!-- /.col-md-8 -->

            <?php include('inc/sidebar.php'); ?>

        </div><!-- /.row -->

        <hr>
<?php include("inc/footer.php"); ?>
