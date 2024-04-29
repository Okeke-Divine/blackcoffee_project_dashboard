<?php require ('auth-validator.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require ('meta-head.php'); ?>
    <title>Dashboard | Black Cofee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
        integrity="sha512-ZZfrbOnf6K9vdIwBVDiW6CNvGhnczfeNNyjGtf2YBWy1nS1fUxvTx5QsVjcvTtEZPFowC47Gyf+9xDdWm1WdGQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="bg-gray-200 min-h-screen flex items-center justify-center py-5">
        <div class="bg-white p-8 shadow-md rounded-lg max-w-[90%] w-full">
            <h1 class="text-3xl font-semibold mb-4">Dashboard</h1>
            <div class="flex justify-between mb-4">
                <div>
                    <label for="sort-by" class="text-gray-500 mr-2">Sort By:</label>
                    <select id="sort-by" class="p-2 border border-gray-300 rounded">
                        <option value="id">ID</option>
                        <option value="end_year">End Year</option>
                        <option value="topic">Topic</option>
                        <option value="sector">Sector</option>
                        <option value="region">Region</option>
                        <option value="pestle">Pestle</option>
                        <option value="source">Source</option>
                        <option value="swot">Swot</option>
                        <option value="country">Country</option>
                        <option value="city">City</option>
                        <option value="rand()">Random</option>
                    </select>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label for="order" class="text-gray-500 mr-2">Order:</label>
                        <select id="order" class="p-2 border border-gray-300 rounded">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div>
                        <select id="limit" class="p-2 border border-gray-300 rounded">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="700">700</option>
                            <option value="800">800</option>
                            <option value="900">900</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="table-container" class="overflow-x-auto w-full">
                <!-- Table will be rendered here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to fetch data from API and render table
            function fetchData(sortBy, order, limit) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "api.php?sortBy=" + sortBy + "&order=" + order + "&limit=" + limit, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        renderTable(data);
                    }
                };
                xhr.send();
            }

            // Function to render table
            function renderTable(data) {
                var table = '<table class="table-auto w-full">';
                table += `<thead><tr><th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Intensity</th>
                <th class="border px-4 py-2">Likelihood</th>
                <th class="border px-4 py-2">Relevance</th>
                <th class="border px-4 py-2">Start Year</th>
                <th class="border px-4 py-2">End Year</th><th class="border px-4 py-2">Sector</th><th class="border px-4 py-2">Topic</th><th class="border px-4 py-2">Region</th><th class="border px-4 py-2">Pestle</th><th class="border px-4 py-2">Source</th><th class="border px-4 py-2">Swot</th><th class="border px-4 py-2">Country</th><th class="border px-4 py-2">City</th></tr></thead>`;

                table += '<tbody>';
                data.forEach(function (entry) {
                    table += '<tr>';
                    table += '<td class="border px-4 py-2">' + entry.id + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.intensity + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.likelihood + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.relevance + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.start_year + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.end_year + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.sector + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.topic + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.region + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.pestle + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.source + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.swot + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.country + '</td>';
                    table += '<td class="border px-4 py-2">' + entry.city + '</td>';
                    table += '</tr>';
                });
                table += '</tbody></table>';
                document.getElementById('table-container').innerHTML = table;
            }

            // Call the fetchData function with default sorting parameters when the page loads
            fetchData('id', 'asc', '10');

            // Event listener for dropdown changes
            document.getElementById('sort-by').addEventListener('change', function () {
                var sortBy = this.value;
                var order = document.getElementById('order').value;
                var limit = document.getElementById('limit').value;
                fetchData(sortBy, order);
            });

            document.getElementById('order').addEventListener('change', function () {
                var order = this.value;
                var sortBy = document.getElementById('sort-by').value;
                var limit = document.getElementById('limit').value;
                fetchData(sortBy, order, limit);
            });

            document.getElementById('limit').addEventListener('change', function () {
                var limit = this.value;
                var order = document.getElementById('order').value;
                var sortBy = document.getElementById('sort-by').value;
                fetchData(sortBy, order, limit);
            });
        });
    </script>
</body>

</html>