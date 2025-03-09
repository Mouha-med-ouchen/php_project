
<?php
require_once 'include/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sqlState = $pdo->prepare('DELETE FROM porduit WHERE id = ?');

    $sqlState->execute([$id]);
    header(header:'location:produits.php');
   
}
?>