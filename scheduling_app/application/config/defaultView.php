<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * returns default string view for entities
 *
 * @return array - default html-views of entities
 */

return array(
    'book' => 'CONCAT(`book`.`name`, " <em><small>by ", `book`.`author`, "</small></em>")',
    'course' => '`course`.`name`',
    'event' => 'CONCAT(DATE_FORMAT(`event`.`datetime_from`, "%a %M %e, %Y @ %l:%i%p"), " &#9830; ", `event`.`name`)',
    'group' => 'CONCAT(`group`.`name`)',
    'people' => 'CONCAT(`people`.`last_name`, ", ", `people`.`first_name`)',
    'room' => '`room`.`number`',
);

