<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of Course
 */

    if (!empty($_SESSION['is_admin'])) {
        
?>
    <div class="action_tool">
        <form action="/course/new" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <button type="submit">New</button>
        </form>
    </div>
<?php

    } // if

?>
<table>
    <thead>
        <tr>
            <th colspan="2">Our courses</th>
        </tr>
    </thead>
    <tbody>
        
<?php

    foreach ($data as $key => $courseItem) {
        
        $strikeout_deleted = ($courseItem['deleted'] ? ' class="deleted"' : '');

?>

        <tr<?=$strikeout_deleted?>>
            <td colspan="2" class="open"><a href="/course/<?=$courseItem['id']?>" title="Open <?=$courseItem['name']?>"><?=$courseItem['name']?></a></td>
        </tr>
        <tr<?=$strikeout_deleted?>>
            <td rowspan="2" class="image">
                <img src="<?=\Components\ImgBlob::blobToSrc($courseItem['image_mime'], $courseItem['image'])?>"
                     alt="<?=$courseItem['name']?>"
                     title="<?=$courseItem['name']?>" />
            </td>
            <td class="price">Tuition fee: $<?=$courseItem['price']?></td>
        </tr>
        <tr<?=$strikeout_deleted?>>
            <td class="text"><?=$courseItem['description']?></td>
        </tr>

<?php

    } // foreach
      
    if (sizeof($data) == 0) {
        
?>
        <tr>
            <td colspan="3">
                No courses found
            </td>
        </tr>
<?php

    } // if

?>
        
    </tbody>
</table>