<?php

/*
 * E-commerce
 * @Form for users
 * @Yongxin Mao <maoyongxin115@outlook.com>
 * @created_at 2018-11-27
 */

use \Components\Validator;
use \Components\Token;
use \Components\ImgToFile;

$token=new Token();
$v=new Validator();
$countries=\Models\Country::getList();
$image_upload=new ImgToFile();
//var_dump($countries);
if(file_exists(CFG.'provTax.php')){
  $params = include(CFG.'provTax.php');
}else{
  die;
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
    $v->required('username');
    $v->checkLength('username',2,30);
    $v->validateEmail('email');
    $v->required('first_name');
    $v->checkLength('first_name',2,15);
    $v->checkString1('first_name');
    $v->required('last_name');
    $v->checkLength('last_name',2,15);
    $v->checkString1('last_name');
    $v->required('address');
    $v->required('city');
    $v->required('postal_code');
    $v->checkPostal('postal_code');
    $v->required('province');
    $v->required('country');
    $v->required('phone');
    $v->checkTelephone('phone');
    $v->required('password');
    $v->checkPassword('password');
    $v->checkLength('password',6,20);
    $v->passwordMatch('password', 'password_confirm');

    if((!empty($_FILES['image_fake']))&&(!empty($_POST['image']))){
      $img_name=$image_upload->uploadImgtoFile($_FILES['image_fake'], 'users', 500, 500);
      $_POST['image']=$img_name;
      //var_dump($img_name);
    }

    //var_dump($img_name);
    //var_dump($_POST);
    //die;

    $errors=$v->errors();

  //if no errors
  if(count($errors)==0){
      $_SESSION['user_data']=$_POST;
      $success=true;
      header('Location: /users/save');
    }else{
      $success=false;
      //die('There is a problem inserting the record');
    }
    //end if
  }//end test for post

//var_dump($data);

//var_dump($fields);
//var_dump($_POST);
?>
  <div class="page-heading">
    <div class="page-title">
        <h2>Registration</h2>
    </div>
  </div>

  <?php if(empty($success)): ?>
      <form method="post"
            action="/users/new"
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
          <legend style="font-weight: bold;">User Info</legend>

          <div class="form-group">
            <label for="username" class="col-md-4 control-label">User Name</label>
            <div class="col-md-4">
            <input type="text"
                   id="username"
                   name="username"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['username'])){
                       echo esc_attr($data['username']);
                     }else{echo esc_attr($_POST['username']);}?>"/>
          <?php if(!empty($errors['username'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['username'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email</label>
            <div class="col-md-4">
            <input type="text"
                   id="email"
                   name="email"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['email'])){
                       echo esc_attr($data['email']);
                     }else{echo esc_attr($_POST['email']);}?>"/>
          <?php if(!empty($errors['email'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['email'][0])))?>
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
       <img src="/public/images/users/<?=$data['image']?>" alt="<?=$data['image']?>" width="80" height="80" style="margin-top: 18px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
     </div>
   </div>



          <div class="form-group">
            <label for="first_name" class="col-md-4 control-label">First Name</label>
            <div class="col-md-4">
            <input type="text"
                   id="first_name"
                   name="first_name"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['first_name'])){
                       echo esc_attr($data['first_name']);
                     }else{echo esc_attr($_POST['first_name']);}?>"/>
          <?php if(!empty($errors['first_name'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['first_name'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="last_name" class="col-md-4 control-label">Last Name</label>
            <div class="col-md-4">
            <input type="text"
                   id="last_name"
                   name="last_name"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['last_name'])){
                       echo esc_attr($data['last_name']);
                     }else{echo esc_attr($_POST['last_name']);}?>"/>
          <?php if(!empty($errors['last_name'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['last_name'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="address" class="col-md-4 control-label">Address</label>
            <div class="col-md-4">
            <input type="text"
                   id="address"
                   name="address"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['address'])){
                       echo esc_attr($data['address']);
                     }else{echo esc_attr($_POST['address']);}?>"/>
          <?php if(!empty($errors['address'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['address'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="city" class="col-md-4 control-label">City</label>
            <div class="col-md-4">
            <input type="text"
                   id="city"
                   name="city"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['city'])){
                       echo esc_attr($data['city']);
                     }else{echo esc_attr($_POST['city']);}?>"/>
          <?php if(!empty($errors['city'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['city'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="postal_code" class="col-md-4 control-label">Postal Code</label>
            <div class="col-md-4">
            <input type="text"
                   id="postal_code"
                   name="postal_code"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['postal_code'])){
                       echo esc_attr($data['postal_code']);
                     }else{echo esc_attr($_POST['postal_code']);}?>"/>
          <?php if(!empty($errors['postal_code'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['postal_code'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="province" class="col-md-4 control-label">Province</label>
            <div class="col-md-4">
              <select id="province" name="province" class="form-control">
              <?php foreach($params as $key=>$value):?>
                <option value="<?=$key?>" <?php if(strtolower($key)==strtolower($data['province'])) :?> selected <?php endif;?>><?=ucfirst($key);?></option>
              <?php endforeach;?>
              </select>
              </div>
          </div>

          <div class="form-group">
            <label for="country" class="col-md-4 control-label">Country</label>
            <div class="col-md-4">
              <select id="country" name="country" class="form-control">
              <?php foreach($countries as $country):?>
                <option value="<?=$country['id']?>" <?php if(strtolower($country['id'])==strtolower($data['country'])) :?> selected <?php endif;?>><?=$country['country_name']?></option>
              <?php endforeach;?>
              </select>
              </div>
          </div>

         <div class="form-group">
            <label for="phone" class="col-md-4 control-label">Telephone</label>
            <div class="col-md-4">
            <input type="text"
                   id="phone"
                   name="phone"
                   class="form-control input-md"
                   value="<?php if(!isset($_POST['phone'])){
                       echo esc_attr($data['phone']);
                     }else{echo esc_attr($_POST['phone']);}?>"/>
          <?php if(!empty($errors['phone'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              <?=ucfirst(str_replace('_',' ',esc($errors['phone'][0])))?>
              </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password</label>
            <div class="col-md-4">
            <input type="password"
                   name="password"
                   class="form-control input-md"
                   id="password"
                   style="margin-left: 0px;"
                   placeholder="At least 6 characters long..."/>
          <?php if(!empty($errors['password'])):?>
          <div class="alert alert-danger fade in" style="height: 35px; margin-top: 5px; padding-top: 5px; margin-bottom: 0px; border-radius: 0 0;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?=ucfirst(str_replace('_',' ',esc($errors['password'][0])))?>
          </div>
          <?php endif; ?>
          </div>
          </div>

          <div class="form-group">
            <label for="password_confirm" class="col-md-4 control-label">Password Confirmation</label>
            <div class="col-md-4">
            <input type="password"
                   name="password_confirm"
                   class="form-control input-md"
                   id="password_confirm"
                   style="margin-left: 0px;"
                   placeholder="Be same with above..."/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-8">
            <input type="submit"
                   value="Register"
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
