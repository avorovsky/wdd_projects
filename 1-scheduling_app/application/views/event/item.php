<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of Event
 */

?>
<form action="/event/save" method="post" accept-charset="UTF-8">
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
        <legend>Details</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="name">Event name:</label>
            <input type="text" name="name" placeholder="Event name" value="<?=$data['name']?>" />
        </p>
        <p>
            <label for="group">Group:</label>
            <select name="group">
                <option value="" disabled selected>Select group</option>
<?php

    $groupList = \Models\Group::getGroupList();
    
    foreach ($groupList as $key => $groupItem) {
        
?>
                <option value="<?=$groupItem['id']?>"<?=($data['group_id'] == $groupItem['id'] ? ' selected' : '')?>
                               <?=($groupItem['deleted'] ? ' disabled' : '')?>>
                               <?=($groupItem['deleted'] ? '(deleted) ' : '')?>
                               <?=$groupItem['name'].' - '.$groupItem['course_name']?></option>
<?php

    } // foreach
        
?>
            </select>
        </p>
        <p>
            <label for="instructor">Instructor:</label>
            <select name="instructor">
                <option value="" disabled selected>Select instructor</option>
<?php

    $peopleList = \Models\People::getPeopleList('i');
    
    foreach ($peopleList as $key => $peopleItem) { 
        
?>
                <option value="<?=$peopleItem['id']?>"
                               <?=($data['instructor_id'] == $peopleItem['id'] ? ' selected' : '')?>
                               <?=($peopleItem['deleted'] ? ' disabled' : '')?>>
                               <?=($peopleItem['deleted'] ? '(deleted) ' : '')?>
                               <?=$peopleItem['last_name'].', '.$peopleItem['first_name']?>
                </option>
<?php

    } // foreach
        
?>
            </select>
        </p>
    </fieldset>
    <fieldset>
        <legend>Time and place</legend>
        <p>
            <label for="date">Date:</label>
            <input type="date" name="date" value="<?=$data['date']?>" />
        </p>
        <p>
            <label for="time_from">Time:</label>
            <input type="time" name="time_from" value="<?=$data['time_from']?>" />
            &nbsp;to&nbsp;
            <input type="time" name="time_to" value="<?=$data['time_to']?>" />
        </p>
        <p>
            <label for="room">Room #:</label>
            <select name="room">
                <option value="" disabled selected>Select room</option>
<?php

    $roomList = \Models\Room::getRoomList();
    
    foreach ($roomList as $key => $roomItem) { 
        
?>
                <option value="<?=$roomItem['id']?>"
                               <?=($data['room_id'] == $roomItem['id'] ? ' selected' : '')?>
                               <?=($roomItem['deleted'] ? ' disabled' : '')?>>
                               <?=($roomItem['deleted'] ? '(deleted) ' : '')?>
                               <?=$roomItem['number'].' - '.
                                  $roomItem['description'].' ('.
                                  $roomItem['capacity'].' people)'?>
                </option>
<?php

    } // foreach
        
?>
            </select>
        </p>
    </fieldset>
</form>
<?php

    if (!empty($_SESSION['is_admin']) && !empty($data['id'])) {

?>
<form action="/event/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
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
