<!-- Blog Comments -->

				<?php

					if(isset($_POST['create_com'])){

						$p_id = $_GET['p_id'];
						$author = $_POST['com_author'];
						$email = $_POST['com_email'];
						$content = $_POST['com_content'];

						if(!empty($author)&&!empty($email)&&!empty($content)){
							$query = "INSERT INTO comments (com_post_id, com_author, com_email, com_content, com_status, com_date) ";
							$query .= "VALUES ({$p_id}, '{$author}', '{$email}', '{$content}','disapproved', now())";
							$add_com_query = mysqli_query($connection, $query);

							$query = "UPDATE posts SET post_com_count = post_com_count + 1 WHERE post_id = $p_id";
							$increment_query = mysqli_query($connection, $query);
						}else{
							echo "<script>alert('Fields cannot be empty');</script>";
						}

					}

				?>
				
			
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
						<div class="form-group">
							<label for"com_author">Author</label>
                            <input class="form-control" type="text" name="com_author">
                        </div>
						<div class="form-group">
							<label for"com_email">Email</label>
                            <input class="form-control" type="email" name="com_email">
                        </div>
                        <div class="form-group">
							<label for"com">Your Comment</label>
                            <textarea class="form-control" rows="3" name="com_content"></textarea>
                        </div>
                        <button type="submit" name="create_com" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
				<?php

					if(isset($_GET['p_id'])){
						
						$id = $_GET['p_id'];
						$query = "SELECT * FROM comments WHERE com_post_id = $id ";
						$query .= "AND com_status = 'approved' ";
						$query .= "ORDER BY com_id DESC ";
						$show_post_comments = mysqli_query($connection, $query);
						while($row= mysqli_fetch_assoc($show_post_comments)){
							$author= $row['com_author'];
							$email= $row['com_email'];
							$date= $row['com_date'];
							$content= $row['com_content'];
						?>
							<div class="media">
								<a class="pull-left" href="#">
									<img class="media-object" src="http://placehold.it/64x64" alt="">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><?php echo $author; ?>
										<small><?php echo $date; ?></small>
									</h4>
									<p><?php echo $content; ?></p>
								</div>
							</div>
						<?php }
					}
				?>