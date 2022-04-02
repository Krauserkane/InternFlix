const hamburgBtn = document.querySelector('.hamburger__container');
const dropDown = document.querySelector('.drop__down');
let listOpen = false;
let dropOpen = false;
hamburgBtn.addEventListener('click',() => {
    if(!listOpen){
        hamburgBtn.classList.add('open__list');
        dropDown.classList.remove('hide__dropdown');
        listOpen = true;
        dropOpen = true;
    }
    else{
        hamburgBtn.classList.remove('open__list');
        dropDown.classList.add('hide__dropdown');
        listOpen = false;
        dropOpen = false;
    }
});