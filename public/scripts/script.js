const table = document.getElementById('table');
const nav = document.getElementById('navbar-nav');
let draggingRow;
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
table.addEventListener('dragstart', (e) => {
    draggingRow = e.target;
    draggingRow.classList.add('dragging');
});

table.addEventListener('dragend', () => {
    draggingRow.classList.remove('dragging');
    saveOrder();
    updateNav();
});
table.addEventListener('dragover', (e) => {
    e.preventDefault();
    const targetRow = e.target.closest('tr');
    if (targetRow && targetRow !== draggingRow) {
        const boundingRow = targetRow.getBoundingClientRect();
        const offset = boundingRow.y + boundingRow.height / 2;
        if (e.clientY - offset > 0) {
            targetRow.parentNode.insertBefore(draggingRow, targetRow.nextElementSibling);
        } else {
            targetRow.parentNode.insertBefore(draggingRow, targetRow);
        }
    }
});
function updateNav() {
    const rows = table.querySelectorAll('tbody tr');
    const lists = nav.querySelectorAll('li');
    rows.forEach(row => {
        const namePage = row.querySelector('td:first-child');
        const linkPage = row.querySelector('td:nth-child(2)');
        lists.forEach(list => {
            list.remove();
        })
        const navItem = document.createElement('li');
        const linkItem = document.createElement('a');
        linkItem.classList.add('nav-link');
        linkItem.ariaCurrent = "page";
        linkItem.href = linkPage.textContent;
        linkItem.textContent = namePage.textContent;
        navItem.appendChild(linkItem);
        navItem.classList.add('nav-item');
        nav.appendChild(navItem);
    });
    saveOrder();
}
async function saveOrder(){
    const order = [];
    const rows = table.querySelectorAll('tr');
    rows.forEach((row, index) => {
        order.push({
            id: row.dataset.id,
            position: index
        });
    });
    let queryOrder = await fetch('../functions/saveOrder.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({order})
    });
    let responseOrder = await queryOrder.text();
    localStorage.setItem('tableOrder', JSON.stringify(order));
}
saveOrder();
updateNav();