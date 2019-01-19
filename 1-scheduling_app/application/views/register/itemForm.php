<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * registration form to fill
 */

?>
<form action="/register" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
        <div class="action_tool">
            <button class="cancel" type="submit" name="cancel">Clear&nbsp;&#9851;</button>
        </div>
        <div class="action_tool">
            <button class="save" type="submit" name="send">Send&nbsp;&#9993;</button>
        </div>
    </div>
    <fieldset>
        <legend>General information</legend>
        <p>
            <strong>Welcome to our registration process!</strong> To become a 
            student please <strong>fill the form</strong> below and mention 
            your interest on our courses in the comment.
        </p>
        <p>
            Please note, that <strong>all fields are mandatory</strong> and 
            should contain your <strong>actual data</strong>.
        </p>
        <p>
            For safety and legal reasons, all information provided is to be kept 
            confidential and is <strong>not to be shared</strong> with third 
            parties including any private or public institutions.
        </p>
        <p>
            By pressing 'Send' button <strong>you authorize</strong> our 
            admission staff to review your data and contact you by email, phone, 
            or address mentioned. <strong>No advertisement</strong> or 
            promotional messages to be sent, unless you request them clearly.
        </p>
    </fieldset>
    <fieldset>
        <legend>Personal</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <input type="hidden" name="not_verified" value="1" />
        <?=$validator->displayError('first_name', $errors)?>
        <p>
            <label for="first_name">First name:</label>
            <input type="text" name="first_name" id="first_name" placeholder="first name" value="<?=$data['first_name']?>" />
        </p>
        <?=$validator->displayError('last_name', $errors)?>
        <p>
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" id="last_name" placeholder="last name" value="<?=$data['last_name']?>" />
        </p>
        <?=$validator->displayError('birthdate', $errors)?>
        <p>
            <label for="birthdate">Birth date:</label>
            <input type="date" name="birthdate" id="birthdate" value="<?=$data['birthdate']?>" />
        </p>
        <?=$validator->displayError('phone', $errors)?>
        <p>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" placeholder="phone number" value="<?=$data['phone']?>" />
        </p>
    </fieldset>
    <fieldset>
        <legend>Address</legend>
        <?=$validator->displayError('address', $errors)?>
        <p>
            <label for="address">Street:</label>
            <input type="text" name="address" id="address" placeholder="street address" value="<?=$data['address']?>" />
        </p>
        <?=$validator->displayError('city', $errors)?>
        <p>
            <label for="city">City:</label>
            <input type="text" name="city" id="city" placeholder="city name" value="<?=$data['city']?>" />
        </p>
        <?=$validator->displayError('zip_code', $errors)?>
        <p>
            <label for="zip_code">ZIP code:</label>
            <input type="text" name="zip_code" id="zip_code" placeholder="postal code" value="<?=$data['zip_code']?>" />
        </p>
        <?=$validator->displayError('country', $errors)?>
        <p>
            <label for="country">Country:</label>
            <select name="country" id="country">
                <option value="" disabled selected>Select country</option>
<?php
    // countries list
    $countriesList = include(APP.'config'.DS.'countries.php');
    
    foreach ($countriesList as $key => $value) {

?>
                <option value="<?=$key?>"<?=($data['country'] == $key ? ' selected' : '')?>><?=$value?></option>
<?php

    } // foreach
    
?>
            </select>
        </p>
    </fieldset>
    <fieldset>
        <legend>Document ID</legend>
         <?=$validator->displayError('doc_id_num', $errors)?>
        <p>
            <label for="doc_id_num">Number:</label>
            <input type="text" name="doc_id_num" id="doc_id_num" placeholder="document number" value="<?=$data['doc_id_num']?>" />
        </p>
        <?=$validator->displayError('doc_id_valid', $errors)?>
        <p>
            <label for="doc_id_valid">Valid to:</label>
            <input type="date" name="doc_id_valid" id="doc_id_valid" value="<?=$data['doc_id_valid']?>" />
        </p>
    </fieldset>
    <fieldset>
        <legend>User</legend>
        <?=$validator->displayError('username', $errors)?>
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="username/login" value="<?=$data['username']?>" />
        </p>
        <?=$validator->displayError('email', $errors)?>
        <p>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="valid email address" value="<?=$data['email']?>" />
        </p>
        <?=$validator->displayError('password', $errors)?>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="password" value="<?=$data['password']?>" />
        </p>
        <?=$validator->displayError('confirm', $errors)?>
        <p>
            <label for="confirm">Confirm:</label>
            <input type="password" name="confirm" id="confirm" placeholder="confirm password" value="<?=(isset($data['confirm']) ? $data['confirm'] : '')?>" />
        </p>
    </fieldset>
    <fieldset>
        <legend>Message</legend>
        <p>
            <textarea name="comment" placeholder="Please type your message here"><?=$data['comment']?></textarea>
        </p>
    </fieldset>
</form>
