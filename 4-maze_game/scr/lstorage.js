/////////////////////////////////////////
// Program:    Web Development 3       //
// Course:     Advanced JavaScript     //
// Assignment: #3                      //
// Instructor: Brent Scott             //
// Student:    Oleksandr Vorovskyi     //
// Date:       June 17, 2018           //
// File:       lstorage.js             //
/////////////////////////////////////////

// global variables
var maze_player; // player name
var maze_number; // number of games
var maze_result; // results table

// --------------------------------------------------
function loadStorage(){
  
  // checking for desired values (min 3 required)
  maze_player = localStorage.getItem('maze_player') ? localStorage.getItem('maze_player') : 'New player';
  maze_number = localStorage.getItem('maze_number') ? localStorage.getItem('maze_number') : 0;
  maze_result = localStorage.getItem('maze_result') ? JSON.parse(localStorage.getItem('maze_result')) : [];
  
  drawResults();
  
} // loadStorage

// --------------------------------------------------
function clearStorage(){
  
  // clear values
  maze_player = localStorage.setItem('maze_player', '');
  maze_number = localStorage.setItem('maze_number', '');
  maze_result = localStorage.setItem('maze_result', '');
  
  loadStorage();
  
} // clearStorage

// --------------------------------------------------
function saveResult(game_img, game_result){
  
  // stop the game
  game_is_on = false;

  // current date
  var game_date = new Date();
  
  // adding new result at the top
  maze_result.unshift({result_img: game_img, result_date: game_date.toUTCString(), result_game: game_result});
  localStorage.setItem('maze_result', JSON.stringify(maze_result));
  
  // increase number of games
  maze_number = parseInt(maze_number) + 1;
  localStorage.setItem('maze_number', maze_number);
  
  drawResults();
  
} // saveResult

// --------------------------------------------------
function savePlayer(){
  localStorage.setItem('maze_player', document.getElementById('player').value);
} // savePlayer

// --------------------------------------------------
function drawResults(){
  
  var resHTML = '';
  resHTML += '<table>';
  
  // player's name
  resHTML += '<tr><th colspan="2">';
  resHTML += 'Current player: <input id="player" value="' + maze_player + '" />';
  resHTML += '</th><th>';
  resHTML += '<button id="save_player" onclick="savePlayer();">Save name</button>';
  resHTML += '</th></tr>';

  // number of games, clear button
  resHTML += '<tr><th colspan="2">';
  resHTML += maze_number + ' games played here';
  resHTML += '</th><th>';
  resHTML += '<button id="clear_storage" onclick="clearStorage();">Clear data</button>';
  resHTML += '</th></tr>';
  
  // results table
  for(i in maze_result){
    resHTML += '<tr><td>';
    resHTML += '<img src="' + maze_result[i].result_img + '" alt="result" width="75" height="75" />'
    resHTML += '</td><td>';
    resHTML += maze_result[i].result_date;
    resHTML += '</td><td>';
    resHTML += maze_result[i].result_game;
    resHTML += '</td></tr>';
  }
  resHTML += '</table>';
  
  // drawing
  document.getElementById('results').innerHTML = resHTML;
  
} // saveStorage

