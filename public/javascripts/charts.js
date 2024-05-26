document.addEventListener("DOMContentLoaded", function () {
  const chartLabels = ["Files", "Links", "Notes"];
  const chartColors = [
    "rgba(34, 34, 59, 0.65)",
    "rgba(74, 78, 105, 0.65)",
    "rgba(154, 140, 152, 0.65)",
  ];
  const chartData = [counts.files, counts.links, counts.notes];

  const barChartCTX = document
    .getElementById("barChartContainer")
    .getContext("2d");

  const barChart = new Chart(barChartCTX, {
    type: "bar",
    data: {
      labels: chartLabels,
      datasets: [
        {
          backgroundColor: chartColors,
          data: chartData,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
    },
  });

  const doughnutChartCTX = document
    .getElementById("doughnutChartContainer")
    .getContext("2d");

  const doughnutChart = new Chart(doughnutChartCTX, {
    type: "doughnut",
    data: {
      labels: chartLabels,
      datasets: [
        {
          backgroundColor: chartColors,
          data: chartData,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
        },
      },
    },
  });
});
