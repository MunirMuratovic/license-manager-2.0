<?php

include 'db.php';

// pagination
$page = (isset($_GET['page']) ? (int) $_GET['page'] : 1); // casting to int is simple validation here
$perPage = (isset($_GET['per-page']) && (int) $_GET['per-page'] <= 50 ? $_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
// pagination end 

$sql = "SELECT * FROM licenses LIMIT " . $start . " , " . $perPage . "";
$total = $db->query("SELECT * FROM licenses")->num_rows;
$pages = ceil($total / $perPage); // ceil rounds to nearest int

$rows = $db->query($sql);

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
        <div class="row">
            <h1 class="mb-4 my-4">License manager</h1>
        </div>

        <div class="row my-2">
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add License</button>
            <button type="button" class="btn btn-sm btn-info ml-auto" onclick="print()">Print</button>
        </div>

        <div class="col-md-12 px-0 mx-0 text-center">
            <form action="search.php" class="form-group" method="POST">
                <input type="text" class="form-control" placeholder="Search data" name="search">
            </form>
        </div>

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th style="width: 45%" scope="col">License Name</th>
                        <th scope="col">License Type</th>
                        <th scope="col">Period</th>
                        <th scope="col">Creator</th>
                        <th style="width: 20%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $rows->fetch_assoc()) : ?>
                        <tr>
                            <th scope="row"><?php echo $row['id'] ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><?php echo $row['period'] ?></td>
                            <td><?php echo $row['creator'] ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Update</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="mx-auto">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

<!-- Modal Add License -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add License</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="create.php">
                    <div class="form-group">
                        <label for="">License Name</label>
                        <input type="text" name="name" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" name="type" id="select-type">
                            <option value="monthly">monthly</option>
                            <option value="yearly">yearly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Period in Days</label>
                        <input type="text" name="period" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="">Creator</label>
                        <input type="text" name="creator" class="form-control required">
                    </div>
                    <input type="submit" name="send" value="Add License" class="btn btn-success">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>