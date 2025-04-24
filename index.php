<?php include_once "config/dbconnect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Card styling */
        .dish {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dish:hover {
            transform: translateY(-10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Image styling */
        .card-img-top {
            object-fit: cover;
            height: 60px;
        }

        /* Text styling */
        .card-body h6 {
            font-size: 1rem;
            color: #333;
            font-weight: bold;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .card-body p {
            margin-bottom: 5px;
            font-size: 0.875rem;
            color: #555;
        }

        .card-body p.text-primary {
            color: #007bff;
        }

        .card-body p.text-muted {
            color: #868e96;
        }

        /* Veg/Non-Veg Badge styling */
        .card-body img {
            border-radius: 50%;
            background-color: white;
            border: 2px solid white;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        }

        /* Link styling */
        .stretched-link {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-8 p-3 overflow-y-scroll" style="height:87vh">
                <div class="row ">
                    <div class="col-10 d-flex align-items-center">
                        <img src="panda.webp" width="7%" alt="">
                        <h2>FoodPanda</h2>


                    </div>
                    <div class="col-2">
                        <a href="login.php" class="btn btn-dark">Admin Login</a>
                    </div>
                </div>
                <div class="row d-flex flex-column gap-2">
                    <?php
                    // calling order and order item
                    $callingOrder = mysqli_query($connect, "select * from orders where status='0'");
                    $getorder = mysqli_fetch_assoc($callingOrder);
                    $count_order = mysqli_num_rows($callingOrder);
                    $total_amount = 0;
                    if($count_order):
                    //geting order items of this above order\
                    $order_id = $getorder['id'];
                    $callingOrderItem = mysqli_query($connect, "select * from orderItem JOIN dishes ON orderItem.
                    dish_id=dishes.id where order_id='$order_id'");
                  
                    while ($item = mysqli_fetch_array($callingOrderItem)):



                        ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-1">
                                    <div class="row align-items-center">
                                        <div class="col-1">
                                            <img src="images/<?= $item['image']; ?>" class="card-img-top" alt="">
                                        </div>
                                        <div class="col-6 d-flex align-items-start flex-column">
                                            <h2 class="h6 mb-0"><?= $item['name']; ?></h2>
                                            <p class="text-muted mb-0 small"><?= $item['category']; ?></p>

                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex flex-col text-secondary fw-bold ">
                                                Price: <?= $item['price']; ?>x<?= $item['qty']; ?>=
                                                ₹<?= $total = $item['price'] * $item['qty']; ?>/-

                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="col-12 d-flex gap-2 align-items-center">
                                                <a href="?minus_item=<?= $item['dish_id']; ?>"
                                                    class="btn btn-danger fw-bold">-</a>
                                                <span class="h3 mb-0"><?= $item['qty']; ?></span>
                                                <a href="?add_order=<?= $item['dish_id']; ?>"
                                                    class="btn btn-success fw-bold">+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $total_amount += $total;
                    endwhile; 
                else:
                    echo "<h1 class='text-muted mt-3'>Create Your Order Now</h1>";
                endif;
                    ?>


                </div>

            </div>
            <div class="col-4 overflow-y-scroll" style="height:87vh;">
                <div class="row">
                    <div class="col-12 mt-4">
                        <h2>Our dishes</h2>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $callingDish = mysqli_query($connect, "select * from dishes");
                    while ($row = mysqli_fetch_array($callingDish)):

                        ?>
                        <div class="col-4 mt-4">
                            <div class="card dish position-relative shadow-sm border-0 rounded">
                                <img src="images/<?= $row['image']; ?>" alt="" class="card-img-top rounded-top">
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="mb-1 fw-bold text-truncate" style="font-size: 1rem;"><?= $row['name']; ?>
                                    </h6>
                                    <p class="mb-1 small text-muted"><?= $row['category']; ?></p>
                                    <p class="mb-2 small text-danger fw-bold">Rs.<?= $row['price']; ?>/-</p>
                                    <img class="position-absolute top-0 end-0 rounded-circle shadow-lg"
                                        src='images/<?= ($row['isveg']) ? "veg.jpeg" : "nonveg.jpeg"; ?>' width="40px" />
                                    <a href="?add_order=<?= $row['id']; ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>

            </div>
        </div>
        <div class="row bg-light" style="height:13vh;">
            <form action="index.php" method="post" class="">
                <div class="col-12">
                    <div class="row d-flex align-items-center mt-2">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class=" fw-bolder">Costember Name</label>
                                <input type="text" name="name" placeholder="Enter your full Name " class="form-control">
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class=" fw-bolder">Costember Contect</label>
                                <input type="text" name="contact" placeholder="Enter your 10 dig. Contact no."
                                    class="form-control">
                            </div>

                        </div>

                        <div class="col-2">
                            <h4>Total Ammount</h4>
                            <h3 class="text-danger">₹<?= $total_amount; ?>/-</h3>

                        </div>
                        <div class="col-2 mt-3">
                            <div class="form-group">
                                <input type="submit" name="update_order" value="Place Order"
                                    class=" btn btn-warning btn-lg">
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php

if (isset($_GET['minus_item'])) {
    $dish_id = $_GET['minus_item'];

    $check_order = mysqli_query($connect, "select * from orders where status='0'");
    $count_order = mysqli_num_rows($check_order);
    if ($count_order) {
        $exist_order = mysqli_fetch_assoc($check_order);

        //check order itme table this dish exits or not
        $order_id = $exist_order['id'];
        $check_orderItem = mysqli_query($connect, "select * from orderItem where order_id='$order_id' and dish_id='$dish_id'");
        $count_orderItem = mysqli_num_rows($check_orderItem);
        if ($count_orderItem) {
            //decrease qnt
            $exist_orderitem = mysqli_fetch_assoc($check_orderItem);

            if ($exist_orderitem['qty'] > 1) {

                $update_orderitem = mysqli_query($connect, "update orderitem SET qty=qty-1 where
                 dish_id='$dish_id' AND order_id='$order_id'");
            } else {
                $remove_orderItem = mysqli_query($connect, "delete from orderitem where dish_id='$dish_id' AND order_id='$order_id'");
            }
        }
    }

    redirect("index.php");

}

if (isset($_GET['add_order'])) {
    $dish_id = $_GET['add_order'];

    $check_order = mysqli_query($connect, "select * from orders where status='0'");
    $count_order = mysqli_num_rows($check_order);
    if ($count_order) {
        $exist_order = mysqli_fetch_assoc($check_order);

        //check order itme table this dish exits or not
        $order_id = $exist_order['id'];
        $check_orderItem = mysqli_query($connect, "select * from orderItem where order_id='$order_id' and dish_id='$dish_id'");
        $count_orderItem = mysqli_num_rows($check_orderItem);
        if ($count_orderItem) {
            //increase qnt
            $update_orderitem = mysqli_query($connect, "update orderitem SET qty=qty+1 where dish_id='$dish_id' AND order_id='$order_id'");
        } else {
            //create order item
            $create_orderItem = mysqli_query($connect, "insert into orderItem (order_id, dish_id) value ('$order_id',
                '$dish_id')");
        }
    } else {
        $create_order = mysqli_query($connect, "insert into orders (status) value ('0')");
        $order_id = mysqli_insert_id($connect);
        //now insert and update order item just after order creation
        $check_orderItem = mysqli_query($connect, "select * from orderItem where order_id='$order_id' and dish_id='$dish_id'");
        $count_orderItem = mysqli_num_rows($check_orderItem);
        if ($count_orderItem) {
            //increase qnt
            $update_orderitem = mysqli_query($connect, "update orderitem SET qty=qty+1 where dish_id='$dish_id' AND order_id='$order_id'");
        } else {
            //create order item
            $create_orderItem = mysqli_query($connect, "insert into orderItem (order_id, dish_id) value ('$order_id',
                '$dish_id')");
        }
    }

    redirect("index.php");
}

//update order
if (isset($_POST['update_order'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $query = mysqli_query($connect, "update orders SET name='$name', contact='$contact', status='1' where status='0'");
    if ($query) {
        redirect("index.php");
    } else {
        msg("order not placed");
    }

}

?>