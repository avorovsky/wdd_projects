<h1>Users list</h1>
<hr>
<a href="/users/new">New user</a>
<hr>
<?php
    foreach ($data as $key => $value) {
?>
<pre>
<?php var_dump($value) ?>      
</pre>
<a href="/users/show/<?=$value['id']?>">Goto</a>
<hr>   
<?php } // endforeach ?>
