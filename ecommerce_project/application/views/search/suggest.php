<?php

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

        $value['suggestion'] = str_replace(array("\r\n", "\n", "\r"), '', $value['suggestion']); // remove end of lines
        $value['suggestion'] = str_replace("'", '', $value['suggestion']); // remove quotes for JS-value
        $value['suggestion'] = str_replace('"', '', $value['suggestion']); // remove double-quotes for JS-value
        $value['suggestion'] = str_replace('?', '', $value['suggestion']); // remove question mark for JS-value
        //$value['suggestion'] = preg_replace("/[^ \w]+/", "", $value['suggestion']); // I gave up: remove everything except letter and numbers

?>
    <li onclick="fillField('<?=$value['suggestion']?>')">
        <?=stripslashes(preg_replace("/($search_field)/i", "<span class='highlight'>$1</span>", $value['suggestion']))?>
    </li>
<?php

    } // foreach

?>
</ul>

