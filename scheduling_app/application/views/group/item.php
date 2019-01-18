<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of Group
 */

    // in-page actions
    if (isset($_POST['add'])) {
        $result = \Models\PeopleInGroup::addConnection($_POST['id'], $data['id']);
        // set message
        $message = new \Components\Message('Relationship added', 'success');
    } elseif (isset($_POST['del'])) {
        $result = \Models\PeopleInGroup::delConnection($_POST['del'], $data['id']);
        // set message
        $message = new \Components\Message('Relationship deleted', 'success');
        
    }

    // flash message
    $message = new \Components\Message();
    echo $message->getMessage();

?>
<form action="/group/save" method="post" accept-charset="UTF-8">
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
        <legend>Group</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="group name" value="<?=$data['name']?>" />
        </p>
        <p>
            <label for="course_id">Course:</label>
            <select name="course_id">
                <option value="" disabled selected>Select course</option>
<?php
    // courses list
    $courseList = \Models\Course::getCourseList();
    
    foreach ($courseList as $value) {

?>
                <option value="<?=$value['id']?>"
                               <?=($data['course_id'] == $value['id'] ? ' selected' : '')?>
                               <?=($value['deleted'] ? ' disabled' : '')?>>
                               <?=($value['deleted'] ? '(deleted) ' : '')?>
                               <?=$value['name']?>
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
<form action="/group/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
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
<form action="/group/<?=$data['id']?>" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <table>
        <thead>
            <tr>
                <th colspan="4">
                    People related
                </th>
            </tr>
        </thead>
        <tbody>
<?php

    $peopleList = \Models\PeopleInGroup::getPeopleOfGroup($data['id']);
    
    foreach ($peopleList as $value) {

        $strikeout_deleted = ($value['deleted'] ? ' class="deleted"' : '');

?>
            <tr<?=$strikeout_deleted?>>
                <td><?=$value['last_name'].', '.$value['first_name']?></td>
                <td><?=$value['phone']?></td>
                <td><?=$value['email']?></td>
                <td class="control_button">
                    <button class="del" type="submit" name="del" value="<?=$value['id']?>">Del</button>
                </td>
            </tr>
<?php

    } // foreach
    
    if (sizeof($peopleList) == 0) {
        
?>
            <tr>
                <td colspan="4">
                    No people found
                </td>
            </tr>
<?php

    } // if

?>
            <tr>
                <td class="input_field" colspan="3">
                    <select name="id">
                        <option value="" disabled selected>Select student</option>
<?php
    // available people list
    $peopleList = \Models\PeopleInGroup::getPeopleList($data['id'], 's');
    
    foreach ($peopleList as $value) {

?>
                        <option value="<?=$value['id']?>"
                                <?=($value['deleted'] ? ' disabled' : '')?>>
                                <?=($value['deleted'] ? '(deleted) ' : '')?>
                                <?=$value['last_name'].', '.
                                   $value['first_name'].' // '.
                                   $value['phone'].' // '.
                                   $value['email']?>
                        </option>
<?php

    } // foreach
    
?>
                    </select>
                </td>
                <td class="input_field control_button">
                    <button class="add" type="submit" name="add">Add</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<?php

    } // if (is_admin & existing item)

?>
<br/>
<span class="db_data">Modified: <?=(!empty($data['modified']) ? $data['modified'] : 'N/A')?></span>
<span class="db_data">Created: <?=(!empty($data['created']) ? $data['created'] : 'N/A')?></span>
<span class="db_data">ID: <?=(!empty($data['id']) ? $data['id'] : 'N/A')?></span>
