<?php
$page_slug = 'dashboard';
?>

<?php
include 'includes/header.php';
include 'includes/side-nav.php';

?>




<div class="py-5">
  <h2 class="text-center">Welcome! <?php echo $_SESSION['user']; ?></h2>
</div>
<div class="py-5 text-center" >
  <a name="" id="" class="btn btn-primary" href="create-invoice.php" role="button">Create an Invoice</a>
</div>

















<?php

include 'includes/footer.php';
?>