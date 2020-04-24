<?php
// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "12345678", "todo");

if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    }else{
        $task = $_POST['task'];
        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
        mysqli_query($db, $sql);
        header('location: index.php');
    }
}
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];

    mysqli_query($db, "DELETE FROM tasks WHERE id='$id'");
    header('location: index.php');
}
if (isset($_GET['done_task'])) {
    $id = $_GET['done_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id='$id'");
    header('location: index.php');
}?>
<!DOCTYPE html>
<html>
<head>
    <title>Todos, complete all jobs!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
<div class="container">
<div class="heading">
    <h1>!!!To do!!!</h1>
<form method="post" action="index.php" class="input_form">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
    <?php } ?>
    <input type="text" name="task" class="task_input">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
</form>
</div>
<table>
    <tbody>
    <?php
    $tasks = mysqli_query($db, "SELECT * FROM tasks");

    $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr id="do">
            <td> <?php echo $i; ?> </td>
            <td class="task"> <?php echo $row['task']; ?> </td>
            <td class="delete">
<!--                <button class="done" onclick="done();">Done</button>-->
                <a href="index.php?del_task=<?php echo $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>
</div>
</center>
</body>
</html>