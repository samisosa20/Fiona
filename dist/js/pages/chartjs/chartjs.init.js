$(function () {
    "use strict";
	// Bar chart
	new Chart(document.getElementById("bar-chart"), {
		type: 'bar',
		data: {
		  labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
		  datasets: [
			{
			  label: "Population (millions)",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa"],
			  data: [8478,6267,5734,4784,1833]
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true, 
			text: 'Predicted world population (millions) in 2050'
		  }
		}
	});

	// New chart
	new Chart(document.getElementById("pie-chart"), {
		type: 'pie',
		data: {
		  labels: ["Africa", "Asia", "Europe", "Latin America"],
		  datasets: [{
			label: "Population (millions)",
			backgroundColor: ["#5e73da", "#b1bdfa","#5f76e8","#8fa0f3"],
			data: [2478,5267,3734,2784]
		  }]
		},
		options: {
		  title: {
			display: true,
			text: 'Predicted world population (millions) in 2050'
		  }
		}
	});

	// Horizental Bar Chart
	new Chart(document.getElementById("bar-chart-horizontal"), {
		type: 'horizontalBar',
		data: {
		  labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
		  datasets: [
			{
			  label: "Population (millions)",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa"],
			  data: [8478,6267,5534,4784,3433]
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: 'Predicted world population (millions) in 2050'
		  }
		}
	});

	//Polar Chart
	new Chart(document.getElementById("polar-chart"), {
		type: 'polarArea',
		data: {
		  labels: ["Africa", "Asia", "Europe", "Latin America"],
		  datasets: [
			{
			  label: "Population (millions)",
			  backgroundColor: ["#5e73da", "#b1bdfa","#5f76e8","#8fa0f3"],
			  data: [2478,5267,5734,3784]
			}
		  ]
		},
		options: {
		  title: {
			display: true,
			text: 'Predicted world population (millions) in 2050'
		  }
		}
	});

	//Radar chart
	new Chart(document.getElementById("radar-chart"), {
		type: 'radar',
		data: {
		  labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
		  datasets: [
			{
			  label: "250",
			  fill: true,
			  backgroundColor: "rgba(1, 202, 241,0.2)",
			  borderColor: "rgba(1, 202, 241,1)",
			  pointBorderColor: "#fff",
			  pointBackgroundColor: "rgba(1, 202, 241,1)",
			  data: [8.77,55.61,21.69,6.62,6.82]
			}, {
			  label: "4050",
			  fill: true,
			  backgroundColor: "rgba(95, 118, 232,0.2)",
			  borderColor: "rgba(95, 118, 232,1)",
			  pointBorderColor: "#fff",
			  pointBackgroundColor: "rgba(95, 118, 232,1)",
			  pointBorderColor: "#fff",
			  data: [25.48,54.16,7.61,8.06,4.45]
			}
		  ]
		},
		options: {
		  title: {
			display: true,
			text: 'Distribution in % of world population'
		  }
		}
	});

	//Line Chart



	// line second
}); 