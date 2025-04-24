<?php
include_once "../config/dbconnect.php";
checkifNotLogin(); //this line protect admin page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage dishesAdminpanel|foodpanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <?php include_once "includes/admin_header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php include_once "includes/sidebar.php"; ?>
            </div>
            <div class="col-9 p-2 mt-3">
                <div class="row">
                    <div class="col">
                        <h2>Manage Dishes(<?= countData("select * from dishes");?>)</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Is veg</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $callingDish = mysqli_query($connect, "select * from dishes");
                                while ($row = mysqli_fetch_array($callingDish)):
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><img src='../images/<?= $row['image']; ?>' width="50px" height="auto" /></td>
                                        <td class="fw-bold"><?= $row['name']; ?></td>
                                        <td><?= $row['category']; ?></td>
                                        <td class="text-danger fw-bold"><?= $row['price']; ?></td>
                                        <td><img src='../images/<?= ($row['isveg']) ? "veg.jpeg" : "nonveg.jpeg"; ?>'
                                                width="40px" /></td>
                                        <td>
                                            <a href="?delete_dish=<?=$row['id'];?>" class="btn btn-danger btn-sm">X</a>
                                            <a href="" class="btn btn-info btn-sm">Edit</a>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3>Insert Dish</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['save'])) {
                                    $name = $_POST['name'];
                                    $category = $_POST['category'];
                                    $price = $_POST['price'];
                                    $isveg = $_POST['isveg'];
                                    $image = $_FILES['image']['name'];
                                    $tmp_image = $_FILES['image']['tmp_name'];

                                    move_uploaded_file($tmp_image, "../images/$image");


                                    $query = mysqli_query($connect, "insert into dishes (name,category,image,price,isveg) value
                                    ('$name','$category','$image','$price','$isveg')");

                                    if ($query) {
                                        redirect("manage_dishes.php");
                                    } else {
                                        msg("something went wrong", );
                                    }
                                }

                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="" class="fw-bold">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="fw-bold">Category</label>
                                        <input type="text" class="form-control" name="category">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="fw-bold">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="fw-bold">Price</label>
                                        <input type="text" class="form-control" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="fw-bold">Is veg</label>
                                        <input type="checkbox" class="form-checkbox" value="1" name="isveg">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" name="save" class="btn btn-success w-100">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_GET['delete_dish'])){
    $id = $_GET['delete_dish'];

    $query = mysqli_query($connect, "delete from dishes where id = '$id'");

    if ($query) {
        redirect("manage_dishes.php");

    } 
    else {
        msg("somthing went wrong", );

    }

}
?>