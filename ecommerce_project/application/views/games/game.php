<!doctype html>
<html lang="en">
  <head>
    <title>Guess Game</title>
    <meta charset="utf-8" />
    <style>
      body{
        font-family: Tahoma, Arial, sans-serif;
        font-size: 16px;
        background-color: #ffaf38;
        padding: 10px;
        text-align: center;
      }
      body h1{
        margin-top: -10px;
      }
      #timer{
        margin: 0 auto;
        font-weight: bold;
        font-size: 30px;
      }
      #results{
        width: 250px;
        min-height: 20px;
        background-color: #89c845;
        color: #fff;
        border: 1px solid #000;
        border-radius: 10px; 
        padding-left: 20px;
        padding-right: 20px;
        margin-top: 20px;
        float: left;
        margin-top: 20px;
        margin-left: 500px;
      }
      #game{
        float: left;
      }
      /* box that will be dragged.*/
      #dragger{
        position: absolute;
        top: 130px;
        right: 150px;
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
      }
      #dragee{
        position: absolute;
        top: 252px;
        left: 500px;
        width: 100px;
        height: 100px;
        color: #fff;
        font-weight: bold;
      }
      #dragee:hover{
        transform: scale(1.5);
        top: 230px;
      }
      #decoys{
        background: url('/public/images/games/shelf.jpg');
        background-size: 100%;
        transform: scale(.8);
        width: 300px;
        position: relative;
        top: 200px;
        left: -400px;
      }
      #decoy1{
        width: 150px;
        height: 70px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: 25px;
        left: 40px;
      }
      #decoy2{
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: 48px;
        left: 180px;
      }
      #decoy3{
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: 80px;
        left: 200px;
      }
      #decoy4{
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: 10px;
        left: 110px;
      }
      #decoy5{
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: -60px;
        left: 30px;
      }
      #decoy6{
        width: 60px;
        height: 60px; 
        background-color: #bba46e;
        margin-bottom: 10px;
        position: relative;
        top: -35px;
        left: 80px;
      }
      @media screen and (max-width: 850px){
        #results{
          margin-left: 300px;
        }
        #dragee{
          left: 300px;
        }
        #decoys{
          left: 150px;
          top: 120px;
        }
      }
      @media screen and (max-width: 650px){
        #results{
          margin-left: 100px;
        }
        h1{
          font-size: 18px;
        }
        #time{
          font-size: 18px;
        }
        #dragee{
          top: 230px;
        }
      }
      @media screen and (max-width: 550px){
        #decoys{
          position: relative;
          left: 10px;
        }
        #dragee{
          left: 150px;
        }
      }
      @media screen and (max-width: 450px){
        #results{
          margin-left: -10px;
        }
        #dragee{
          top: 225px;
        }
      }
    </style>
    
    <script>
      // GLobal variables
      var resultsbox;
      
     onload=function(){
       resultsbox = document.getElementById("results");

         /*var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("progressBar").value = 10 - --timeleft;
  if(timeleft == 0)
    clearInterval(downloadTimer);
  var alert = document.getElementById('body');
  alert.innerHTML = 'Time up';
},1000);*/

var fiveMinutes = 15,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
     }

     //when correct div is dragged
     function pkgDrag(evt){
       resultsbox.innerHTML = "<h2>You might have found it let DODO check it!</h2>";
       evt.dataTransfer.setData("text", evt.target.id);
     }
      
    //detect that the div has been dragged over the other div and allow it to be dropped
    function allow_pkg_drop(evt){
      evt.preventDefault();
      resultsbox.innerHTML = "DODO is waiting for the right package.";
    }

    //when the div is dropped 
    function pkgDrop(evt){
      //prevent default browser actions when div is dropped 
      evt.preventDefault();
      //get bdata to write to the div
      var data = evt.dataTransfer.getData("text");
      evt.target.appendChild(document.getElementById(data));
      //set styles to divs
      resultsbox.innerHTML = "<h2><strong>Congradulations enjoy a one time deal with promo code: BEYOND</strong></h2>";
      resultsbox.style.transform = 'scale(1.8)';
      resultsbox.style.width = '50%';
      resultsbox.style.marginBottom = '50px';
      resultsbox.style.marginLeft = '350px';
      document.getElementById('body').style.backgroundColor = '#333';
      document.getElementById('dragee').style.opacity = '0';
      document.getElementById('decoys').style.opacity = '0';

    }

function startTimer(duration, display) {
    var timer = duration, seconds;
    setInterval(function () {
        seconds = parseInt(timer % 15);

        //seconds = seconds < 10 ? /*"0" +*/ seconds : seconds;

        display.textContent = seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
    /*if(){
      document.getElementById('body').innerHTML = 'Time up'
    };*/
    
}


    </script>
    
  </head>

  <body id="body">
    <h1>Play to win a promo code!</h1>

    <div id="timer">Time Left: <span id="time">15</span> seconds</div>

    <!--<progress value="0" max="10" id="progressBar"></progress>-->

    <div id="results">DODO is mailing packages. Guess what package he wants to mail next you must drag packages from the shelf to him</div>
    <div id="game">
    
    <div id="dragee" 
         ondragover="allow_pkg_drop(event)" 
         ondrop="pkgDrop(event)">
           <img src="/public/images/games/DODO.svg" alt="DODO">
    </div>
    
         <div id="decoys">
          <div id="dragger" draggable="true" ondragstart="pkgDrag(event);"></div>
           <div id="decoy1" draggable="true">
           </div>
           <div id="decoy2" draggable="true">
           </div>
           <div id="decoy3" draggable="true">
           </div>
           <div id="decoy4" draggable="true">
           </div>
           <div id="decoy5" draggable="true">
           </div>
          <div id="decoy6" draggable="true">
           </div>
        </div>
       </div><!--end game-->


    <noscript>
      This page requires JavaScript. Please enable it in your browser. 
    </noscript>
  </body>

</html>