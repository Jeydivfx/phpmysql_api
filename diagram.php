<!DOCTYPE html>
<html>
<head>
    <title>Visualization</title>
    <!-- Jag har använt Chart.js för att rita diagram -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="chart" width="800" height="400"></canvas>
    </div>

    <script>
        // Läsa informationen från read_data
        var counts = <?php include 'read_data.php'; ?>;


        // Skapa diagram med chart.js
        function createBarChart(countryData) {
            var countries = Object.keys(countryData);
            var maleCounts = countries.map(country => countryData[country].male);
            var femaleCounts = countries.map(country => countryData[country].female);

            var ctx = document.getElementById("chart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: countries,
                    datasets: [
                        {
                            label: "Males",
                            data: maleCounts,
                            backgroundColor: "rgba(54, 162, 235, 0.7)"
                        },
                        {
                            label: "Females",
                            data: femaleCounts,
                            backgroundColor: "rgba(255, 99, 132, 0.7)"
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false 
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 
                            }
                        }
                    }
                }
            });
        }

        // Anropa funktionen för att rita diagram
        createBarChart(counts);
    </script>
</body>
</html>
