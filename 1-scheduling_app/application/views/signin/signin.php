<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * sign-in form
 */

?>
<form action="/signin/check" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
<?php

        include ROOT.'templates'.DS.'buttonSignin.php';
        include ROOT.'templates'.DS.'buttonCancel.php';

?>
    </div>
    <fieldset>
        <legend>Credentials</legend>
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="username/login" value="<?=(empty($_POST['username']) ? '' : $_POST['username'])?>"/>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="password" />
        </p>
    </fieldset>
</form>