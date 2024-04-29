<div class="container mx-auto">
    <h1 class="text-3xl font-semibold mb-4">Posts by Region</h1>
    <div class="w-3/4 mx-auto">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to fetch data from the API
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "api/chart-post-by-...-api.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    renderChart(data);
                }
            };
            xhr.send();
        }

        // Function to render the bar chart
        function renderChart(data) {
            var labels = data.map(entry => entry.region);
            var counts = data.map(entry => entry.post_count);

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: 'rgba(126, 34, 206, 0.2)',
                        borderColor: 'rgba(126, 34, 206, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            min: 1,
                            max: 250
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Hide the legend
                        }
                    }
                }
            });
        }

        // Fetch data and render the chart when the page loads
        fetchData();
    });
</script>