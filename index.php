<?php

    include('function.php');

    $objCrudAdmin = new crudApp();

    if (isset($_POST['add_info'])) {
        $returnMsg = $objCrudAdmin->addData($_POST);
    }

    $students = $objCrudAdmin->displayData();

    if (isset($_GET['status'])) {
        if ($_GET['status'] = 'delete') {
            $delete_id = $_GET['id'];
            $deleteMsg = $objCrudAdmin->deleteData($delete_id);

            header("location: index.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CRUD | APP</title>

    <style>
        th{
            text-align:center;
        }
        td{
            line-height: 100px;
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="text-decoration-none" href="index.php">Student Database</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        <?php if (isset($returnMsg)) {
            echo $returnMsg;
        } ?>
            <input class="form-control mb-2" type="hidden" name="u_id" id="" value="<?php echo $returnData['std_id'] ?>">
            <input class="form-control mb-2" type="text" name="std_name" id="" placeholder="enter your name">
            <input class="form-control mb-2" type="number" name="std_roll" id="" placeholder="enter your roll">
            <label for="image">Upload Your Image</label>
            <input class="form-control mb-2" type="file" name="std_image" id="">
            <input class="form-control bg-warning" type="submit" value="Add Information" name="add_info">
        </form>
    </div>

    <div class="container my-4 p-4 shadow">
        <?php if (isset($deleteMsg)) {
            echo $deleteMsg;
        } ?>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody >
                <?php while($row = mysqli_fetch_assoc($students)) { ?>
                <tr style="height:100px;">
                    <td><?php echo $row['std_id'];?></td>
                    <td><?php echo $row['std_name'];?></td>
                    <td><?php echo $row['std_roll'];?></td>
                    <td><img src="upload_img/<?php echo $row['std_image'];?>" alt="" height="100px"></td>
                    <td>
                        <a class="btn btn-success" href="edit.php?status=edit&&id=<?php echo $row['std_id'];?>">Edit</a>
                        <a class="btn btn-danger" href="?status=delete&&id=<?php echo $row['std_id'];?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>