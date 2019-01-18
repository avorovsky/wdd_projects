<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * invoice view
 */

?>
<div class="invoice">
    <table>
        <thead>
            <tr>
                <th colspan="2"><h3>INVOICE #<?=$data['invoice_num']?></h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Invoice to:</strong><br/><?=$data['invoice_to']?><br/><br/>
                    <strong>Phone:</strong><br/><?=$data['phone']?>
                </td>
                <td><strong>Billing address:</strong><br/><?=$data['billing_address']?></td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th colspan="2">#</th>
                <th>Item</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
<?php

    for ($i = 1; $i <= $data['count']; $i++) {

?>
            <tr>
                <td colspan="2"><?=$i?></td>
                <td><?=$data[$i]['name']?></td>
                <td class="price">$<?=$data[$i]['price']?></td>
            </tr>
<?php

    } // for

?>
            <tr>
                <td colspan="2"></td>
                <td class="price">Subtotal:</td>
                <td class="price">$<?=$data['subtotal']?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="price">GST/PST:</td>
                <td class="price">$<?=$data['tax']?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="price">Total:</td>
                <td class="price">$<?=$data['total']?></td>
            </tr>
        </tbody>
    </table>
</div>
