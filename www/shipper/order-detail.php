<title>Order details</title>
<?php
session_start();
include('../includes/header.php');
if (!isset($_SESSION['username']) || $_SESSION['user-type'] != '3') {
    header("Location: ../my-account/my-account.php?error=invalidaccount");
}

$readData = fopen('../Data/order.db', 'r');
flock($readData, LOCK_SH);
$orderData = array();
while ($line = fgetcsv($readData)) {
    $orderData[] = $line;
}
fclose($readData);

$orderId = $_GET['id'];

$readData = fopen('../Data/product.db', 'r');
flock($readData, LOCK_SH);
$productData = array();
while ($line = fgetcsv($readData)) {
    $productData[] = $line;
}
fclose($readData);

?>

<body>
    <?php foreach ($orderData as $order) : ?>
        <?php if ($order[0] == $orderId) : ?>

            <section class="order">
                <h3 id="id"><?php echo $order[0] ?></h3>
                <h3 name="user" id="user"><?php echo "User: " . $order[1] ?></h3>
                <h3 id="hub"><?php echo "Hub: " . $order[2] ?></h3>
                <h3 name='status' id="status"><?php echo "Status: " . $order[3] ?></h3>

                <?php foreach ($order as $orderInfo) : ?>
                    <?php if (str_contains($orderInfo, ':')) : ?>
                        <?php foreach ($productData as $product) : ?>
                            <?php if (str_contains($product[0], substr($orderInfo, 0, 14))) : ?>
                                <h3 id="product"><?php echo $product[2] . substr($orderInfo, 23, 10); ?></h3>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endif ?>
                <?php endforeach; ?>

                <?php if ($order[3] == "active") : ?>
                    <a href="./order-detail-include.php?status=delievered&id=<?php echo $orderId ?>">Change to delivered</a>
                    <a href="./order-detail-include.php?status=canceled&id=<?php echo $orderId ?>">Change to canceled</a>
                <?php endif ?>

                <?php if ($order[3] == "delievered") : ?>
                    <a href="./order-detail-include.php?status=active&id=<?php echo $orderId ?>">Change to active</a>
                    <a href="./order-detail-include.php?status=canceled&id=<?php echo $orderId ?>">Change to canceled</a>
                <?php endif ?>

                <?php if ($order[3] == "canceled") : ?>
                    <a href="./order-detail-include.php?status=active&id=<?php echo $orderId ?>">Change to active</a>
                    <a href="./order-detail-include.php?status=delivered&id=<?php echo $orderId ?>">Change to delivered</a>
                <?php endif ?>
            </section>

        <?php break;
        endif ?>
    <?php endforeach; ?>
    <?php
    include('../includes/footer.php');
    ?>
</body>