<?php
session_start();

// Durée de vie du cookie (7 jours)
$cookie_lifetime = time() + (7 * 24 * 60 * 60);

// Initialisation du panier
if (!isset($_SESSION['cart'])) {
    if (isset($_COOKIE['cart'])) {
        $cart_data = json_decode($_COOKIE['cart'], true);
        $_SESSION['cart'] = is_array($cart_data) ? $cart_data : []; //انات مصفوفة
    } else {
        $_SESSION['cart'] = [];
    }
}


// Fonction pour mettre à jour le cookie du panier
function updateCartCookie() {
    global $cookie_lifetime;
    setcookie('cart', json_encode($_SESSION['cart']), $cookie_lifetime, "/");
}

// Suppression d'un produit du panier
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        updateCartCookie();
    }
    header("Location: panier.php");
    exit();
}

// Vider tout le panier
if (isset($_GET['clear_cart'])) {
    $_SESSION['cart'] = [];
    updateCartCookie();
    header("Location: panier.php");
    exit();
}

// Ajouter ou mettre à jour un produit dans le panier
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ajouter'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = (float) $_POST['product_price']; // Assurez-vous que le prix est un float
    $quantity = (int) $_POST['qty'];

    if ($quantity > 0) {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        ];
    } else {
        unset($_SESSION['cart'][$product_id]);
    }

    updateCartCookie();
    header("Location: panier.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier d'achats</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include "../include/nav_front.php"; ?>
<div class="container mt-5">
    <h2 class="mb-4 product-title">Panier d'achats <a href="home.php"><i class="fa-solid fa-cart-shopping"></i></a></h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_price = 0;
                foreach ($_SESSION['cart'] as $id => $product): 
                    $product_price = (float) $product['price'];
                    $product_quantity = (int) $product['quantity'];
                    $subtotal = $product_price * $product_quantity;
                    $total_price += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo number_format($product_price, 2); ?> DH</td>
                    <td>
                        <form method="POST" action="panier.php">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($id); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                            <input type="number" name="qty" value="<?php echo $product_quantity; ?>" min="1" max="99">
                            <input type="submit" name="ajouter" value="Mettre à jour" class="btn btn-sm btn-primary">
                        </form>
                    </td>
                    <td><?php echo number_format($subtotal, 2); ?> DH</td>
                    <td><a onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')" href="panier.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="bg-success text-white"><strong>Total</strong></td>
                    <td colspan="2"><strong><?php echo number_format($total_price, 2); ?> DH</strong></td>
                </tr>
            </tbody>
        </table>

        <a href="checkout.php" class="btn btn-success">Finaliser L'achat</a>
        <a href="panier.php?clear_cart=true" onclick="return confirm('Voulez-vous vider le panier ?')" class="btn btn-danger">Vider le panier</a>

    <?php else: ?>
        <p class="alert alert-warning">Le panier est vide.</p>
        <a class="shops" href="home.php">Aller Faire du Shopping Maintenant</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/produit/counter.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
