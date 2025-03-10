let button = document.getElementById('createButton').addEventListener('click', async (event) => {
    event.preventDefault();
    let createQuery = await fetch('functions/createPage.php', {

    });
    let createResponse = await createQuery.text();
    console.log(createQuery);
    console.log(createResponse);
});