<?php

  /**
   * returns number of quantity in the cart
   */

  if (empty($_SESSION['cart'])) {
    return 0;
  } else {
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
      $total += floatval($value['quantity']);
    }
    return $total;

  }
