<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of Book
 */

    if (!empty($_SESSION['is_admin'])) {

?>
    <div class="action_tool">
        <form action="/book/new" method="post" accept-charset="UTF-8">
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
            <th colspan="2">Books recommended</th>
        </tr>
    </thead>
    <tbody>

<?php

    foreach ($data as $key => $bookItem) {

        $strikeout_deleted = ($bookItem['deleted'] ? ' class="deleted"' : '');

?>

        <tr<?=$strikeout_deleted?>>
            <td rowspan="4" class="image">
                <img src="<?=\Components\ImgBlob::blobToSrc($bookItem['image_mime'], $bookItem['image'])?>"
                     alt="<?=$bookItem['name']?>"
                     title="<?=$bookItem['name']?>" />
            </td>
            <td class="open" colspan="1">
                <a href="/book/<?=$bookItem['id']?>" title="Open <?=$bookItem['name']?> by <?=$bookItem['author']?>">
                    <?=$bookItem['name']?> <small><em>by <?=$bookItem['author']?></em></small>
                </a>
            </td>
        </tr>
        <tr<?=$strikeout_deleted?>>
            <td class="small">
                Published by <?=$bookItem['publisher']?>
                on <?= date_format(date_create($bookItem['date']),"F d, Y")?>
            </td>
        </tr>
        <tr<?=$strikeout_deleted?>>
            <td class="price">Price: $<?=$bookItem['price']?></td>
        </tr>
        <tr<?=$strikeout_deleted?>>
            <td class="text"><?=$bookItem['description']?></td>
        </tr>

<?php

    } // foreach

    if (sizeof($data) == 0) {

?>
        <tr>
            <td colspan="3">
                No books found
            </td>
        </tr>
<?php

    } // if

?>

    </tbody>
</table>