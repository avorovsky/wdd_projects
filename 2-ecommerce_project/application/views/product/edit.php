<?php

/*
 * E-commerce
 * @Form for products
 * @Yongxin Mao <maoyongxin115@outlook.com>
 * @created_at 2018-11-23
 */

use \Components\Validator;
use \Components\Token;
use \Components\ImgToFile;

$token=new Token();
$v=new Validator();
$image_upload=new ImgToFile();

$category=\Models\Category::getById($data['category_id']);
$categories=\Models\Category::getList();
$images=\Models\Image::getListByColumn('product_id',$data['id']);
if(empty($category)){
	$category=array('name'=>'');
}

//create the function that can escape the output
function esc($string)
{
  return htmlspecialchars($string, NULL, 'UTF-8', false);
}
//create the function that can escape the output in quotes
function esc_attr($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);
}
//create the function that can clean html tags of string
function clean_str($string)
{
  return strip_tags($string);
}

//test fot post request
if($_SERVER['REQUEST_METHOD']=='POST'){
    $errors=[];

    //required fields checking
    $v->required('sku');
    $v->required('name');
    $v->required('price');
    $v->checkNumber('price');
    $v->required('description');
    //$v->required('image');
    //var_dump($_POST['image_fake']);
    //die;
    if(!empty($_FILES['image'])&&!empty($_POST['image_fake'])){
    	$img_name=$image_upload->uploadImgtoFile($_FILES['image'], 'products', 600, 600);
    }

    
    //var_dump($_POST);
    //die;
    $errors=$v->errors();

  //if no errors
  if(count($errors)==0){
  	  $pics=array();
  	  $_SESSION['product_data']=$_POST;
  	  //var_dump($_SESSION['product_data']);
  	  //die;
  	  if(isset($_POST['image'])){
  	  $imgs=$_POST['image'];
  	  foreach ($imgs as $key => $value) {
  	  	$imgs[$key]=['image'=>$value,'deleted'=>1];
  	  }
  	}
  	  //var_dump($imgs);
  	  //die;

  	  if(!empty($_POST['image_fake'])){
  	  $_SESSION['product_images']= array(
		  array('image'=>$img_name, 'deleted'=>'')
		);
      }
      if(!empty($_POST['image'])&&empty($_POST['image_fake'])){
        $_SESSION['product_images']=$imgs;
      }
      if(!empty($_POST['image'])&&!empty($_POST['image_fake'])){
      	$_SESSION['product_images']+=$imgs;
      }
      $success=true;
      header('Location: /products/save');
    }else{
      $success=false;

      //die('There is a problem inserting the record');
    }
    //end if
  }//end test for post

//var_dump($fields);
//var_dump($_POST);
//var_dump($category->getById());
//var_dump($categories);
//var_dump($category['name']);
//var_dump($data);
?>
<div class="page-heading">
    <div class="page-title">
        <h2>Product Page</h2>
    </div>
