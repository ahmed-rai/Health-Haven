// Select the required DOM elements
const searchInput = document.getElementById('search-input');
const searchForm = document.getElementById('search-form');
const dossiersTbody = document.getElementById('dossiers-tbody');

// Add an event listener for the input event on the search input field
searchInput.addEventListener('input', (event) => {
    event.preventDefault();

    // Get the search query from the input field
    const searchQuery = searchInput.value.trim();

    // Fetch the search results from the server using the form's action URL
    fetch(`${searchForm.action}?q=${searchQuery}`)
        .then((response) => response.json())
        .then((data) => {
            // Update the table body with the new rows
            dossiersTbody.innerHTML = data.html;
        })
        .catch((error) => {
            console.error('Error fetching search results:', error);
        });
});
