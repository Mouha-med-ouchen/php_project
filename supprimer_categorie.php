
<?php
require_once 'include/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sqlState = $pdo->prepare('DELETE FROM categorie WHERE id = ?');

    $sqlState->execute([$id]);
    header(header:'location:categories.php');
   
}
?>
