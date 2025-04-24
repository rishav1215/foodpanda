<?php

include_once "../config/dbconnect.php";
checkifNotLogin(); //this line protect admin page

$countDishes = countData("select * from dishes");
$countOrders = countData("select * from orders");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminpanel|foodpanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <?php include_once "includes/admin_header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-3">
               <?php include_once"includes/sidebar.php";?>
            </div>
            <div class="col-9 p-5">
                <h1>Welcom Food panda Admin Paner </h1>
                <p>Here we can manage all food & Order</p>
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h1><?= $countDishes;?></h1>
                                <h4>Manage Dishes</h4>
                                <a href="" class="btn btn-primary">View</a>
                                <a href="" class="btn btn-success">insert</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h1><?=$countOrders;?></h1>
                                <h4>Manage Orders</h4>
                                <a href="" class="btn btn-primary">View</a>
                                <a href="" class="btn btn-success">insert</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

</body>

</html>