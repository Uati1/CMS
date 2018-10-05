<?php 

	if(isset($_POST['add_post'])){
		$cat = $_POST['post_category'];
		$title = $_POST['title'];
		$author = $_POST['author'];

		$img = $_FILES['img']['name'];
		$img_temp = $_FILES['img']['tmp_name'];

		$tags = $_POST['tags'];
		$status = $_POST['status'];
		$content = $_POST['content'];
		$date = date('d-m-y');


		move_uploaded_file($img_temp, "../img/$img");

		$query = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status)";
		$query .= "Values('{$cat}','{$title}','{$author}',now(),'{$img}','{$content}','{$tags}', '{$status}')";

		$post_query = mysqli_query($connection, $query);

		check($query);

		$id = mysqli_insert_id($connection);

		echo "<p class='bg-success'>Post Added. <a href='../post.php?p_id={$id}'>View post</a> or <a href='../admin/posts.php'>Edit other posts</a></p>";
	}

?>



<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
         <input  type="text" class="form-control" name="title">
      </div>

      <div class="form-group">
		<label for="categories">Post Categories Id</label>
		<select name="post_category" id="post_category">
			<?php
				
				$query= "SELECT * FROM category ";
				$select_categories = mysqli_query($connection, $query);

				check($select_categories);

				while($row= mysqli_fetch_assoc($select_categories)){
					$cat_id= $row['cat_id'];
					$catt= $row['cat_title'];

					echo "<option value='{$cat_id}'>{$catt}</option>";
					
				}

			?>
		</select>
      </div>

      <div class="form-group">
		<label for="author">Post Author</label>
		<input  type="text" class="form-control" name="author">
      </div>

	  <div class="form-group">
         <label for="status">Post Status</label>
         <select name = "status" class="form-control" id="p_status">
			<option value= "deaft">draft</option>
			<option value= 'published'>published</option>
		 </select>
      </div>

      
    <div class="form-group">
		<label for="img">Post Image</label>
       <?php //<img width="100" src="../images/" alt=""> ?>
       <input  type="file" name="img">

    </div>

      <div class="form-group">
         <label for="tags">Post Tags</label>
          <input  type="text" class="form-control" name="tags">
      </div>
      
      <div class="form-group">
         <label for="content">Post Content</label>
         <textarea  class="form-control "name="content" id="body" cols="30" rows="10"></textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="add_post" value="Add Post">
      </div>


</form>