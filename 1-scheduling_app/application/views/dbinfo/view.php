<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * detabase aggregated data view
 */

?>
<table>
    <thead>
        <tr>
            <th colspan="2">Aggregate data on database</th>
        </tr>
        <tr>
            <th>Data</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
<?php

    foreach ($data as $key => $value) {

?>

    <tr><td><?=$key?></td><td><?=$value?></td></tr>
    
<?php

    } // foreach

?>
    </tbody>
</table>