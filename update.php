<?php

include 'db.php';

$id = (int) $_GET['id']; //cast to int is simple validation

$sql = "SELECT * FROM licenses WHERE id = '$id'";

$rows = $db->query($sql);
$row = $rows->fetch_assoc();

$type = $row['type']; // to define select-option get from db in frontend

if (isset($_POST['send'])) {

    $name = htmlspecialchars($_POST['name']); //htmlspecchars to prevent injection, as special validation
    $type = htmlspecialchars($_POST['type']);
    $period = htmlspecialchars($_POST['period']);
    $creator = htmlspecialchars($_POST['creator']);

    $sql = "UPDATE `licenses`
    SET `name` = '$name', `type` = '$type', `period` = '$period', `creator` = '$creator'
    WHERE `licenses`.`id` = '$id'";

    $db->query($sql);

    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>License Manager</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <h1 class="mb-4 my-4">Update license</h1>

            <a href="index.php" class="ml-auto btn btn-info">Back to Home page</a>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <form method="POST">
                    <div class="form-group">
                        <label for="">License Name</label>
                        <input type="text" value="<?php echo $row['name']; ?>" name="name" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" name="type" id="select-type">
                            <option value="monthly" <?php if ($type == "monthly") echo 'selected="selected"'; ?>>monthly</option>
                            <option value="yearly" <?php if ($type == "yearly") echo 'selected="selected"'; ?>>yearly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Period in Days</label>
                        <input type="text" name="period" value="<?php echo $row['period']; ?>" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="">Creator</label>
                        <input type="text" name="creator" value="<?php echo $row['creator']; ?>" class="form-control required">
                    </div>
                    <input type="submit" name="send" value="Update License" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>



</html>