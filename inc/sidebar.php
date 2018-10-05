<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
					<form action="search.php" method="post">
						<div class="input-group">
							<input name="search" type="text" class="form-control">
							<span class="input-group-btn">
								<button name="submit" class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div><!-- /.input-group -->
					</form>
                </div><!-- /.well -->
				
				<!-- Login -->
                <div class="well">
                    <h4>Login</h4>
					<form action="inc/login.php" method="post">
						<div class="form-group">
							<input name="username" type="text" class="form-control" placeholder= "Enter username">
						</div>
						<div class="input-group">
							<input name="password" type="password" class="form-control" placeholder= "Enter password">
							<span class="input-group-btn">
								<button class="btn btn-primary" name="login" type="submit">Submit</button>
							</span>
						</div><!-- /.input-group -->
					</form>
                </div><!-- /.well -->

                <!-- Blog Categories -->
                <div class="well">
				<?php
					$query= "SELECT * FROM category ";
					$select_cat_side= mysqli_query($connection, $query);
				?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
									while($row= mysqli_fetch_assoc($select_cat_side)){
										$catt= $row['cat_title'];
										$id= $row['cat_id'];

										echo "<li><a href='category.php?category=$id'>{$catt}</a></li>";
									}
								?>
                            </ul>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.well -->

                <!-- Side Widget Well -->
                <div class="well">
					<h4>Side Widget Well</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
					Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
				</div><!-- /.well -->

            </div>