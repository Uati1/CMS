<?php
	
	if(isset($_GET['p_id'])){
		$p_id = escape($_GET['p_id']);
	}

	$query= "SELECT * FROM posts WHERE post_id = $p_id ";
	$select_posts_edit = mysqli_query($connection, $query);

	while($row= mysqli_fetch_assoc($select_posts_edit)){
		$id= $row['post_id'];
		$cat= $row['post_cat_id'];
		$title= $row['post_title'];
		$author= $row['post_author'];
		$date= $row['post_date'];
		$img= $row['post_img'];
		$tags= $row['post_tags'];
		$content= $row['post_content'];
		$com= $row['post_com_count'];
		$status= $row['post_status'];

	}

	if(isset($_POST['update_post'])){
		
		$cat = escape($_POST['post_category']);
		$title = escape($_POST['title']);
		$author = escape($_POST['author']);

		$img = escape($_FILES['img']['name']);
		$img_temp = escape($_FILES['img']['tmp_name']);

		$tags = escape($_POST['tags']);
		$status = escape($_POST['status']);
		$content = escape($_POST['content']);

		move_uploaded_file($img_temp, "../img/$img");

		if(empty($img)){
			$query = "SELECT * FROM posts WHERE post_id = $p_id";
			$select_image = mysqli_query($connection, $query);

			while($row= mysqli_fetch_assoc($select_image)){
				$img= $row['post_img'];
			}
		}

		$query = "UPDATE posts SET ";
		$query .= "post_cat_id = '{$cat}', ";
		$query .= "post_title = '{$title}', ";
		$query .= "post_author = '{$author}', ";
		$query .= "post_date = now(), ";
		$query .= "post_img = '{$img}', ";
		$query .= "post_content = '{$content}', ";
		$query .= "post_tags = '{$tags}', ";
		$query .= "post_status = '{$status}' ";
		$query .= "WHERE post_id = {$p_id}";

		$post_update_query = mysqli_query($connection, $query);

		check($post_update_query);

		echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$id}'>View post</a> or <a href='../admin/posts.php'>Edit other posts</a></p>";
	}


?>




<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
         <input value="<?php echo $title; ?>"  type="text" class="form-control" name="title">
      </div>

      <div class="form-group">
		<label for="categories">Post Categories Id</label>
		<select name="post_category" id="post_category" class="form-control">
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
		<input value="<?php echo $author; ?>"  type="text" class="form-control" name="author">
      </div>

	  <div class="form-group">
         <label for="status">Post Status</label>
		 <select name = "status" class="form-control" id="p_status">
			<option value= "<?php echo $status; ?>"><?php echo $status; ?></option>
			<?php

				if($status == 'published' ){
					echo "<option value= 'draft'>Draft</option>";
				}else{
					echo "<option value= 'published'>published</option>";
				}

			?>
		 </select>
      </div>

      
    <div class="form-group">
		<label for="img">Post Image</label><br>
		<img width="100" src="../img/<?php echo $img; ?>" alt=""> 
		<input  type="file" name="img">
	</div>

      <div class="form-group">
         <label for="tags">Post Tags</label>
          <input value="<?php echo $tags; ?>"  type="text" class="form-control" name="tags">
      </div>
      
      <div class="form-group">
         <label for="content">Post Content</label>
         <textarea  class="form-control "name="content" id="body" cols="30" rows="10"><?php echo $content; ?>
		 </textarea>
      </div>

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
      </div>


</form>