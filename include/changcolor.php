
<?php

if(isset($_COOKIE["background"])){
      echo "<style> body {background-color: ". $_COOKIE["background"]."}</style>";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    setcookie("background", $_POST["bg-color"], strtotime("+1 year"));
    header("Location: " . $_SERVER["REQUEST_URI"]);
exit();

    
}
?>

<form class="chang" action="" method="POST">
<input class="inpchang" type="color" name="bg-color" id="">

<input class="savchang" type="submit" value="save">

</form>

