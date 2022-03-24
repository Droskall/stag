// menu : responsive
const menuSpan = document.querySelector('span.menu');
const menuDiv = document.querySelector('div.menu');
let a = 0;

menuSpan.addEventListener('click', () => {

    if (a === 0) {
        menuDiv.style.display = 'block';
        a++
    } else if (a === 1) {
        menuDiv.style.display = 'none';
        a--
    }

})

// background
let body = document.body;
body.style.height = innerHeight + "px";


// close php error message
const close = document.querySelector('#close');
const errorDiv = document.querySelector('div.error');

if (close) {
    close.addEventListener('click', () => {
        errorDiv.remove();
        close.remove();
    })
}



// // bubbles effect
// let bubbles = document.getElementById('band').getElementsByTagName('a');
//
// for (let i = 0 ; i < bubbles.length ; i++){
//     bubbles[i].addEventListener('click', function (e){
//         // e.preventDefault();
// //         this.classList.toggle("grow");
//     })
// }
//
