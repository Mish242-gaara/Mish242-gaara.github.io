

document.addEventListener('DOMContentLoaded', function() {
    const btns = [
        document.getElementById('modifier'),
        document.getElementById('ajouter'),
        document.getElementById('supprimer')
    ];
    const scroller = document.querySelector('.scroller');
    const elements = document.querySelectorAll('.scroller > div');
    function scrollToForm(index) {
        if(window.innerWidth >= 1100) {
            scroller.style.transform = `translateX(-${index * (elements[0].offsetWidth + 30)}px)`;
        } else {
            scroller.style.transform = 'translateX(0)';
            window.scrollTo({top: elements[index].offsetTop - 80, behavior: 'smooth'});
        }
    }
    btns.forEach((btn, idx) => {
        btn.addEventListener('click', function() {
            scrollToForm(idx);
        });
    });
    function handleResize() {
        if(window.innerWidth < 1100) {
            scroller.style.transform = 'translateX(0)';
        }
    }
    window.addEventListener('resize', handleResize);
    handleResize();
});


