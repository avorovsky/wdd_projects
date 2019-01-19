<?php 

/*
 * E-commerce
 * @Form for news editing
 * @Yongxin Mao <maoyongxin115@outlook.com>
 * @created_at 2018-12-1
 */

use \Components\Validator;
use \Components\Token;
use \Components\ImgToFile;

$token=new Token();
$v=new Validator();
$image_upload=new ImgToFile();

//var_dump($data);

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
    $v->required('title');
    $v->required('body');
    //$v->required('image');

    if((!empty($_FILES['image_fake']))&&(!empty($_POST['image']))){
      $img_name=$image_upload->uploadImgtoFile($_FILES['image_fake'], 'news', 500, 500);
      $_POST['image']=$img_name;
      //var_dump($img_name);
      //die;
    }

    
    $errors=$v->errors();
    
  //if no errors
  if(count($errors)==0){
      $_SESSION['news_data']=$_POST;
      //var_dump($_SESSION['news_data']);
      //die;
      $success=true;
      header('Location: /news/save');
    }else{
      $success=false;
      //die('There is a problem inserting the record');
    }
    //end if
  }//end test for post

//var_dump($fields);
//var_dump($_POST);
?>
<div class="page-heading">
    <div class="page-title">
        <h2>News Page</h2>
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
            <legend style="font-weight: bold;">News Info</legend>
            <div class="form-group">
              <label for="title" class="col-md-4 control-label">Title</label>
              <div class="col-md-4">
              <input type="text"
                     id="title" 
                     name="title"
                     class="form-control input-md"
                     value="<?php if(!isset($_POST['title'])){
                         echo esc_attr($data['title']);
                       }else{echo esc_attr($_POST['title']);}?>"/>
            <?php if(!empty($errors['title'])):?>
            <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['title'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>

            <div class="form-group">
              <label for="body" class="col-md-4 control-label">Body</label>
              <div class="col-md-4">
              <textarea name="body"
                     id="body"
                     class="form-control"
                     rows="12"><?php if(!isset($_POST['body'])){
                         echo esc_attr(clean_str($data['body']));
                       }else{echo esc_attr(clean_str($_POST['body']));}?></textarea>
            <?php if(!empty($errors['body'])):?>
            <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?=ucfirst(str_replace('_',' ',esc($errors['body'][0])))?>
                </div>
            <?php endif; ?>
            </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="image">Images</label>
              <div class="col-md-4">
              <input type="file"
                     class="input-file"
                     name="image_fake"
                     id="image_fake"
                     style="position: relative; margin-top: 0px;height: 30px;z-index: 200;border: 1px solid #333;filter:alpha(opacity: 0);
    opacity: 0;"/>
         <div class="select_image_fake" style="position: absolute;border: 0px solid #333; width: 200px; height: 35px; top: 0px;z-index: 100;">
        <input id="image" name="image" class="form-control input-md" placeholder="Upload image here..." value="<?php if(!isset($_POST['image'])){
                         echo esc_attr($data['image']);
                       }else{echo esc_attr($_POST['image']);}?>"/>
                    <span style="margin-left: 10px; position: absolute;top: 5px;left: 200px;">&#x1F4C2;</span>
          
         </div>
         <img src="/public/images/news/<?=$data['image']?>" alt="<?=$data['image']?>" width="300" height="200" style="margin-top: 18px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
       </div>
     </div>

          <div class="form-group">
              <label class="col-md-4 control-label"></label>
              <div class="col-md-8">
              <input type="submit" 
                     value="Save"
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
    document.getElementById("image_fake").addEventListener("input", function(){
    document.getElementById("image").value = document.getElementById("image_fake").value;
    document.getElementById("image").value =document.getElementById("image").value.replace("C:\\fakepath\\", "");
    });
    //document.getElementById("image").addEventListener('change',function(){
      //    document.getElementById("image_thumbnail").innerHTML+="image ";
        //});
  }
  </script>