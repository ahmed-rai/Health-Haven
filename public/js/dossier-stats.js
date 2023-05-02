// js/dossier-stats.js

// You need to include Chart.js library to use the following code
// https://www.chartjs.org/

document.addEventListener("DOMContentLoaded", () => {
  // Fetch the popular medications data from a variable or endpoint
  const popularMedications = JSON.parse(document.getElementById("popular-medications-data").textContent);

  // Prepare the data for the chart
  const labels = popularMedications.map((med) => med.medication);
  const data = popularMedications.map((med) => med.total);

  // Create the chart
  const ctx = document.getElementById("popular-medications-chart").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Médicaments les plus populaires",
          data: data,
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
