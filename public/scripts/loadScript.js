document.addEventListener('DOMContentLoaded', function(){
    let savedOrder = JSON.parse(localStorage.getItem('tableOrder'));
    let tableBody = document.querySelector('table tbody');
    let rowsArray = Array.from(tableBody.querySelectorAll('tr'));
    savedOrder.forEach(order =>{
        const rowPosition = rowsArray.find(row => row.dataset.id == order.id);
        if(rowPosition){
            tableBody.appendChild(rowPosition);
        }
    });
    saveOrder();
    updateNav();
});