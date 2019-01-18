<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of People
 */

    // in-page actions
    if (isset($_POST['add'])) {
        $result = \Models\PeopleInGroup::addConnection($data['id'], $_POST['id']);
        // set message
        $message = new \Components\Message('Relationship added', 'success');
    } elseif (isset($_POST['del'])) {
        $result = \Models\PeopleInGroup::delConnection($data['id'], $_POST['del']);
        // set message
        $message = new \Components\Message('Relationship deleted', 'success');
    }

    // flash message
    $message = new \Components\Message();
    echo $message->getMessage();

?>
<form action="/people/save" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
    <?=\Components\Token::getToken();?>
    <div class="toolbox">
<?php

    include ROOT.'templates'.DS.'buttonCancel.php';

    if (!$data['deleted']) {
        include ROOT.'templates'.DS.'buttonSave.php';
    }

?>
    </div>
    <fieldset>
        <legend>Personal</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="first_name">First name:</label>
            <input type="text" name="first_name" placeholder="first name" value="<?=$data['first_name']?>" />
        </p>
        <p>
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" placeholder="last name" value="<?=$data['last_name']?>" />
        </p>
        <p>
            <label for="birthdate">Birth date:</label>
            <input type="date" name="birthdate" value="<?=$data['birthdate']?>" />
        </p>
        <p>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" placeholder="phone number" value="<?=$data['phone']?>" />
        </p>
    </fieldset>
    <fieldset>
        <legend>Address</legend>
        <p>
            <label for="address">Street:</label>
            <input type="text" name="address" placeholder="street address" value="<?=$data['address']?>" />
        </p>
        <p>
            <label for="city">City:</label>
            <input type="text" name="city" placeholder="city name" value="<?=$data['city']?>" />
        </p>
        <p>
            <label for="zip_code">ZIP code:</label>
            <input type="text" name="zip_code" placeholder="postal code" value="<?=$data['zip_code']?>" />
        </p>
        <p>
            <label for="counry">Country:</label>
            <select name="country">
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
        <p>
            <label for="doc_id_num">Number:</label>
            <input type="text" name="doc_id_num" placeholder="document number" value="<?=$data['doc_id_num']?>" />
        </p>
        <p>
            <label for="doc_id_valid">Valid to:</label>
            <input type="date" name="doc_id_valid" value="<?=$data['doc_id_valid']?>" />
        </p>
    </fieldset>
    <fieldset>
        <legend>User</legend>
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="username/login" value="<?=$data['username']?>" />
        </p>
        <p>
            <label for="email">E-mail:</label>
            <input type="email" name="email" placeholder="valid email address" value="<?=$data['email']?>" />
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="password to change" value="" />
        </p>
    </fieldset>
    <fieldset class="select_image">
        <legend>Image</legend>
        <div class="select_image">
	    <input id="img_select" class="select_image" type="file" name="image" />
	    <div class="select_image_fake">
		<input id="img_select_fake" class="select_image_fake" placeholder="select image file" />
                <span>&#x1F4C2;</span>
	    </div>
            <p class="select_image">
                <strong>Note:</strong> only PNG, JPEG, and GIF images are accepted;
                any image will be resized to 200 pixels wide with aspect ratio kept;
                a strict square image looks best
            </p>
        </div>
        <div class="select_image">
            <img src="<?=\Components\ImgBlob::blobToSrc($data['image_mime'], $data['image'])?>"
                 alt="<?=$data['username']?>"
                 title="<?=$data['username']?>" />
        </div>
    </fieldset>
<?php

    if (!empty($_SESSION['is_admin'])) {
        
?>
    <fieldset>
        <legend>Status</legend>
        <p>
            <input type="checkbox" name="not_verified" <?=($data['not_verified'] ? 'checked ' : '')?>/>
            <label class="for_checkbox" for="not_verified">Not verified</label>
        </p>
        <p>
            <input type="checkbox" name="is_student" <?=($data['is_student'] ? 'checked ' : '')?>/>
            <label class="for_checkbox" for="is_student">Student</label>
        </p>
        <p>
            <input type="checkbox" name="is_instructor" <?=($data['is_instructor'] ? 'checked ' : '')?>/>
            <label class="for_checkbox" for="is_instructor">Instructor</label>
        </p>
        <p>
            <input type="checkbox" name="is_admin" <?=($data['is_admin'] ? 'checked ' : '')?> <?=($data['id'] == $_SESSION['id'] ? 'readonly ' : '')?>/>
            <label class="for_checkbox" for="is_admin">Admin</label>
        </p>
    </fieldset>
<?php

    } else {

        echo ($data['not_verified'] ? '<input type="hidden" name="not_verified" checked />' : '');
        echo ($data['is_student'] ? '<input type="hidden" name="is_student" checked />' : '');
        echo ($data['is_instructor'] ? '<input type="hidden" name="is_instructor" checked />' : '');
        echo ($data['is_admin'] ? '<input type="hidden" name="is_admin" checked />' : '');
        
    } // if (is_admin)

?>
    <fieldset>
        <legend>Comments</legend>
        <p>
            <textarea name="comment" placeholder="Comments go here"><?=$data['comment']?></textarea>
        </p>
    </fieldset>
</form>
<?php

    if (!empty($_SESSION['is_admin']) && !empty($data['id'])) {
        
?>
<form action="/people/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
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
<form action="/people/<?=$data['id']?>" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <table>
        <thead>
            <tr>
                <th colspan="3">
                    Groups related
                </th>
            </tr>
        </thead>
        <tbody>
<?php

        $groupList = \Models\PeopleInGroup::getGroupsOfPeople($data['id']);

        foreach ($groupList as $value) {

            $strikeout_deleted = ($value['deleted'] ? ' class="deleted"' : '');

?>
            <tr<?=$strikeout_deleted?>>
                <td><?=$value['name']?></td>
                <td><?=$value['course_name']?></td>
                <td class="control_button">
                    <button class="del" type="submit" name="del" value="<?=$value['id']?>">Del</button>
                </td>
            </tr>
<?php

        } // foreach

        if (sizeof($groupList) == 0) {

?>
            <tr>
                <td colspan="3">
                    No group found
                </td>
            </tr>
<?php

        } // if

?>
            <tr>
                <td class="input_field" colspan="2">
                    <select name="id">
                        <option value="" disabled selected>Select group</option>
<?php
        // available grous list
        $groupList = \Models\PeopleInGroup::getGroupList($data['id']);

        foreach ($groupList as $value) {

?>
                        <option value="<?=$value['id']?>"
                                       <?=($value['deleted'] ? ' disabled' : '')?>>
                                       <?=($value['deleted'] ? '(deleted) ' : '')?>
                                       <?=$value['name'].' - '.$value['course_name']?>
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

<script src="<?=SCR?>input_style.js" type="text/javascript"></script>

