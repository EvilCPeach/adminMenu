let allTr = document.querySelectorAll("tr");
let target = document.getElementById('target');
let draged;
allTr.forEach(tr => {
    tr.addEventListener('dragstart', (event) => {
        draged = event.target;
        draged.classList.add('drag');
    });
    tr.addEventListener("dragenter", (event) => {
        let target = event.target;
        event.preventDefault();
        console.log('dragenter');
        console.log(target);
    });
    target.addEventListener('drop', (event) => {
        event.preventDefault();
        if(tr.classList.contains('drag')){
            tr.classList.remove('drag');
        }
        console.log('drop');
    });
});