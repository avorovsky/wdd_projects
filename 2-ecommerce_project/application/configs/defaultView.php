<?php

/**
 * returns default string view for entities
 *
 * @return array - default html-views of entities
 */

return array(
    'products' => 'CONCAT(`products`.`name`, " <em><small>$", `products`.`price`, "</small></em>")',
    'news' => 'CONCAT(`news`.`title`, DATE_FORMAT(`news`.`created_at`, "%a %M %e, %Y @ %l:%i%p"), " &#9830; ")',
    'categories' => '`categories`.`name`',
);

