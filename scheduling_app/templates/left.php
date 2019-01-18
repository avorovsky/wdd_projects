<?php

    $sections = include(APP.'config'.DS.'sections.php');

?>

<div id="left">
    <ul>

<?php foreach ($sections as $section => $sectionName) {
    
    $cur_section = stristr($section, '/', true);
    // for static pages section needed full path
    $cur_section = ($cur_section == 'pages' ? $section : $cur_section);
    $cur_section = (empty($cur_section) ? $section : $cur_section);
    // second condition is for static pages section
    $cur_section = (stristr($view, '/', true) == $cur_section ? ' class="urhere"' : ($view == $cur_section ? ' class="urhere"' : ''));
    // items in cart
    if ($section == 'cart') {
        $sectionName .= ' ('.\Models\Cart::itemCount().')';
    }
    
?>
        <li><a href="/<?=$section?>" title="<?=$sectionName?>"<?=$cur_section?>><?=$sectionName?></a></li>
<?php

    } // foreach
    
?> 

    </ul>
</div> <!-- /left -->
<div id="right">

