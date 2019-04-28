<?php
session_start();
include 'header.php';

?>
<div class="">
Bem vindo, <?php echo $_SESSION['nome'];?>
</div>

<?php
include 'footer.php';
?>
