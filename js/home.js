document.addEventListener('DOMContentLoaded',()=> {
   fetch('php/home.php')
   .then((res) => res.json())
   .then((score)=> {
      document.getElementById('high-score').innerHTML = `<h2 class="text-white pr-4">High Score: ${score.high}</h2>`;
   }).catch((err)=>console.error(err))
});