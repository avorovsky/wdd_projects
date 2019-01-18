<?php

    /**
     * returns number of items in the cart
     */

    if (empty($_SESSION['cart'])) {
        return 0;
    } else {
        return count($_SESSION['cart']);
    }
