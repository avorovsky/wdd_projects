<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * list of search suggestions (live search)
 */

    // sort array
    usort($suggestList,
        function($a, $b) {
        return strcmp($a['suggestion'], $b['suggestion']);
    });

    // limit result to X elements
    $suggestList = array_slice($suggestList, 0, 15);

?>
<ul>
<?php

    foreach($suggestList as $key => $value) {

        $value['suggestion'] = str_replace(PHP_EOL, '', $value['suggestion']); // remove end of lines
        $value['suggestion'] = str_replace("'", "\'", $value['suggestion']); // escape quotes for JS-value

?>
    <li onclick="fillField('<?=$value['suggestion']?>')">
        <?=stripslashes(preg_replace("/($search_field)/i", "<span class='highlight'>$1</span>", $value['suggestion']))?>
    </li>
<?php

    } // foreach

?>
</ul>

