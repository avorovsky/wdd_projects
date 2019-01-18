<h1>User ID <?=$data['id']?></h1>
<pre>
<?php var_dump($data) ?>      
</pre>
<a href="/users/list">Goto list</a>
<a href="/users/edit/<?=$data['id']?>">Edit</a>
<hr>   
