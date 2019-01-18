<?php

	//if request method is post 
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	    //if a search is submited 
		if(!empty($_GET['search'])){
			//query the database for the search term 
			$query = 'SELECT 
					 id,
					 name,
					 description,
					 sku,
					 price,
					 seller_id,
					 FROM 
					 products
					 WHERE 
					 name LIKE :search';

					 $params = [':search' => '%'.$_GET['search'].'%'];


			//prepare the query
		    $stmt = $dbh->prepare($query);

		    //bind values 
		    $stmt->bindValue(':search', $_GET['search'], PDO::PARAM_STR);

		    //execute
		    $stmt->execute($params);

		    //fetch data
		    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    echo '<ul>';
		    foreach ($products as $product) {
		    	echo '<li><a class="more" href="?page=detail&id='.$product['id'] . '">'. $product['name'] . '</a></li>';

		    }//end foreach
		    echo '</ul>';
		}//end if search 
	}//end if psot

?>