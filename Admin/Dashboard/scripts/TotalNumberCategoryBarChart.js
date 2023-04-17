$(document).ready(() => {
  let label = "";
  let data = [];
  let labels = [];
  let backgroundColor = [];
  // update the chart data and label based on the selected category
  $(".select-category").on("click", function (e) {
    e.preventDefault();
    const selectedValue = $(this).data("value");
    $.ajax({
      url: "include/graphs.bar.dynamic.data.php",
      method: "GET",
      dataType: "json",
      data: {
        category: selectedValue,
      },
      success: (response) => {
        label = response.label;
        data = response.data;
        labels = response.labels;
        let lowestValue = Math.min(...data);
        let highestValue = Math.max(...data);
        for (let i = 0; i < data.length; i++) {
          if (data[i] === lowestValue) {
            backgroundColor.push("rgb(240, 255, 66)");
          } else if (data[i] === highestValue) {
            backgroundColor.push("rgb(55, 146, 55)");
          } else {
            backgroundColor.push("rgb(84, 180, 53)");
          }
        }

        myChart.data.datasets[0].label = label;
        myChart.data.datasets[0].data = data;
        myChart.data.labels = labels;
        myChart.update();
      },
    });
    if (selectedValue == "") {
      allSelected();
    }
  });

  const allSelected = () => {
    $.ajax({
      url: "include/graphs.bar.data.php",
      method: "GET",
      dataType: "json",
      success: (response) => {
        label = response.label;
        data = response.data;
        labels = response.labels;
        let lowestValue = Math.min(...data);
        let highestValue = Math.max(...data);
        for (let i = 0; i < data.length; i++) {
          if (data[i] === lowestValue) {
            backgroundColor.push("rgb(240, 255, 66)");
          } else if (data[i] === highestValue) {
            backgroundColor.push("rgb(55, 146, 55)");
          } else {
            backgroundColor.push("rgb(84, 180, 53)");
          }
        }
        myChart.data.datasets[0].label = label;
        myChart.data.datasets[0].data = data;
        myChart.data.labels = labels;
        myChart.update();
      },
      error: (xhr, status, error) => {
        console.log("Error: " + error.message);
      },
    });
  };
  allSelected();
  // create the chart
  let ctx = $("#barChart");
  let myChart = new Chart(ctx, {
    type: "horizontalBar",
    data: {
      labels: labels,
      datasets: [
        {
          label: label,
          data: data,
          backgroundColor: backgroundColor,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        xAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
      minBarLength: 1,
    },
  });
});
