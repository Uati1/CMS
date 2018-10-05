
<?php include("inc/data.php"); ?>
<?php include("inc/header.php"); ?>
<?php include("inc/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

				<?php

					if(isset($_POST['submit'])){
						$search = escape($_POST['search']);


						$query= "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
						$searchQuery= mysqli_query($connection, $query);

						check($searchQuery);
						$count = mysqli_num_rows($searchQuery);

						if($count == 0){
							echo "nothing";
						}else{

							$query= "SELECT * FROM posts";
							$select_posts= mysqli_query($connection, $query);

								while($row= mysqli_fetch_assoc($select_posts)){
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
									<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

					<?php		} 
						}

					}?>

                
            </div><!-- /.col-md-8 -->

            <?php include('inc/sidebar.php'); ?>

        </div><!-- /.row -->

        <hr>
<?php include("inc/footer.php"); ?>