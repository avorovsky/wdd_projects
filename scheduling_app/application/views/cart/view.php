<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of cart
 */

?>
<form action="/cart/checkout" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
<?php

    if (!empty($_SESSION['username']) && !empty($_SESSION['cart'])) {
        include ROOT.'templates'.DS.'buttonCheckout.php';
    }

?>
    </div>
</form>
<table>
    <thead>
        <tr>
            <th colspan="3">
                Your cart
            </th>
        </tr>
    </thead>
    <tbody>
<?php

    $total = 0;

    foreach ($data as $value) {

        $item = \Models\Book::getBookItemById($value);
        $total += $item['price'];

?>
        <tr>
            <td class="open">
                <a href="/book/<?=$item['id']?>" title="Open <?=$item['name']?>">
                    &quot;<?=$item['name']?>&quot; <small><em>by <?=$item['author']?></em></small>
                </a>
            </td>
            <td class="price">$<?=$item['price']?></td>
            <td class="control_button">
                <form action="/cart/del/<?=$item['id']?>" method="post" accept-charset="UTF-8">
                    <?=\Components\Token::getToken();?>
                    <button class="del" type="submit" name="del" value="del">Del</button>
                </form>
            </td>
        </tr>
<?php

    } // foreach

    if (sizeof($data) == 0) {

?>
        <tr>
            <td colspan="3">
                Your cart is empty
            </td>
        </tr>
<?php

    } else {

?>
        <tr>
            <td class="price">Subtotal:</td>
            <td class="price">$<?=$total?></td>
            <td></td>
        </tr>
        <tr>
            <td class="price">GST/PST:</td>
            <td class="price">$<?=number_format($total*TAX,2)?></td>
            <td></td>
        </tr>
        <tr>
            <td class="price">Payable:</td>
            <td class="price">$<?=number_format($total*(1+TAX),2)?></td>
            <td></td>
        </tr>
<?php

    } // if else

?>
    </tbody>
</table>
