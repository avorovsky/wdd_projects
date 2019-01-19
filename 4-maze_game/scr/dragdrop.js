/////////////////////////////////////////
// Program:    Web Development 3       //
// Course:     Advanced JavaScript     //
// Assignment: #3                      //
// Instructor: Brent Scott             //
// Student:    Oleksandr Vorovskyi     //
// Date:       June 17, 2018           //
// File:       dragdrop.js             //
/////////////////////////////////////////

// --------------------------------------------------
function allowDrop(evt){
  evt.preventDefault();
} // allowDrop

// --------------------------------------------------
function dragIt(evt){
  evt.dataTransfer.setData('text', evt.target.id);
} // dragIt

// --------------------------------------------------
function dropIt(evt){
  
  // set visible solution image
  document.getElementById('sol_img').setAttribute('src', mazeSet[mazeRnd].solution);
  
  // clear text 'drag here'
  evt.target.innerHTML = '';
  
  evt.preventDefault();
  var data = evt.dataTransfer.getData('text');
  evt.target.appendChild(document.getElementById(data));
  
} // dropIt