<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * sign-in/status/sign-out button
 */

    // img-version
    // $imgAdmin = '<img src="'.IMG.'ico_admin.png" alt="Administrator" title="Administrator" width="25" height="25" />';
    // emoji-version
    $imgAdmin = '&nbsp;&#x1F47B';
    $imgUser = (empty($_SESSION['image']) ? '&nbsp;&#9830;' : '<img src="'.$_SESSION['image'].'" alt="'.$_SESSION['username'].'" title="'.$_SESSION['username'].'" width="25" height="25" />');

    if (!empty($_SESSION['username'])) {

?>
        <form action="/signin/exit" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <div class="toolbox">
                <div class="action_tool">
                    <button class="signin" type="submit" name="signin">
                        <?=$_SESSION['username'].(empty($_SESSION['is_admin']) ? $imgUser : $imgAdmin)?>&nbsp;Sign&nbsp;out
                    </button>
                </div>
            </div>
        </form>
<?php

    } else {

?>
        <form action="/signin" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <div class="toolbox">
                <div class="action_tool">
                    <button class="signin" type="submit" name="signin">Sign&nbsp;in&nbsp;&#x1F511;</button>
                </div>
            </div>
        </form>
<?php

    }//if

?>
