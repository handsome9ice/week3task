<?php 

	$errors = "";

	
	$db = mysqli_connect("localhost", "root", "", "todo");

	if (isset($_POST['submit'])) {		
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}	

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo</title>
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Todo List</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="task" class="task_input" required/>
		<button type="submit" name="submit" id="add_btn" class="add_btn">Submit</button>
	</form>

    <table>
	<thead>
		<tr>
			<th style="width: 30px;">ID</th>
			<th>Tasks</th>
			<th style="width: 60px;">Delete</th>
            <th style="width: 60px;">Update</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td > <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
                <td class="edit"><a href="index.php?update_task=<?php echo $row['id'] ?>">Update data</a> </td>
			</tr>

		<?php $i++; } ?>	
	</tbody>
    </table>

    <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
    <?php } ?>
</body>
</html>