<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of Book
 */

    // in-page actions
    if (isset($_POST['add'])) {
        $result = \Models\BookForCourse::addConnection($data['id'], $_POST['id']);
        // set message
        $message = new \Components\Message('Recommendation added', 'success');
    } elseif (isset($_POST['del'])) {
        $result = \Models\BookForCourse::delConnection($data['id'], $_POST['del']);
        // set message
        $message = new \Components\Message('Recommendation deleted', 'success');
    }

    // flash message
    $message = new \Components\Message();
    echo $message->getMessage();

?>
<form action="/book/save" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
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
        <legend>Book</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="name">Title:</label>
            <input type="text" name="name" placeholder="book title" value="<?=$data['name']?>" />
        </p>
        <p>
            <label for="name">Author:</label>
            <input type="text" name="author" placeholder="book's author(s)" value="<?=$data['author']?>" />
        </p>
        <p>
            <label for="name">Publisher:</label>
            <input type="text" name="publisher" placeholder="publisher" value="<?=$data['publisher']?>" />
        </p>
        <p>
            <label for="name">Published on:</label>
            <input type="date" name="date" value="<?=$data['date']?>" />
        </p>
        <p>
            <label for="name">ISBN:</label>
            <input type="text" name="isbn" placeholder="ISBN code" value="<?=$data['isbn']?>" />
        </p>
        <p>
            <label for="price">Price:</label>
            <input type="number" name="price" placeholder="price" value=<?=$data['price']?> />
        </p>
    </fieldset>
    <fieldset class="select_image">
        <legend>Image</legend>
<?php

    if (!empty($_SESSION['is_admin'])) {

?>
        <div class="select_image">
	    <input id="img_select" class="select_image" type="file" name="image" />
	    <div class="select_image_fake">
		<input id="img_select_fake" class="select_image_fake" placeholder="select image file" />
                <span>&#x1F4C2;</span>
	    </div>
            <p class="select_image">
                <strong>Note:</strong> only PNG, JPEG, and GIF images are accepted;
                any image will be resized to 200 pixels hight with aspect ratio kept
            </p>
        </div>
<?php

    } // if

?>
        <div class="select_image">
            <img src="<?=\Components\ImgBlob::blobToSrc($data['image_mime'], $data['image'])?>"
                 alt="<?=$data['name']?>"
                 title="<?=$data['name']?>" />
        </div>
    </fieldset>
    <fieldset>
        <legend>Description</legend>
        <p>
            <textarea name="description" placeholder="Book description"><?=$data['description']?></textarea>
        </p>
    </fieldset>
</form>
<?php

    if (!empty($_SESSION['is_admin']) && !empty($data['id'])) {

?>
<form action="/book/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
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
<form action="/book/<?=$data['id']?>" method="post" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <table>
        <thead>
            <tr>
                <th colspan="3">
                    Recommended for courses
                </th>
            </tr>
        </thead>
        <tbody>
<?php

        $courseList = \Models\BookForCourse::getCourseForBook($data['id']);

        foreach ($courseList as $value) {

            $strikeout_deleted = ($value['deleted'] ? ' class="deleted"' : '');

?>
            <tr<?=$strikeout_deleted?>>
                <td><?=$value['name']?></td>
                <td class="control_button">
                    <button class="del" type="submit" name="del" value="<?=$value['id']?>">Del</button>
                </td>
            </tr>
<?php

        } // foreach

        if (sizeof($courseList) == 0) {

?>
            <tr>
                <td colspan="3">
                    No course associated
                </td>
            </tr>
<?php

        } // if

?>
            <tr>
                <td class="input_field">
                    <select name="id">
                        <option value="" disabled selected>Select course</option>
<?php
        // available courses list
        $courseList = \Models\BookForCourse::getCourseList($data['id']);

        foreach ($courseList as $value) {

?>
                        <option value="<?=$value['id']?>"
                                       <?=($value['deleted'] ? ' disabled' : '')?>>
                                       <?=($value['deleted'] ? '(deleted) ' : '')?>
                                       <?=$value['name']?>
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
