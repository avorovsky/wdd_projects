<?php

/**
 * returns list of tables and fields for search, depending on role
 *
 * @return array - searchable fields
 */

return array(
    array ('table' => 'products', 'field' => 'name'),
    array ('table' => 'products', 'field' => 'description'),
    array ('table' => 'news', 'field' => 'title'),
    array ('table' => 'news', 'field' => 'body'),
    array ('table' => 'categories', 'field' => 'name'),
    );
