// assets/js/admin-dossiers.js 
/*
import $ from 'jquery';
$(document).ready(function () {
    $("#search").on("input", function () {
        const query = $(this).val();

        $.ajax({
            url: "/admin/dossiers/ajax-search?q=" + query,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
            },
        });
    });

    function updateTable(data) {
        const tableBody = $("table tbody");
        tableBody.empty();

        data.forEach(function (dossier) {
            const row = $("<tr></tr>");
            row.append($("<td></td>").text(dossier.nom));
            row.append($("<td></td>").text(dossier.medicaments));
            row.append($("<td></td>").text(dossier.dateCreation));
            row.append($("<td></td>").text(dossier.phobies));
            row.append($("<td></td>").text(dossier.resultats));
            row.append($("<td>Dr Ahmed</td>"));

            tableBody.append(row);
        });

        if (data.length === 0) {
            tableBody.append(
                $("<tr><td colspan='6'>Pas de dossiers</td></tr>")
            );
        }
    }
}); 
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const dossiersTbody = document.getElementById('dossiers-tbody');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(searchForm);
        const searchQuery = formData.get('q');

        fetch(`${searchForm.action}?q=${encodeURIComponent(searchQuery)}`)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                dossiersTbody.innerHTML = data.html;
            });
    });
}); 
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const searchInput = searchForm.querySelector('input[name="q"]');
    const dossiersTbody = document.getElementById('dossiers-tbody');

    // Debounce function to limit the frequency of search requests
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    const searchDossiers = debounce(function() {
        const searchQuery = searchInput.value;

        fetch(`${searchForm.action}?q=${encodeURIComponent(searchQuery)}`)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                dossiersTbody.innerHTML = data.html;
            });
    }, 300);

    searchInput.addEventListener('input', searchDossiers);


    
});

*/


