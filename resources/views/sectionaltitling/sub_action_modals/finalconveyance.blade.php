<!-- Final Conveyance Modal -->
       <div id="finalConveyanceModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 relative">
           <div class="flex items-center justify-between border-b px-6 py-4">
              <h3 class="text-lg font-semibold text-gray-900">Final Conveyance</h3>
              <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeFinalConveyanceModal()">
                 <i data-lucide="x" class="w-5 h-5"></i>
              </button>
           </div>
           <div class="px-6 py-4">
              <form id="finalConveyanceForm">
                 <!-- Hidden field for application id -->
                 <input type="text" name="application_id" id="finalConveyanceApplicationId" value="">
                 <div id="inputContainer" class="space-y-4">
                    <!-- Input rows will be inserted here -->
                  </div>
                  
                  <button type="button" id="addMoreBtn" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="addConveyanceInputButton">
                    Add More
                    <i data-lucide="plus" class="ml-2 w-4 h-4"></i>
                 </button>
                  </div>
               

                 <div class="bg-gray-100 rounded-lg px-4 py-3 mt-4">
                    <div class="flex justify-center space-x-3">

                 <hr class="my-4">
           
                    <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                       Submit
                       <i data-lucide="send" class="ml-2 w-4 h-4"></i>
                    </button>
                    <button type="button" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="openBuyersListBtn">
                       Buyers List
                       <i data-lucide="users" class="ml-2 w-4 h-4"></i>
                    </button>
                 </div> 
                  </div>
              </form>
           </div>
        </div>
     </div>
      <!-- End Final Conveyance Modal -->


      {{-- Final Conveyance List --}}
    <div id="buyersListModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
     <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 relative">
       <div class="flex items-center justify-between border-b px-4 py-3">
      <h3 class="text-lg font-semibold text-gray-900">Buyers List</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeBuyersListModal()">
      <i data-lucide="x" class="w-5 h-5"></i>
      </button>
       </div>
       <div class="px-4 py-3 max-h-96 overflow-y-auto" id="buyersListContent">
      @include('sectionaltitling.action_modals.buyers_list', ['PrimaryApplication' => $PrimaryApplication])  
       </div>
       <div class="bg-gray-100 px-4 py-3 flex justify-between rounded-b-lg">
      <button type="button" class="inline-flex justify-center items-center px-3 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="closeBuyersListModal()">
      Close
      <i data-lucide="x" class="ml-2 w-4 h-4"></i>
      </button>
      <button type="button" class="inline-flex justify-center items-center px-3 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="printBuyersList()">
      Print Buyers List
      <i data-lucide="printer" class="ml-2 w-4 h-4"></i>
      </button>
       </div>
     </div>
    </div>

    <script>
      // Final Conveyance Modal functions
      function openFinalConveyanceModal(applicationId) {
        document.getElementById('finalConveyanceApplicationId').value = applicationId;
        document.getElementById('finalConveyanceModal').classList.remove('hidden');
        if (window.lucide) lucide.createIcons();

        // fetch JSON (not HTML), send cookies, expect JSON
        fetch(`{{ url('/conveyance') }}/${applicationId}`, {
          headers: { 'Accept': 'application/json' },
          credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(d => {
          // use d.records if present, otherwise parse d.conveyance JSON string
          const recs = d.records 
            || (d.conveyance ? JSON.parse(d.conveyance).records : []);
          renderInputRows(recs);
        });
      }

      function closeFinalConveyanceModal() {
        document.getElementById('finalConveyanceModal').classList.add('hidden');
      }

      function renderInputRows(records) {
        const c = document.getElementById('inputContainer');
        c.innerHTML = '';
        records.forEach(rec => addInputRow(rec));
      }

      function addInputRow(data = {}) {
        const c = document.getElementById('inputContainer');
        const div = document.createElement('div');
        div.className = 'flex space-x-4 items-center';
        div.innerHTML = `
          <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Buyer Name</label>
            <input type="text" name="buyerName[]" 
                   class="w-full border rounded px-3 py-2" 
                   value="${data.buyerName||''}" required>
          </div>
          <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Section No</label>
            <input type="text" name="sectionNo[]" 
                   class="w-full border rounded px-3 py-2" 
                   value="${data.sectionNo||''}" required>
          </div>
          ${c.children.length>0 
            ? `<button type="button" class="remove-row bg-red-500 text-white p-2 rounded">
                 <i class="w-4 h-4">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                          </i>
               </button>`
            : ''}
        `;
        c.appendChild(div);
        const btn = div.querySelector('.remove-row');
        if (btn) btn.addEventListener('click', () => div.remove());
      }

      document.getElementById('addMoreBtn')
        .addEventListener('click', () => addInputRow());

      document.getElementById('finalConveyanceForm')
        .addEventListener('submit', function(e) {
          e.preventDefault();
          const appId = document.getElementById('finalConveyanceApplicationId').value;
          const fd = new FormData(this);
          const buyers = fd.getAll('buyerName[]').map((n,i) => ({
            buyerName: n,
            sectionNo: fd.getAll('sectionNo[]')[i]
          }));
          
          // Show loading message
          Swal.fire({
            title: 'Processing...',
            html: 'Submitting Final Conveyance',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
          
          fetch('{{ url('/conveyance/update') }}', {
            method: 'POST',
            headers: {
              'Content-Type':'application/json',
              'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({application_id:appId, records:buyers})
          })
          .then(r => r.json())
          .then(resp => {
            if (resp.success) {
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Final conveyance has been submitted successfully.',
                timer: 1500
              }).then(() => {
                closeFinalConveyanceModal();
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update final conveyance.'
              });
            }
          })
          .catch(err => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An error occurred while submitting the form.'
            });
          });
        });

      // Close modal when clicking outside
      document.getElementById('finalConveyanceModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeFinalConveyanceModal();
        }
      });

      // show Buyers List modal
      function openBuyersListModal(applicationId) {
        document.getElementById('buyersListModal').classList.remove('hidden');
        if (window.lucide) lucide.createIcons();
        
        // Fetch the application data to display in the buyers list
        fetch(`{{ url('/mother-applications') }}/${applicationId}`, {
          headers: { 'Accept': 'application/json' },
          credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
          // Now fetch the conveyance data
          fetch(`{{ url('/conveyance') }}/${applicationId}`, {
            headers: { 'Accept': 'application/json' },
            credentials: 'same-origin'
          })
          .then(convResponse => convResponse.json())
          .then(convData => {
            // Get the buyers list content container
            const buyersListContainer = document.getElementById('buyersListContent');
            
            // Render the buyers list template with the fetched data
            fetch(`{{ url('/render-buyers-list') }}`, {
              method: 'POST',
              headers: { 
                'Content-Type': 'application/json',
                'Accept': 'text/html',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                PrimaryApplication: data,
                conveyanceData: convData.records
              })
            })
            .then(templateResponse => templateResponse.text())
            .then(html => {
              buyersListContainer.innerHTML = html;
            });
          });
        })
        .catch(error => {
          console.error('Error fetching data:', error);
          document.getElementById('buyersListContent').innerHTML = 
            '<div class="p-4 bg-red-100 text-red-700 rounded">' +
            '<p class="font-semibold">Error loading data</p>' +
            '<p>Could not load the application data. Please try again later.</p>' +
            '</div>';
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to load buyers list data.'
          });
        });
      }

      function closeBuyersListModal() {
        document.getElementById('buyersListModal').classList.add('hidden');
      }

      // wire up the "Buyers List" button
      document.getElementById('openBuyersListBtn')
        .addEventListener('click', function() {
          closeFinalConveyanceModal();
          openBuyersListModal(
            document.getElementById('finalConveyanceApplicationId').value
          );
        });

      // print only the Buyers List contents
      function printBuyersList() {
        const printArea = document.getElementById('buyersListContent');
        const w = window.open('', '_blank');
        w.document.write(`
          <html><head><title>Buyers List</title></head>
          <body>${printArea.innerHTML}</body></html>
        `);
        w.document.close();
        w.focus();
        w.print();
        w.close();
      }

      document.addEventListener('DOMContentLoaded', function() {
        const inputContainer = document.getElementById('inputContainer');
        const addMoreBtn = document.getElementById('addMoreBtn');
        let rowCount = 0;
        
        // Function to add a new row of inputs
        function addInputRow() {
          const rowDiv = document.createElement('div');
          rowDiv.className = 'flex space-x-4 items-center';
          rowDiv.innerHTML = `
            <div class="w-1/2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Buyer Name</label>
              <input type="text" name="buyerName[]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="w-1/2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Section No</label>
              <input type="text" name="sectionNo[]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            ${rowCount > 1 ? `
          <div class="flex items-end pb-1">
                      <button type="button" class="remove-row bg-red-500 hover:bg-red-600 text-white p-2 rounded-md text-sm transition-colors">
                        <i class="w-4 h-4">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                          </i>
                      </button>
                    </div>
           ` : ''}
          `;
          
          inputContainer.appendChild(rowDiv);
          
          // Add event listener to the remove button if it exists in this row
          const removeBtn = rowDiv.querySelector('.remove-row');
          if (removeBtn) {
            removeBtn.addEventListener('click', function() {
              inputContainer.removeChild(rowDiv);
              rowCount--;
            });
          }
          
          rowCount++;
        }
        
        // Add two rows by default
        addInputRow();
        addInputRow();
        
        // Add event listener to the "Add More" button
        addMoreBtn.addEventListener('click', addInputRow);
        
        // Form submission handler
        document.getElementById('buyerForm').addEventListener('submit', function(e) {
          e.preventDefault();
          
          // Create FormData object to collect form data
          const formData = new FormData(e.target);
          
          // Get all buyer names and section numbers
          const buyerNames = formData.getAll('buyerName[]');
          const sectionNos = formData.getAll('sectionNo[]');
          
          // Create an array of buyer objects
          const buyers = buyerNames.map((name, index) => ({
            buyerName: name,
            sectionNo: sectionNos[index]
          }));
          
          console.log('Submitted data:', buyers);
          alert('Form submitted! Check the console for details.');
        });
      });
    </script>