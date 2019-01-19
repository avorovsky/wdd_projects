<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detailed view of Course
 */

?>
<form action="/course/save" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
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
        <legend>Course</legend>
        <input type="hidden" name="id" value="<?=$data['id']?>" />
        <p>
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="course name" value="<?=$data['name']?>" />
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
                any image will be resized to 200 pixels wide with aspect ratio kept
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
            <textarea name="description" placeholder="Course description"><?=$data['description']?></textarea>
        </p>
    </fieldset>
</form>
<?php

    if (!empty($_SESSION['is_admin']) && !empty($data['id'])) {

?>
<form action="/course/del/<?=$data['id']?>" method="post" accept-charset="UTF-8">
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
<table>
    <thead>
        <tr>
            <th>
                Recommended books
            </th>
        </tr>
    </thead>
<?php

        $bookList = \Models\BookForCourse::getBookForCourse($data['id']);

        if (sizeof($bookList) == 0) {

?>
    <tr>
        <td colspan="1">
            No book recommended
        </td>
    </tr>
<?php

        } // if

?>
</table>
<div class="store_front">
<?php

        foreach ($bookList as $value) {

            $strikeout_deleted = ($value['deleted'] ? ' class="deleted"' : '');

?>
            <div class="store_item">
                <a href="/book/<?=$value['id']?>" title="Details on '<?=$value['name']?>'">
                    <img src="<?=\Components\ImgBlob::blobToSrc($value['image_mime'], $value['image'])?>"
                         alt="<?=$value['name']?>"
                         title="Details on '<?=$value['name']?>'" />
                    <div class="store_name"><?=$value['name']?></div>
                </a>
                <span class="store_price">$<?=$value['price']?></span>
                <form action="/cart/add/<?=$value['id']?>" method="post" accept-charset="UTF-8">
                    <?=\Components\Token::getToken();?>
                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                    <button class="save" type="submit" name="buy">Add to cart&nbsp;&#x1f6d2;</button>
                </form>
            </div>
<?php

        } // foreach

?>
</div>
<br/>
<span class="db_data">Modified: <?=(!empty($data['modified']) ? $data['modified'] : 'N/A')?></span>
<span class="db_data">Created: <?=(!empty($data['created']) ? $data['created'] : 'N/A')?></span>
<span class="db_data">ID: <?=(!empty($data['id']) ? $data['id'] : 'N/A')?></span>

<script src="<?=SCR?>input_style.js" type="text/javascript"></script>
