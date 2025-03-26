@extends('layouts.app')
@section('page-title')
    {{ __('Legal Search') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Legal Search') }}</li>
@endsection
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome for the search icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .search-container {
        display: flex;
        align-items: stretch;
        max-width: 100%;
        gap: 0;
    }

    .custom-select {
        position: relative;
        flex-grow: 1;
    }

    .select-box {
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
        padding: 8px;
        height: 42px;
        display: flex;
        align-items: center;
    }

    #search-input {
        width: 100%;
        padding: 2px 0;
        border: none;
        outline: none;
        font-size: 16px;
        background: transparent;
    }

    .options-container {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        border: 1px solid #ccc;
        border-top: none;
        background: #fff;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
        border-radius: 0 0 4px 4px;
    }

    .option {
        padding: 8px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f0f0f0;
    }

    .show {
        display: block;
    }

    .search-button {
        border-radius: 0 4px 4px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
    }

    .search-button i {
        margin-right: 10px;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="container mx-auto">
                        <!-- Compact search with button directly adjacent -->
                        <div class="search-container">
                            <div class="custom-select">
                                <div class="select-box">
                                    <input type="text" id="search-input" placeholder="Search file number..."
                                        oninput="filterOptions()">
                                </div>
                                
                                <div class="options-container" id="options-container">
                                    <div class="option" data-value="KN0001"><a href="{{ route('legal_search.legal_search_report') }}">KN0001</a></div>
                                    <div class="option" data-value="KNML 09475"><a href="{{ route('legal_search.legal_search_report') }}">KNML 09475</a></div>
                                    <div class="option" data-value="CON-RES-2018-242"><a href="{{ route('legal_search.legal_search_report') }}">CON-RES-2018-242</a></div>
                                </div>
                            </div>
                            <button id="smallSearchButton"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold search-button">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold search-button ml-4" onclick="toggleDiv()">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                        </div>

                        <div class="mt-4" id="hiddenDiv" style="display: none;">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search Grantor" oninput="filterTable(0)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search Grantee" oninput="filterTable(1)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search Location" oninput="filterTable(2)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search MLSFileNo" oninput="filterTable(3)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search KANGISFileNo" oninput="filterTable(4)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search NewKANGISFileNo" oninput="filterTable(5)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search Registration Particulars" oninput="filterTable(6)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search PlotNo" oninput="filterTable(7)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search Plot Description" oninput="filterTable(8)"></th>
                                            <th class="py-2 px-4"><input type="text" class="border border-gray-300 rounded p-1" placeholder="Search LGA" oninput="filterTable(9)"></th>
                                        </tr>
                                        <tr>
                                            <th class="py-2 px-4">Grantor</th>
                                            <th class="py-2 px-4">Grantee</th>
                                            <th class="py-2 px-4">Location</th>
                                            <th class="py-2 px-4">MLSFileNo</th>
                                            <th class="py-2 px-4">KANGISFileNo</th>
                                            <th class="py-2 px-4">NewKANGISFileNo</th>
                                            <th class="py-2 px-4">Registration Particulars</th>
                                            <th class="py-2 px-4">PlotNo</th>
                                            <th class="py-2 px-4">Plot Description</th>
                                            <th class="py-2 px-4">LGA</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <!-- Rows will be populated dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JSON Data from PDF -->
    <script>
        const jsonData = [
            {
                "grantor": "Tunde Adeyemi",
                "grantee": "Aisha Bello",
                "location": "Kano",
                "mlsFileNo": "CON-RES-2018-242",
                "kangisFileNo": "KNML 09475",
                "newKangisFileNo": "KN0001",
                "registrationParticulars": "1/1/1",
                "plotNo": "Plot789",
                "plotDescription": "Description of Plot in Kano",
                "lga": "Kano LGA"
            },
            

            {
                "grantor": "Abubakar Muhammad Dayyab",
                "grantee": "Musa Ibrahim",
                "location": "Kano",
                "mlsFileNo": "CON-RES-2018-242",
                "kangisFileNo": "KNML 09475",
                "newKangisFileNo": "KN0001",
                "registrationParticulars": "2/2/1",
                "plotNo": "Plot789",
                "plotDescription": "Description of Plot in Kano",
                "lga": "Kano LGA"
            },
            {
                "grantor": "Musa Ibrahim",
                "grantee": "Abubakar Muhammad Dayyab",
                "location": "Kano",
                "mlsFileNo": "CON-RES-2018-242",
                "kangisFileNo": "KNML 09475",
                "newKangisFileNo": "KN0001",
                "registrationParticulars": "3/3/1",
                "plotNo": "Plot789",
                "plotDescription": "Description of Plot in Kano",
                "lga": "Kano LGA"
            }

         
        ];

        // Function to populate the table with JSON data
        function populateTable() {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = ''; // Clear existing rows

            jsonData.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.grantor}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.grantee}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.location}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.mlsFileNo}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.kangisFileNo}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.newKangisFileNo}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.registrationParticulars}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.plotNo}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.plotDescription}</a></td>
                    <td class="border px-4 py-2"><a href="{{ route('notification.index') }}">${row.lga}</a></td>
                `;
                tableBody.appendChild(tr);
            });
        }

        // Call the function to populate the table on page load
        document.addEventListener('DOMContentLoaded', populateTable);
    </script>

    <!-- Existing JavaScript for dropdown and filtering -->
    <script>
        // Function to toggle dropdown
        function toggleDropdown() {
            document.getElementById('options-container').classList.toggle('show');
        }

        // Function to filter options
        function filterOptions() {
            const input = document.getElementById('search-input');
            const filter = input.value.toUpperCase();
            const options = document.querySelectorAll('.option');

            options.forEach(option => {
                const txtValue = option.textContent || option.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            });

            // Show dropdown when typing
            if (!document.getElementById('options-container').classList.contains('show')) {
                document.getElementById('options-container').classList.add('show');
            }
        }

        // Setup event listeners when document is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Handle option selection
            const options = document.querySelectorAll('.option');
            options.forEach(option => {
                option.addEventListener('click', function() {
                    document.getElementById('search-input').value = this.textContent;
                    document.getElementById('options-container').classList.remove('show');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const selectBox = document.querySelector('.select-box');
                const optionsContainer = document.getElementById('options-container');

                if (!selectBox.contains(e.target) && !optionsContainer.contains(e.target)) {
                    optionsContainer.classList.remove('show');
                }
            });

            // Make input field trigger the dropdown
            document.getElementById('search-input').addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
            });

            // Search button functionality
            document.getElementById('smallSearchButton').addEventListener('click', function() {
                const selectedValue = document.getElementById('search-input').value;
                console.log("Searching for:", selectedValue);
                // Add your search logic here
            });
        });

        // Function to filter table rows
        function filterTable(columnIndex) {
            const input = document.querySelectorAll('thead th input')[columnIndex].value.toUpperCase();
            const tableBody = document.getElementById('table-body');
            const rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cell = rows[i].getElementsByTagName('td')[columnIndex];
                if (cell) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toUpperCase().indexOf(input) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }

        // Function to toggle table visibility
        function toggleDiv() {
            const hiddenDiv = document.getElementById('hiddenDiv');
            hiddenDiv.style.display = hiddenDiv.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection