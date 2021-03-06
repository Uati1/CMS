<?php include "inc/header.php" ?>
    <div id="wrapper">

        <?php include"inc/nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

			<div class="row">
                    <div class="col-lg-12">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Comment</th>
			<th>Email</th>
			<th>Status</th>
			<th>In response to</th>
			<th>Date</th>
			<th>Approve</th>
			<th>Disapprove</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php

			$query= "SELECT * FROM comments WHERE com_post_id =".escape($_GET['id']) ." ";
			$select_comments = mysqli_query($connection, $query);
			echo $com_count = mysqli_num_rows($select_comments);

			while($row= mysqli_fetch_assoc($select_comments)){
				$id= $row['com_id'];
				$post_id= $row['com_post_id'];
				$author= $row['com_author'];
				$email= $row['com_email'];
				$date= $row['com_date'];
				$content= $row['com_content'];
				$status= $row['com_status'];
										
				echo "<tr>";
					
					echo "<td>{$post_id}</td>";
					echo "<td>{$author}</td>";

					//$query= "SELECT * FROM category WHERE cat_id = {$cat} ";
					//$select_category = mysqli_query($connection, $query);

					//while($row= mysqli_fetch_assoc($select_category)){
					//	$catt= $row['cat_title'];
					//	echo "<td>{$catt}</td>";
					//}

					echo "<td>{$content}</td>";
					echo "<td>{$email}</td>";
					echo "<td>{$status}</td>";

					$query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
					$get_title = mysqli_query($connection, $query);
					while($row= mysqli_fetch_assoc($get_title)){
						$post_id = $row['post_id'];
						$title = $row['post_title'];
					}


					echo "<td><a href='../post.php?p_id=$post_id'>{$title}</a></td>";
					echo "<td>{$date}</td>";
					echo "<td><a href='comments.php?approve=$id'>Approve</a></td>";
					echo "<td><a href='comments.php?disapprove=$id'>Disapprove</a></td>";
					echo "<td><a href='post_comments.php?delete=$id&id=".$_GET['id']."'>delete</a></td>";
				echo "</tr>";
			}

		?>
	</tbody>
</table>

<?php if(isset($_GET['delete'])&& $_SESSION['user_role'] == 'admin'){

	$com_id = escape($_GET['delete']);

	$query = "DELETE FROM comments WHERE com_id = {$com_id} ";
	$delete_com_query = mysqli_query($connection, $query);

	check($delete_com_query);
	if($com_count-1 == 0){
		header("Location: comments.php");
	}else{
		header("Location: post_comments.php?id=".$_GET['id']."");
	}
	

}
?>
<?php if(isset($_GET['approve'])||isset($_GET['disapprove'])){
	
	if(isset($_GET['approve'])){
		$com_id = $_GET['approve'];
		$query = "UPDATE comments SET com_status = 'approved' WHERE com_id = {$com_id} ";
	}
	if(isset($_GET['disapprove'])){
		$com_id = $_GET['disapprove'];
		$query = "UPDATE comments SET com_status = 'disapproved' WHERE com_id = {$com_id} ";
	}

	$approve_com_query = mysqli_query($connection, $query);

	check($approve_com_query);
	header("Location: comments.php");

}
?>
					</div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"inc/footer.php" ?>