
document.querySelectorAll('.btn2').forEach(item => {   
    item.addEventListener('click', event => {        
                event.preventDefault();
                window.scrollTo(0,0);
                document.querySelector('.form__bigcontainer').style.display='flex';
                document.querySelector('body').classList.add('scroll__lock');
})
});

document.querySelector('.close').addEventListener('click', function(){
    document.querySelector('.form__bigcontainer').style.display='none';
    document.querySelector('body').classList.remove('scroll__lock');
});