<?php include "inc/header.php" ?>

<?php

	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];

		$query = "SELECT * FROM users WHERE username = '{$username}' ";

		$profile_query = mysqli_query($connection, $query);

		while($row = mysqli_fetch_array($profile_query)){
			$id= $row['us_id'];
			$username= $row['username'];
			$pass= $row['us_pass'];
			$firstname= $row['us_firstname'];
			$lastname= $row['us_lastname'];
			$email= $row['us_email'];
			$img= $row['us_img'];
			$role= $row['us_role'];
		}

		if(isset($_POST['edit_user'])){
		
		$img = $escape(_FILES['img']['name']);
		$img_temp = escape($_FILES['img']['tmp_name']);
		$username= escape($_POST['username']);
		$pass= escape($_POST['pass']);
		$firstname= escape($_POST['firstname']);
		$lastname= escape($_POST['lastname']);
		$email= escape($_POST['email']);
		$role= escape($_POST['role']);

		move_uploaded_file($img_temp, "../img/$img");

		$query = "UPDATE users SET ";
		$query .= "us_pass = '{$pass}', ";
		$query .= "us_firstname = '{$firstname}', ";
		$query .= "us_img = '{$img}', ";
		$query .= "us_lastname = '{$lastname}', ";
		$query .= "us_email = '{$email}', ";
		$query .= "us_role = '{$role}' ";
		$query .= "WHERE username = '{$username}'";

		$user_update_query = mysqli_query($connection, $query);

		check($user_update_query);

	}

	}

?>
    <div id="wrapper">

        <?php include"inc/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
						<h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

						<form action="" method="post" enctype="multipart/form-data">    
     
     
							  <div class="form-group">
								 <label for="title">Firstname</label>
								 <input  type="text" class="form-control" name="firstname" value= "<?php echo $firstname; ?>">
							  </div>

							  <div class="form-group">
								<label for="author">Lastname</label>
								<input  type="text" class="form-control" name="lastname" value= "<?php echo $lastname; ?>">
							  </div>

							  <div class="form-group">
								 <label for="status">Username</label>
								  <input  type="text" class="form-control" name="username" value= "<?php echo $username; ?>">
							  </div>

							  <div class="form-group">
								 <label for="tags">Password</label>
								  <input  type="password" class="form-control" name="pass" value= "<?php echo $pass; ?>">
							  </div>
	  
							  <div class="form-group">
								 <label for="tags">Email</label>
								  <input  type="text" class="form-control" name="email" value= "<?php echo $email; ?>">
							  </div>

							  <div class="form-group">
								 <label for="tags">Role</label>
								  <select name= "role" id=""  class="form-control">
									<?php
										if($role == 'admin'){
											echo '<option value="admin">'. $role .'</option>';
											echo '<option value="user">user</option>';
										}else{
											echo '<option value="user">'. $role .'</option>';
											echo '<option value="admin">admin</option>';
										}
									 ?>
								  </select>
							  </div>

							<div class="form-group">
								<label for="img">Avatar</label>
							   <img width="100" src="../img/<?php echo $img ?>" alt=""> 
							   <input  type="file" name="img">
							</div>

							<div class="form-group">
								 <input class="btn btn-primary" type="submit" name="edit_user" value="Update profile">
							 </div>

						</form>
						

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"inc/footer.php" ?>
