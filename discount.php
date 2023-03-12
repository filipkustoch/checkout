<?php
include "includes/db.php";

$discountCode = mysqli_real_escape_string($connection, $_POST['discountCode']);
$query = "SELECT * FROM kody WHERE kod = '$discountCode' AND status = 'aktywny'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
  echo "valid";
} else {
  echo "invalid";
}
?>