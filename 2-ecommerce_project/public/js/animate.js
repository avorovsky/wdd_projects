  

 //global variables
var horiz_ball_pos = 0;
var vertic_ball_pos = 0;
var horiz_speed = 5;
var vertic_speed = 5;
var timer;
var alert;
var ball;
var paddle; 
var left_edge = window.innerWidth -55;
var bottom_edge = window.innerHeight -55;
var theScore;
var score = 0;
var game_over = false;
var button;


document.onmousemove = mve_paddle; 
function mve_paddle(event){
  var theEvent = event || window.event;
  horiz_mouse = theEvent.clientX;
  vertic_mouse = theEvent.clientY;

  if(vertic_mouse < (bottom_edge - 10)){
    paddle.style.top = vertic_mouse + "px";
  }
}

//when the browser is resized
window.on_resize = function(){
  left_edge = window.innerWidth -55;
  bottom_edge = window.innerHeight -55;  
}//end function on_resize

// when page is loaded 
window.onload = function(){
  // assign objects to divs
  ball = document.getElementById("dodo");
  theScore = document.getElementById("the_score");
  alert = document.getElementById("the_alert");
  button = document.getElementById('startgame');
  paddle = document.getElementById("paddle");
  
  //writting the score variable to the score div
  theScore.innerHTML = score;
  // Start animation
  document.getElementById("startgame").onclick=function(){
    clearTimeout(timer);
    //call move_obj function 
    move_obj();
  }
  
}//end onload function

//when mouse is moved 
function move_obj(){
  vertic_ball_pos += vertic_speed;
  horiz_ball_pos += horiz_speed;
  if(horiz_ball_pos > left_edge){
    horiz_speed = -horiz_speed;
  }//end if 
  if(horiz_ball_pos <= 0){
    score -=10;
    horiz_speed = -horiz_speed;
      theScore.innerHTML = score;
    }//end if 

  if(vertic_ball_pos > bottom_edge || vertic_ball_pos < 0){
    vertic_speed = -vertic_speed;
  }//end if 
  if(horiz_speed < 0){
    if(hitTest(ball,paddle)){
      score += 10;
      horiz_speed = -horiz_speed;
      horiz_speed += 1;
      theScore.innerHTML = score;
    }//end if 
  }//end function 

  //if player gets to 50 points or wins (both)
  if(score == 50){
    alert.style.marginRight = '20px';
    alert.style.opacity = '1';
    alert.style.width = '90%';
    alert.style.height = '300px';
    document.getElementById('body').style.backgroundColor = '#333';
    ball.style.opacity = '0';
    paddle.style.opacity = '0';
    button.style.opacity = '0';
    var beyond = 'BEYOND';
    alert.style.marginTop = '200px';
    alert.style.marginLeft = '10px';
    alert.innerHTML = 'Congradulations enjoy a one time deal with promo code:'+ '<br />' + beyond;
    horiz_speed = 0;
    vertic_speed = 0;
  }
  
  //the position of the ball or dodo 
  ball.style.top = vertic_ball_pos + "px";
  ball.style.left = horiz_ball_pos + "px";
  
  //if score less than or equal to 0
  if(score < 0){
    //end game 
    game_over = true;
  }
  //if player loses 
  if(!game_over){
     theScore.innerHTML = score;
    timer = setTimeout('move_obj();',10);
  }
  //if player loses 
  else{
    alert.innerHTML = "<b>Sorry you Lost you missed DODO too many times!</b>";
    alert.style.width = '90%';
    alert.style.height = '300px';
    alert.style.marginRight = '10px';
    alert.style.marginLeft = '10px';
    theScore.innerHTML = "0";
    alert.style.opacity = '1';
    alert.style.color = '#fff';
    alert.style.backgroundColor = '#f00';
    alert.style.marginRight = '40px';
    ball.style.opacity = '0';
    paddle.style.opacity = '0';
    button.style.opacity = '0';
    document.getElementById('body').style.backgroundColor = '#333';
  }//end else 
}//end if 




