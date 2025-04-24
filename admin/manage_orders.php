<?php
include_once "../config/dbconnect.php";
checkifNotLogin(); //this line protect admin page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders|Adminpanel|foodpanda</title>
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
                        <h2>Manage Orders(<?= countData("select * from orders"); ?>)</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $callingOrders = mysqli_query($connect, "select * from orders ORDER BY id DESC");
                                while ($row = mysqli_fetch_array($callingOrders)):
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td class="fw-bold"><?= $row['name']; ?></td>
                                        <td><?= $row['contact']; ?></td>

                                        <td>
                                            <a href="" class="btn btn-info btn-sm">View</a>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>