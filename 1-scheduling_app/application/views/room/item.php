<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of Room
 */

?>
<form action="/room/save" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
<?php

    if (!empty($_SESSION['is_admin'])) {

        include ROOT.'templates'.DS.'buttonCancel.php';

        if (!$data['deleted']) {
            include ROOT.'templates'.DS.'buttonSave.php';
        }

    }

?>
    </div>
    <fieldset>
        <legend>Room</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="number">Room #:</label>
            <input type="text" name="number" placeholder="room number" value="<?=$data['number']?>" />
        </p>
        <p>
            <label for="description">Description:</label>
            <input type="text" name="description" placeholder="room's description" value="<?=$data['description']?>" />
        </p>
        <p>
            <label for="capacity">Capacity:</label>
            <input type="number" min="0" max="999" name="capacity" placeholder="people" value=<?=$data['capacity']?> />
        </p>
    </fieldset>
</form>
<?php

    if (!empty($_SESSION['is_admin']) && !empty($data['id'])) {

?>
<form action="/room/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
<?php

        if (empty($data['deleted'])) {
            include ROOT.'templates'.DS.'buttonDelete.php';
        } else {
            include ROOT.'templates'.DS.'buttonRestore.php';
        }

?>
    </div>
</form>
<?php

    } // if

?>
<br/>
<span class="db_data">Modified: <?=(!empty($data['modified']) ? $data['modified'] : 'N/A')?></span>
<span class="db_data">Created: <?=(!empty($data['created']) ? $data['created'] : 'N/A')?></span>
<span class="db_data">ID: <?=(!empty($data['id']) ? $data['id'] : 'N/A')?></span>
