<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list view of Event
 */

    $dater = new \Components\Dater();
    $post_route = '/event/'.(empty($_SESSION['username']) || $_SESSION['is_admin'] ? 'list' : 'my');
   
?>
<div class="toolbox">
    <div class="filter_tool">
        <form action="<?=$post_route?>" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="date_from" value="<?=$dater->getToday()?>" />
            <input type="hidden" name="date_to" value="<?=$dater->getToday()?>" />
            <button class="filter" type="submit">Today</button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="<?=$post_route?>" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="date_from" value="<?=$dater->getWeekStart()?>" />
            <input type="hidden" name="date_to" value="<?=$dater->getWeekEnd()?>" />
            <button class="filter" type="submit">Week</button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="<?=$post_route?>" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="date_from" value="<?=$dater->getMonthStart()?>" />
            <input type="hidden" name="date_to" value="<?=$dater->getMonthEnd()?>" />
            <button class="filter" type="submit">Month</button>
        </form>
    </div>
    <div class="filter_tool">
        <form action="<?=$post_route?>" method="post" accept-charset="UTF-8">
            <?=\Components\Token::getToken();?>
            <input type="hidden" name="date_from" value="2000-01-01" />
            <input type="hidden" name="date_to" value="2099-12-31" />
            <button class="filter" type="submit">All</button>
        </form>
    </div>
<?php

    if (!empty($_SESSION['is_admin'])) {
        
?>
    <div class="action_tool">
        <form action="/event/new" method="post" accept-charset="UTF-8">
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
                <th>Time</th>
                <th>Room</th>
                <th>Group</th>
                <th>Title</th>
                <th>Instructor</th>
            </tr>
        </thead>
        <tbody>
<?php

    $currentDate = '';
    
    foreach ($data as $key => $eventItem) {
        
        $highlight_today = ($eventItem['date'] == $dater->getToday() ? ' class="today"' : '');
        $strikeout_deleted = ($eventItem['deleted'] ? ' class="deleted"' : '');

        if ($currentDate !== $eventItem['date']) {
            $currentDate = $eventItem['date'];
?>
            <tr>
                <td<?=$highlight_today?> colspan="5"><span><?=$eventItem['weekday']?></span>&nbsp;<?=$eventItem['date_string']?></td>
            </tr>
<?php

        } // if

?>
            <tr<?=$strikeout_deleted?>>
                <td><?=$eventItem['time_from'].' - '.$eventItem['time_to']?></td>
                <td><?=$eventItem['room']?></td>
                <td><?=$eventItem['group_name']?></td>
                <td class="open"><a href="/event/<?=$eventItem['id']?>" title="Open <?=$eventItem['name']?>"><?=$eventItem['name']?></a></td>
                <td><?=$eventItem['last_name'].', '.$eventItem['first_name']?></td>
            </tr>
<?php

    } // foreach
      
    if (sizeof($data) == 0) {
        
?>
            <tr>
                <td colspan="5">
                    No events found
                </td>
            </tr>
<?php

    } // if

?>

        </tbody>
    </table>
</div>