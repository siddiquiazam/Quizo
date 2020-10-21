var domStrings = {
   "buttonQuestion" : document.getElementById('get-question'),
   "question" : document.getElementById('question'),
   "options" : document.getElementById('options'),
   "response" : document.getElementById('response'),
   "container" : document.getElementById('score'),
   "time" : document.getElementById('time'),
   "progress" : document.getElementById('progress'),
   "quit": document.getElementById('quit')
};


var resData = {};
var id = 0;
var score = 0;

domStrings.quit.addEventListener('click', ()=> {
   update();
   window.location.href = "home.html";
});

document.addEventListener('DOMContentLoaded',getQuestion);

domStrings.buttonQuestion.addEventListener('click', getQuestion);

domStrings.options.addEventListener('click', (event)=> {
   if(event.target.id != 'options') {
      domStrings.options.style.marginBottom = 0;
      if(event.target.id == resData.correct) {
         var resp = `<h2 style = "color: #428A27; font-weight: 700;">Correct!!!</h2>`;
         score += 1;
         event.target.classList.remove('btn-warning');
         event.target.classList.toggle('btn-success');
         domStrings.response.innerHTML = resp;
         var width = Math.floor((score/10)*100);
         domStrings.progress.style.width = `${width}%`;
         domStrings.progress.innerHTML = `${width}%`;
      }
      else {
         var resp = `<h2 style = "color: #B3260A; font-weight: 700;">Wrong!!!</h2>`;
         event.target.classList.toggle('btn-danger');
         document.getElementById(resData.correct).classList.remove('btn-warning');
         document.getElementById(resData.correct).classList.toggle('btn-success');
         domStrings.response.innerHTML = resp;
      }
      var x = domStrings.options.querySelectorAll('.btn');
      x.forEach((e)=> {
         e.disabled = true;
      })
      domStrings.container.innerHTML = `<h2 class="text-white pr-4">Score: ${score}</h2>`;
   }
});


function getQuestion() {
   domStrings.options.style.marginBottom = "10px";
   if(id == 10) {
      update();
      window.location.href = "home.html";
   }
   else {
      timer();
      domStrings.container.innerHTML = `<h2 class="text-white pr-4">Score: ${score}</h2>`;
      id += 1;
      var templateQues = ``;
      var templateOpt = ``;
      domStrings.response.innerHTML = "";
      var formdata = new FormData();
      formdata.append('id',id);
      fetch('php/question.php', {
         method: 'POST',
         body: formdata
      }).then((res)=> res.json())
      .then((ques)=> {
         resData = ques;
         templateOpt += `<br>
                     <button id = '1' class='btn btn-warning btn-lg btn-block font-weight-bold' style = "width: 100%">${ques.option1}</button>
                     <br>
                     <button id = '2' class='btn btn-warning btn-lg btn-block font-weight-bold' style = "width: 100%">${ques.option2}</button>
                     <br>
                     <button id = '3' class='btn btn-warning btn-lg btn-block font-weight-bold' style = "width: 100%">${ques.option3}</button>
                     <br>
                     <button id = '4' class='btn btn-warning btn-lg btn-block font-weight-bold' style = "width: 100%">${ques.option4}</button>`;
         templateQues += `<h2 style = "text-align:center;" class = "font-weight-bold">${ques.question}</h2>`;
         domStrings.question.innerHTML = templateQues;
         domStrings.options.innerHTML = templateOpt;
      })
      .catch((err) => console.error(err))
   }
}
var time;
function timer() {
   var secs = 10;
      if(time) {
         clearInterval(time);
      }
      domStrings.time.innerHTML = `<h3 class = "font-weight-bold" id="timer">Time Left: ${secs}</h3>`;
         time = setInterval(function(){ 
         secs--; 
         domStrings.time.innerHTML = `<h3 class = "font-weight-bold" id = "timer">Time Left: ${secs}</h3>`;
         if(secs <= 4) {
            document.getElementById('timer').style.color = 'red';
         }
         if(secs <= 0){
            clearInterval(time);
          if(id!=10){
          getQuestion();
          }
          else if(id==10) {
             update();
             window.location.href = "home.html";
          }
         }
         
      }, 1000);
}

function update() {
   var formdata = new FormData();
      formdata.append('score',score);
      fetch('php/update.php', {
         method: 'POST',
         body: formdata
      }).then((res)=> res.json())
      .then((mess)=> {
         console.log(mess.mess);
      })
      .catch((err) => console.error(err))
}




