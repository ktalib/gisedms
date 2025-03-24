@extends('layouts.app')
@section('page-title')
    {{ __('Legal Search Module') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Legal Search Module') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script>
        if($('#classic-editor').length > 0){
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
                console.error(error);
            });
        }
        setTimeout(() => {
            feather.replace();
        }, 500);
    </script>
@endpush
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
{{-- {{ route('notification.index') }} --}}
    <div class="container mx-auto mt-4 p-4" id="searchTab" style="display: none">
        <h2 class="text-center text-2xl font-semibold mb-4">Legal Search</h2>
        <p class="text-red-600 mb-4">It is important to sight evidence of payment before proceeding with Legal Search.</p>
        <div class="flex flex-wrap mb-3">
            <div class="w-full md:w-2/3 pr-2 mb-2 md:mb-0">
                <label for="searchParameter" class="block text-xl font-medium text-gray-700">Search Parameter</label>
                <input type="text" name="searchParameter" id="searchParameter" class="w-full border border-gray-300 rounded p-2" placeholder="Enter File Number, Name, Registration Particulars, or Location" required>
            </div>
            <div class="w-full md:w-1/6 flex items-end">
                <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Search</button>
            </div>
        </div>
        <table id="resultTable" class="w-full text-sm text-left text-gray-500 border-collapse border border-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="py-3 px-4 border border-gray-300">S/N</th>
                    <th class="py-3 px-4 border border-gray-300">Assignor</th>
                    <th class="py-3 px-4 border border-gray-300">Assignee</th>
                    <th class="py-3 px-4 border border-gray-300">Instrument Type</th>
                    <th class="py-3 px-4 border border-gray-300">Date</th>
                    <th class="py-3 px-4 border border-gray-300">Reg. No.</th>
                    <th class="py-3 px-4 border border-gray-300">Size</th>
                    <th class="py-3 px-4 border border-gray-300">Comments</th>
                    <th class="py-3 px-4 border border-gray-300">View</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
    <div id="reportView" style="display: nomne;">
        <div class="container mx-auto mt-4 p-4">
            <h2 class="text-center text-2xl font-semibold mb-4">Legal Search Report</h2>
            <div class="bg-white rounded-lg shadow-md mb-4">
                <div class="bg-blue-500 text-white p-3 rounded-t-lg">Property Details</div>
                <div class="p-4">
                    <p><strong>File Number:</strong> KN0001 | kangisFileNo: KNML 09475 | mlsfNo: CON-RES-2018-242</p>
                    <p><strong>Plot Number:</strong> GP No. 1067/1 &amp; 1067/2</p>
                    <p><strong>Plot Description:</strong> Niger Street Nassarawa District, Nassarawa LGA</p>
                    <p><strong>Plan Number:</strong> LKN/RES/2021/3006</p>
                    <p><strong>Schedule:</strong> Kano</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md mb-4">
                <div class="bg-gray-600 text-white p-3 rounded-t-lg">Transaction History</div>
                <div class="p-4">
                    <table class="w-full text-sm text-left text-gray-500 border-collapse border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="py-3 px-4 border border-gray-300">S/N</th>
                                <th class="py-3 px-4 border border-gray-300">Assignor</th>
                                <th class="py-3 px-4 border border-gray-300">Assignee</th>
                                <th class="py-3 px-4 border border-gray-300">Instrument Type</th>
                                <th class="py-3 px-4 border border-gray-300">Date</th>
                                <th class="py-3 px-4 border border-gray-300">Reg. No.</th>
                                <th class="py-3 px-4 border border-gray-300">Size</th>
                                <th class="py-3 px-4 border border-gray-300">Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">1</td>
                                <td class="py-4 px-4 border border-gray-300">Tunde Adeyemi</td>
                                <td class="py-4 px-4 border border-gray-300">Aisha Bello</td>
                                <td class="py-4 px-4 border border-gray-300">Transfer of Title</td>
                                <td class="py-4 px-4 border border-gray-300">16th January, 2018</td>
                                <td class="py-4 px-4 border border-gray-300">1/1/1</td>
                                <td class="py-4 px-4 border border-gray-300">0.0192ha</td>
                                <td class="py-4 px-4 border border-gray-300">Building plan approved</td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">2</td>
                                <td class="py-4 px-4 border border-gray-300">Abubakar Muhammad Dayyab</td>
                                <td class="py-4 px-4 border border-gray-300">Musa Ibrahim</td>
                                <td class="py-4 px-4 border border-gray-300">Deed of Surrender</td>
                                <td class="py-4 px-4 border border-gray-300">27th January, 2018</td>
                                <td class="py-4 px-4 border border-gray-300">2/2/1</td>
                                <td class="py-4 px-4 border border-gray-300">0.0192ha</td>
                                <td class="py-4 px-4 border border-gray-300">Transfer registered</td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">3</td>
                                <td class="py-4 px-4 border border-gray-300">Abubakar Muhammad Dayyab</td>
                                <td class="py-4 px-4 border border-gray-300">Musa Ibrahim</td>
                      
                                <td class="py-4 px-4 border border-gray-300">Sales Agreement</td>
                                <td class="py-4 px-4 border border-gray-300">6th July, 2018</td>
                                <td class="py-4 px-4 border border-gray-300">3/3/1</td>
                                <td class="py-4 px-4 border border-gray-300">0.0192ha</td>
                                <td class="py-4 px-4 border border-gray-300">Subject to survey</td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">4</td>
                                <td class="py-4 px-4 border border-gray-300">Ngozi Okafor</td>
                                <td class="py-4 px-4 border border-gray-300">Aisha Bello</td>
                                <td class="py-4 px-4 border border-gray-300">Deed of Surrender</td>
                                <td class="py-4 px-4 border border-gray-300">13th July, 2018</td>
                                <td class="py-4 px-4 border border-gray-300">4/4/1</td>
                                <td class="py-4 px-4 border border-gray-300">0.0192ha</td>
                                <td class="py-4 px-4 border border-gray-300">Land dispute resolved</td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">5</td>
                                <td class="py-4 px-4 border border-gray-300">NINE FIVE INVESTMENT LIMITED</td>
                                <td class="py-4 px-4 border border-gray-300">Hajara Sani</td>
                                <td class="py-4 px-4 border border-gray-300">Deed of Mortgage</td>
                                <td class="py-4 px-4 border border-gray-300">16th December, 2018</td>
                                <td class="py-4 px-4 border border-gray-300">5/5/1</td>
                                <td class="py-4 px-4 border border-gray-300">0.0192ha</td>
                                <td class="py-4 px-4 border border-gray-300">Sale completed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Note:</strong>
                <span class="block sm:inline">This property has an active caveat due to an ongoing legal dispute.</span>
            </div>
            <div class="text-center">
                <button onclick="downloadReport()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Download PDF Report</button>
                <button onclick="printReport()" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Print Report</button>
            </div>
            <script>
                function downloadReport() {
                    window.location.href = "http://127.0.0.1:5500/resources/views/notification/report.html";
                }
                
                function printReport() {
                    const printWindow = window.open("http://127.0.0.1:5500/resources/views/notification/report.html");
                    printWindow.onload = function() {
                        printWindow.print();
                    };
                }
            </script>
        </div>
    </div>
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchParameter = document.getElementById('searchParameter').value.toLowerCase();
            const tableBody = document.getElementById('tableBody');

            // Clear previous results
            tableBody.innerHTML = '';

            // Define the data
            const data = {
                "KN0001": [{
                    "S/N": 1,
                    "Assignor": "Tunde Adeyemi",
                    "Assignee": "Aisha Bello",
                    "Instrument Type": "Transfer of Title",
                    "Date": "16th January, 2018",
                    "Reg. No.": "1/1/1",
                    "Size": "0.0192ha",
                    "Comments": "Building plan approved"
                }],
                "KNML 09475": [{
                    "S/N": 2,
                    "Assignor": "Abubakar Muhammad Dayyab",
                    "Assignee": "Musa Ibrahim",
                    "Instrument Type": "Deed of Surrender",
                    "Date": "27th January, 2018",
                    "Reg. No.": "2/2/1",
                    "Size": "0.0192ha",
                    "Comments": "Transfer registered"
                }],
                "CON-RES-2018-242": [{
                    "S/N": 3,
                    "Assignor": "Musa Ibrahim",
                    "Assignee": "Abubakar Muhammad Dayyab",
                    "Instrument Type": "Sales Agreement",
                    "Date": "6th July, 2018",
                    "Reg. No.": "3/3/1",
                    "Size": "0.0192ha",
                    "Comments": "Subject to survey"
                }]
            };

            // Perform the search
            let found = false;
            for (const key in data) {
                if (key.toLowerCase().includes(searchParameter) || data[key][0]["Assignor"].toLowerCase().includes(searchParameter) || data[key][0]["Assignee"].toLowerCase().includes(searchParameter) || data[key][0]["Reg. No."].toLowerCase().includes(searchParameter)) {
                    data[key].forEach(item => {
                        let row = `
                            <tr class="bg-white border-b">
                                <td class="py-4 px-4 border border-gray-300">${item["S/N"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Assignor"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Assignee"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Instrument Type"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Date"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Reg. No."]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Size"]}</td>
                                <td class="py-4 px-4 border border-gray-300">${item["Comments"]}</td>
                                <td class="py-4 px-4 border border-gray-300"><button class="viewButton bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-file-number="${key}">View</button></td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                    found = true;
                }
            }

            if (!found) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Record not found!',
                });
            }
        });

        document.getElementById('tableBody').addEventListener('click', function(event) {
            if (event.target.classList.contains('viewButton')) {
                const fileNumber = event.target.dataset.fileNumber;
                document.getElementById('reportFileNumber').innerText = 'NewKANGISFileNo: ' + fileNumber + ' | kangisFileNo: KNML 09475 | mlsfNo: CON-RES-2018-242';
                document.getElementById('reportView').style.display = 'block';
                document.getElementById('searchTab').style.display = 'none';
                console.log('View button clicked for file number:', fileNumber);
            }
        });
    </script>
@endsection
