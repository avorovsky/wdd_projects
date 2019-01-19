/////////////////////////////////////////
// Program:    Web Development 3       //
// Course:     Advanced JavaScript     //
// Assignment: #3                      //
// Instructor: Brent Scott             //
// Student:    Oleksandr Vorovskyi     //
// Date:       June 17, 2018           //
// File:       themaze.js              //
/////////////////////////////////////////

// global variables
var maze; // canvas itself
var ctx; // context
var monkey_x = 0; // character's x position
var monkey_y = 0; // character's y position
var speed_x = 0; // character's x speed
var speed_y = 0; // character's y speed
var game_is_on = false; // is game in process
var timer; // timer to run draw function
// maze images performed by http://www.mazegenerator.net/
var mazeSet = [];
mazeSet.push({maze: 'img/maze01.png', solution: 'img/maze01_sol.png'});
mazeSet.push({maze: 'img/maze02.png', solution: 'img/maze02_sol.png'});
mazeSet.push({maze: 'img/maze03.png', solution: 'img/maze03_sol.png'});
mazeSet.push({maze: 'img/maze04.png', solution: 'img/maze04_sol.png'});
mazeSet.push({maze: 'img/maze05.png', solution: 'img/maze05_sol.png'});
mazeSet.push({maze: 'img/maze06.png', solution: 'img/maze06_sol.png'});
mazeSet.push({maze: 'img/maze07.png', solution: 'img/maze07_sol.png'});
var mazeRnd; // current random maze

// --------------------------------------------------
window.onload = function(){

  maze = document.getElementById('maze');
  ctx = maze.getContext('2d');

  // choose maze to show
  newGameInit();
  
  // key handler
  window.onkeydown = downKey;

}; // onload

// --------------------------------------------------
function newGameInit(){
  
  // if game started
  if(game_is_on){
    // save result to localStorage
    saveResult(maze.toDataURL('image/png'),'Gave up');
  }

  // random number of maze between 0 and the last index of array
  mazeRnd = Math.floor(Math.random()*mazeSet.length);
  
  // show maze from picture
  // set character to the starting position
  showMaze(mazeSet[mazeRnd].maze, 170, 9);
  
  // set neutral solution image
  document.getElementById('sol_img').setAttribute('src', 'img/back_sol.png');
  // bring solution image back to initial div
  document.getElementById('solution').appendChild(document.getElementById('sol_img'));
  
  // set initial hint text
  document.getElementById('todrop').innerHTML = '<br /><br />Drag the image below and drop here to see the solution';

  // load localStorage;
  loadStorage();

} //newGameInit

// --------------------------------------------------
function showMaze(mazeImgSrc, start_x, start_y){

  // stop timer
  clearTimeout(timer);

  // stop character
  speed_x = 0;
  speed_y = 0;

  // load maze image
  var mazeImg = new Image();
  mazeImg.src = mazeImgSrc;

  mazeImg.onload = function(){
    // set canvas size according to inage sixe
    maze.width = mazeImg.width;
    maze.height = mazeImg.height;

    // drawing maze
    ctx.drawImage(mazeImg, 0,0);

    // drawing character
    monkey_x = start_x;
    monkey_y = start_y;
    var monkeyImg = document.getElementById('monkey');
    ctx.drawImage(monkeyImg, monkey_x, monkey_y);

    // drawing target
    var bananaImg = document.getElementById('banana');
    var banana_x = parseInt((maze.width-32)/2);
    var banana_y = parseInt((maze.height-32)/2)
    ctx.drawImage(bananaImg, banana_x, banana_y);

    // refresh frame by timeout
    timer = setTimeout('drawFrame()', 10);
  };
  
} // showMaze

// --------------------------------------------------
function downKey(evt){
  
  // games starts by first key pressed
  game_is_on = true;
  
  // stoping character
  speed_x = 0;
  speed_y = 0;
  
  // check key code
  switch(evt.keyCode){
    default: break; // any other key
    case 37: speed_x = -1; evt.preventDefault(); break; // left
    case 38: speed_y = -1; evt.preventDefault(); break; // up
    case 39: speed_x = 1; evt.preventDefault(); break; // right
    case 40: speed_y = 1; evt.preventDefault(); break; // down
  }
  
} // downKey

// --------------------------------------------------
function drawFrame(){
  
  // refreshing if character moves
  if (speed_x != 0 || speed_y != 0){
    // show the pathway
    ctx.beginPath();
    ctx.fillStyle = '#FFEEDD';
    ctx.rect(monkey_x, monkey_y, 24, 24);
    ctx.fill();

    // new character's postition
    monkey_x += speed_x;
    monkey_y += speed_y;

    // check for collision
    switch(checkCollision()){
      default: break;
      case 'wall':
        // step back and stop
        monkey_x -= speed_x;
        monkey_y -= speed_y;
        speed_x = 0;
        speed_y = 0;
        break;
      case 'banana':
        // drawing 'solved' icon
        var solvedImg = document.getElementById('solved');
        var solved_x = parseInt((maze.width-60)/2);
        var solved_y = parseInt((maze.height-60)/2)
        ctx.drawImage(solvedImg, solved_x, solved_y);
        // save result to localStorage
        saveResult(maze.toDataURL('image/png'),'Solved');
        return;
    }

    // drawing character
    var monkeyImg = document.getElementById('monkey');
    ctx.drawImage(monkeyImg, monkey_x, monkey_y);

  } 

  // refresh frame by timeout
  timer = setTimeout('drawFrame()', 10);
  
} // drawFrame

// --------------------------------------------------
function checkCollision(){
  
  // getting pixels at character's position plus 1px all sides
  var imgPixs = ctx.getImageData(monkey_x-1, monkey_y-1, 26, 26);
  var pixs = imgPixs.data;

  // getting RGBa of every px
  for(var i=0; i<pixs.length; i+=4){
    var r_col = pixs[i];
    var g_col = pixs[i+1];
    var b_col = pixs[i+2];
    var a_col = pixs[i+3];

    // black? -> wall
    if(r_col == 0 && g_col == 0 && b_col == 0 && a_col == 255 ){
      return 'wall';
    // yellow? -> target
    } else if(r_col == 255 && g_col == 255 && b_col == 0){
      return 'banana';
    }
  }
  
  // go on moving
  return false;
  
} // checkCollision