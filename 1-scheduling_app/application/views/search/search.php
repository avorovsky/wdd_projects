<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * search form
 */

    if (!empty($_SESSION['username'])) {

?>
<form action="/search/result" method="post" autocomplete="off" accept-charset="UTF-8">
    <?=\Components\Token::getToken();?>
    <input id="search_field"
           name="search_field"
           type="search"
           placeholder="Search for something..." />
    <button id="search_button" type="submit"></button>
</form>
<div id="search_suggest">
</div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- custom script -->
<script src="<?=SCR?>search_suggest.js"></script>
<?php

    } // if

?>