</div>
    <?php if(empty($success)): ?>
        <form method="post"
              action=""
              accept-charset="utf-8"
              autocomplete="on"
              novalidate
              class="form-horizontal"
              enctype="multipart/form-data"
              style="margin-top: 30px;">
          <?php echo($token->getToken());?>
          <input type="hidden"
                 name="id"
                 value="<?php if(!isset($_POST['id'])){
		                   echo esc_attr($data['id']);
		                 }else{echo esc_attr($_POST['id']);}?>"/>
          <fieldset>
            <legend style="font-weight: bold;">Product Info</legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="categories">Category</label>
                <div class="col-md-4">
                <select id="categories" name="category_id" class="form-control">
                <?php foreach($categories as $cate):?>
                  <option value="<?=$cate['id']?>" <?php if($category['name']==$cate['name']) :?> selected <?php endif;?>><?=ucfirst($cate['name'])?></option>
                <?php endforeach;?>
                </select>
                </div>
            </div>

            <div class="form-group">
              <label for="sku" class="col-md-4 control-label">SKU</label>
              <div class="col-md-4">
              <input type="text"
                     id="sku"
                     name="sku"
                     class="form-control input-md"
                     value="<?php if(!isset($_POST['sku'])){
			                   echo esc_attr($data['sku']);
			                 }else{echo esc_attr($_POST['sku']);}?>"/>
            <?php if(!empty($errors['sku'])):?>
            	<div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['sku'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Product</label>
              <div class="col-md-4">
              <input type="text"
                     id="name"
                     name="name"
                     class="form-control input-md"
                     value="<?php if(!isset($_POST['name'])){
			                   echo esc_attr($data['name']);
			                 }else{echo esc_attr($_POST['name']);}?>"/>
            <?php if(!empty($errors['name'])):?>
            <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['name'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>

            <div class="form-group">
              <label for="price" class="col-md-4 control-label">Price</label>
              <div class="col-md-4">
              <input type="text"
                     id="price"
                     name="price"
                     class="form-control input-md"
                     value="<?php if(!isset($_POST['price'])){
			                   echo esc_attr($data['price']);
			                 }else{echo esc_attr($_POST['price']);}?>"/>
            <?php if(!empty($errors['price'])):?>
            <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['price'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>

            <div class="form-group">
              <label for="description" class="col-md-4 control-label">Description</label>
              <div class="col-md-4">
              <textarea name="description"
                     id="description"
                     class="form-control"
                     rows="10"><?php if(!isset($_POST['description'])){
			                   echo esc_attr(clean_str($data['description']));
			                 }else{echo esc_attr(clean_str($_POST['description']));}?></textarea>
            <?php if(!empty($errors['description'])):?>
            <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['description'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>


            <div class="form-group">
              <label class="col-md-4 control-label" for="image">Images</label>
              <div class="col-md-4">
              <input type="file"
                     class="input-file"
                     name="image"
                     id="image"
                     style="position: relative; margin-top: 0px;height: 30px;z-index: 200;border: 1px solid #333;filter:alpha(opacity: 0);
    opacity: 0;"/>
			   <div class="select_image_fake" style="position: absolute;border: 0px solid #333; width: 200px; height: 35px; top: 0px;z-index: 100;">
				<input id="image_fake" name="image_fake" class="form-control input-md" placeholder="Upload image here..."/>
		                <span style="margin-left: 10px; position: absolute;top: 5px;left: 200px;">&#x1F4C2;</span>
			   </div>

            </div>
          
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"></label>
              <?php if(!empty($data['id'])): ?>
              <div class="col-md-4">
              	<small>Select checkbox to delete images.</small>
              	<div class="col-md-12 ft-img" style="border: 1px solid #ccc;">
	            	<?php foreach ($images as $key=>$image):?>
	            	  <div class="image_thumbnail" style="padding: 10px; float: left; margin: 5px 0px;">
		            	  <img class="small-image" src="<?=$image['image']?>" alt="<?=$image['image']?>" width="77" height="60" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
		            	  <input type="checkbox" name="image['<?=$key?>']" value="<?=basename($image['image'])?>">
	            	  </div>

		            <?php endforeach;?>
	            </div>
              </div>
            <?php endif;?>
            </div>

           <div class="form-group">
              <label class="col-md-4 control-label"></label>
              <div class="col-md-8">
              <input type="submit"
                     value="Submit"
                     style="background: #8dc63f;"
                     class="btn btn-success"
                     />&nbsp;&nbsp;
              </div>
            </div><br/><br/>

           </fieldset>
        </form>
    <?php else: ?>
      <div style="width: 420px; margin: 0 auto;">
          <h1>Submit successfully!</h1>
          <p><b>You submitted the following information:</b></p>

          <?php foreach($_POST as $key=>$value): ?>
             <p><?=$key?>: <?=$value?></p>
          <?php endforeach; ?>
      </div>
  <?php endif; ?>
  <script>
	window.onload=function(){
	  	document.getElementById("image").addEventListener("input", function(){
	    document.getElementById("image_fake").value = document.getElementById("image").value;
	    document.getElementById("image_fake").value =document.getElementById("image_fake").value.replace("C:\\fakepath\\", "");
	    });

	}
  </script>
