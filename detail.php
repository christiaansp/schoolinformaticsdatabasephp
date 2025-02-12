<?php
# database setup
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "film_database";

// init database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// init product id
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM films WHERE id = $product_id";
$result = $conn->query($sql);

// Check of product bestaat
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $product_found = true;
} else {
    $product_found = false;
}

$conn->close();
?>
<!-- HTML:5 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_found ? $product["titel"] . " - RetroComp" : "404 - Product Not Found"; ?></title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<!-- #######Navbar############# -->
<div class="navbar">
    <a href="home.php#Home" class="tablink">Home</a>
    <a href="home.php#Store" class="tablink">Store</a>
    <a href="home.php#Contact" class="tablink">Contact</a>
    <a href="home.php#About" class="tablink">About</a>
</div>




<!-- #######Normale Site############# -->

<?php if ($product_found): ?>
    <!-- als product gevonden kan worden krijgen ze de normale site. -->
    <div class="product-detail">
        <div class="product-header">
            <h1><?php echo $product["titel"]; ?></h1>
            <img class="product-image" src="<?php echo $product["afbeelding_url"]; ?>" alt="<?php echo $product["titel"]; ?>">
        </div>

        <div class="product-info">
            <p><?php echo $product["beschrijving"] ?? "No description available."; ?></p>
            <p><?php echo "€" . ($product["prijs"] ?? "Price not found."); ?></p>

            <div class="product-buttons">
            <p></p>
                <button class="buy-now">Buy Now</button>
                <p>(buying feature not coming soon)</p>
            </div>
        </div>
    </div>





<!-- #######404############# -->
<?php else: ?>
    <!-- 404 als niet gevonden kan worden -->
    <div class="not-found">
        <img src="images/404.png" alt="Product Not Found">
    </div>
<?php endif; ?>

</body>
</html>
