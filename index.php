<?php 
// Pripojenie db
$db_server = "localhost";
$db_user = "juraj9910";
$db_password = "1234567899910razor";
$db_name = "todo";
 
$db = mysqli_connect($db_server, $db_user, $db_password, $db_name);

// Pridanie tasku + chyby
if(isset($_POST["submit"])) {
    $task = $_POST["task"];

    if(empty($_POST["task"])) {
        $errorMsg[] = "You must fill in the task";

    } else {
        mysqli_query($db, "INSERT INTO task(tasks) VALUES ('$task')");
        header("location: index.php");
    }
}

// Vymazanie tasku
if(isset($_GET["del_task"])) {
    $id = $_GET["del_task"];
    mysqli_query($db, "DELETE FROM task WHERE id=$id");
    header("location: index.php");
}

$tasks = mysqli_query($db, "SELECT * FROM task");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="heading">
        <h2>Todo list application with PHP and MySQL</h2>
    </div>
    <form action="index.php" method="POST">
        <?php 
        if(isset($errorMsg)) {
            foreach($errorMsg as $emptyTask){
                echo "<p class='p-error'>".$emptyTask."</p>";
            }
        }
        ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                <td><?php echo $i;?></td>
                <td class="task"><?php echo $row["tasks"];?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row["id"]; ?>">x</a>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</body>
</html>