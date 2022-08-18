<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="/includes/shared.css">
</head>

<body>
    <header>
        <nav>
            <div>
                <a href="/index.php">LOZODO</a>
                <div>
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="/my-account/my-account.php">My account</a>
                        </li>
                        <?php if (isset($_SESSION['user-type']) && $_SESSION['user-type'] == "1"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/customer/view-product.php">View product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/customer/cart.php">Cart</a>
                        </li>
                        <?php endif ;?>
                        <?php if (isset($_SESSION['user-type']) && $_SESSION['user-type'] == "2"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/vendor/add-new-product.php">Add new product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vendor/view-product.php">View product</a>
                        </li>
                        <?php endif ;?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>