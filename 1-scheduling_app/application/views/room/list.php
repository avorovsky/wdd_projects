<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of Room
 */

?>
<div class="toolbox">
    <div class="action_tool">
        <form action="/room/new" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <button type="submit">New</button>
        </form>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th>Room #</th>
            <th>Description</th>
            <th>Capacity</th>
        </tr>
    </thead>
    <tbody>
        
<?php

    foreach ($data as $key => $roomItem) {
        
        $strikeout_deleted = ($roomItem['deleted'] ? ' class="deleted"' : '');

?>

        <tr<?=$strikeout_deleted?>>
            <td class="open"><a href="/room/<?=$roomItem['id']?>" title="Open <?=$roomItem['number']?>"><?=$roomItem['number']?></a></td>
            <td><?=$roomItem['description']?></td>
            <td><?=$roomItem['capacity']?></td>
        </tr>

<?php

    } // foreach
      
    if (sizeof($data) == 0) {
        
?>
        <tr>
            <td colspan="3">
                No rooms found
            </td>
        </tr>
<?php

    } // if

?>
        
    </tbody>
</table>