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