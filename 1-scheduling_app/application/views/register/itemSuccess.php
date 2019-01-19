<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of registered data upon success
 */

?>
<table>
    <thead>
        <th colspan='2'>
            <p>
                Thank you for your interest on our courses!
            </p>
            <p>
                We saved your request under reference #<?= $data['id'] ?>. Our 
                admission staff will provide you feedback as soon as possible 
                by phone <?= $data['phone'] ?> or via email <?= $data['email'] ?>.
            </p>
            <p>
                Please save or print this page for your records as it contains 
                your personal data stored in our system.
            </p>
        </th>
    </thead>
    <tbody>
        <tr>
            <td>Reference ID</td>
            <td><?=$data['id']?></td>
        </tr>
        <tr>
            <td>Your name</td>
            <td><?=$data['last_name'].', '.$data['first_name']?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?=$data['address'].'<br/>',$data['city'].'<br/>'.$data['zip_code'].'<br/>'.$data['country']?></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><?=$data['phone']?></td>
        </tr>
        <tr>
            <td>Document ID</td>
            <td><?=$data['doc_id_num'].' valid to '.$data['doc_id_valid']?></td>
        </tr>
        <tr>
            <td>User data</td>
            <td><?='Login: '.$data['username'].'<br/>Password: '.(empty($data['password']) ? 'NOT SET' : 'is set').'<br/>Email: '.$data['email']?></td>
        </tr>
        <tr>
            <td>Your message</td>
            <td><?=$data['comment']?></td>
        </tr>
    </tbody>
</table>