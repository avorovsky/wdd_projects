<!doctype html>
<html lang="en">
  <head>
    <title>Promo Game</title>
    <meta charset="utf-8" />
    <style>
      body{
        font-family: Times New Roman, Arial, sans-serif;
        font-size: 16px;
        background-color: #ffaf38;
      }
      body h1{
        text-align: center;
      }
      #startgame{
      	font-size: 30px;
      	border-radius: 10px;
      	color: #fff;
        padding: 15px;
        font-weight: bold;
        background-color: #89c845;
        margin-left: 30px;
      }
      #dodo{
        position: absolute;
        top: -250px;
        background-color: #fff; 
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 3px 2px 13px rgba(0,0,0,0.6);
      }
      @media screen and (max-width: 400px){
        #the_alert{
          font-size: 20px;
        }
        #startgame{
          margin-top: 20px;
        }
      }
      #dodo img{
      	width: 50px;
        height: 50px;
      }
      #paddle{
        position: absolute;
        top: 40px;
        left: 40px;
        border-radius: 5px;
        background-color: #0c0;
        width: 30px;
        height: 40px;
        box-shadow: 3px 2px 13px rgba(0,0,0,0.6);
        cursor: none;
      }
      #the_score{
        margin: 0px auto;
        color: #fff;
        font-size: 200%;
        width: 200px;
        font-weight: bold;
      }
      #the_alert{
        position: absolute;
        top: 3px;
        right: 3px;
        padding: 8px;
        background: #ddd;
        background-color: #89c845;
        font-size: 40px;
        text-align: center;
        color: #fff;
        opacity: 0;
        padding-top: 30px;
      }
      /*written score into the score div*/
      #the_score:before{
        content: "Your Score: ";
      }
    </style>
    
    <!--links fpr external files-->
    <script src="/public/js/animate.js"></script>
    <script src="/public/js/hittest.js"></script>
  </head>

  <body id="body">

    <h1>Play to win a promo code for any item!</h1>

    <p style="text-align: center; font-size: 20px; margin-bottom: -30px;">Your goal is to reach 50 points</p>

    <!--this is the alert div for when the game is lost or won-->
    <div id="the_alert"></div>

    <!--this is the button that starts the game-->
    <p><button id="startgame">PLAY</button></p>

    <!--this is the player's score-->
    <div id="the_score" style="text-align: center;">0</div>
    
    <!--this is the ball-->
    <div id="dodo"><img src="/public/images/games/DODO.svg" alt="DODO"></div>

    <div id="paddle"></div>
    
  </body>

</html>