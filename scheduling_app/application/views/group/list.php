<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of Group
 */

?>
<div class="toolbox">
    <div class="action_tool">
        <form action="/group/new" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <button type="submit">New</button>
        </form>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Course</th>
        </tr>
    </thead>
    <tbody>
        
<?php
    
    foreach ($data as $key => $groupItem) { 
        
        $strikeout_deleted = ($groupItem['deleted'] ? ' class="deleted"' : '');

?>

        <tr<?=$strikeout_deleted?>>
            <td class="open"><a href="/group/<?=$groupItem['id']?>" title="Open <?=$groupItem['name']?>"><?=$groupItem['name']?></a></td>
            <td><?=$groupItem['course_name']?></td>
        </tr>

<?php

    } // foreach
      
    if (sizeof($data) == 0) {
        
?>
        <tr>
            <td colspan="2">
                No groups found
            </td>
        </tr>
<?php

    } // if

?>
        
    </tbody>
</table>
