<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of People
 */

    // reusable images/icons
    // img-version
    // $imgNotVerified = '<img src="'.IMG.'ico_not_verified.png" alt="Not verified" title="Not verified" width="25" height="25" />';
    // $imgStudent = '<img src="'.IMG.'ico_student.png" alt="Student" title="Student" width="25" height="25" />';
    // $imgInstructor = '<img src="'.IMG.'ico_instructor.png" alt="Instructor" title="Instructor" width="25" height="25" />';
    // $imgAdmin = '<img src="'.IMG.'ico_admin.png" alt="Administrator" title="Administrator" width="25" height="25" />';
    // emoji-version
    $imgNotVerified = '&nbsp;&#x1F608';
    $imgStudent = '&nbsp;&#x1F468&zwj;&#x1F393';
    $imgInstructor = '&nbsp;&#x1F468‍&zwj;&#x1F3EB';
    $imgAdmin = '&nbsp;&#x1F47B';
    
?>
<div class="toolbox">
    <div class="filter_tool">
        <form action="/people/list" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="role" value="v" />
            <button class="filter" type="submit">Not verified<?=$imgNotVerified?></button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="/people/list" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="role" value="i" />
            <button class="filter" type="submit">Instructors<?=$imgInstructor?></button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="/people/list" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="role" value="s" />
            <button class="filter" type="submit">Students<?=$imgStudent?></button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="/people/list" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="role" value="a" />
            <button class="filter" type="submit">Admins<?=$imgAdmin?></button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="/people/list" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <button class="filter" type="submit">All</button>
        </form>
    </div>
<?php

    if (!empty($_SESSION['is_admin'])) {
        
?>
    <div class="action_tool">
        <form action="/people/new" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <button type="submit">New</button>
        </form>
    </div>
<?php

    } // if

?>
</div>
<div class="scrollable">
    <table>
        <thead>
            <tr>
                <th>&#128248;</th>
                <th>Full name</th>
                <th>Status</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
<?php

    foreach ($data as $key => $peopleItem) {

        $strikeout_deleted = ($peopleItem['deleted'] ? ' class="deleted"' : '');

?>
            <tr<?=$strikeout_deleted?>>
                <td class="image">
                    <img src="<?=\Components\ImgBlob::blobToSrc($peopleItem['image_mime'], $peopleItem['image'])?>"
                         alt="<?=$peopleItem['username']?>"
                         title="<?=$peopleItem['username']?>"
                         width="36" height="36" /></td>
                <td class="open">
                    <a href="/people/<?=$peopleItem['id']?>" 
                       title="Open <?=$peopleItem['last_name'].', '.$peopleItem['first_name']?>">
                        <?=$peopleItem['last_name'].', '.$peopleItem['first_name']?>
                    </a>
                </td>
                <td class="icons">
<?php
    if ($peopleItem['not_verified']) {
        echo $imgNotVerified;
    } else {              
        if ($peopleItem['is_student']) {
            echo $imgStudent;
        }
        if ($peopleItem['is_instructor']) {
            echo $imgInstructor;
        }
        if ($peopleItem['is_admin']) {
            echo $imgAdmin;
        }
    }
?>
                </td>
                <td><?=$peopleItem['phone']?></td>
                <td><?=$peopleItem['email']?></td>
                <td><?=$peopleItem['username']?></td>
            </tr>
<?php

    } // foreach
      
    if (sizeof($data) == 0) {
        
?>
            <tr>
                <td colspan="5">
                    No people found
                </td>
            </tr>
<?php

    } // if

?>
        </tbody>
    </table>
</div>