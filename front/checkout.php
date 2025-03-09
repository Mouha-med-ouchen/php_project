<?php
session_start();

$cookie_lifetime = time() + (7 * 24 * 60 * 60); 

if (!isset($_SESSION['cart'])) {
    if (isset($_COOKIE['cart'])) {
        $_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
    } else {
        $_SESSION['cart'] = [];
    }
}

if (empty($_SESSION['cart'])) {
    header("Location: panier.php");
    exit();
}

$total_price = 0;
foreach ($_SESSION['cart'] as $product) {
    $total_price += $product['price'] * $product['quantity'];
}

function updateCartCookie() {
    global $cookie_lifetime;
    setcookie('cart', json_encode($_SESSION['cart']), $cookie_lifetime, "/");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $phone = htmlspecialchars($_POST['phone']);  
    $address = htmlspecialchars($_POST['address']);

    $cart_details = " *Commande Client* :\n";
    $cart_details .= " Nom: $name $surname\n";
    $cart_details .= " Téléphone: $phone\n"; 
    $cart_details .= " Adresse: $address\n\n";
    $cart_details .= " *Produits Commandés*:\n";
    
    foreach ($_SESSION['cart'] as $product) {
        $cart_details .= " " . $product['name'] . " *:* " . $product['quantity'] . "x" . number_format($product['price'], 2) . " DH\n";
    }
    $cart_details .= "\n *Total*: " . number_format($total_price, 2) . " DH";

    $whatsapp_number = "212652906599";
    $whatsapp_message = urlencode($cart_details);
    $whatsapp_url = "https://wa.me/$whatsapp_number?text=$whatsapp_message";
    header("Location: $whatsapp_url");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser L'achat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include "../include/nav_front.php"; ?>

<div class="container mt-5">
    <h2 class="mb-4 product-title">Finaliser L'achat</h2>

    <div class="alert alert-info">
        <h4>Résumé de votre commande</h4>
        <ul>
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <li><?php echo $product['name']; ?> (<?php echo $product['quantity']; ?> x <?php echo number_format($product['price'], 2); ?> DH)</li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Total : <?php echo number_format($total_price, 2); ?> DH</strong></p>
    </div>
    <form method="POST" class="mt-4">
        <label for=""><span class="text text-danger">*</span>(Important)</label>
        <div class="mb-3">
            <label class="form-label">Nom :<span class="text text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom :<span class="text text-danger">*</span></label>
            <input type="text" name="surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone :<span class="text text-danger">*</span></label>
            <input type="tel" name="phone" class="form-control" required pattern="[0-9]+" minlength="9" maxlength="15">
        </div>
        <div class="mb-3">
            <label class="form-label">Adresse :<span class="text text-danger">*</span></label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Envoyer vers WhatsApp</button>
    </form>
</div>
<?php include "../include/foter.php";?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/produit/counter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
