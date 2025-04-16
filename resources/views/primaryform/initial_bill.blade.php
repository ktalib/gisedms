<div class="bg-gray-50 p-4 rounded-md mb-6">
    <h3 class="font-medium text-center mb-4">INITIAL BILL</h3>
    
    <div class="grid grid-cols-3 gap-4 mb-4">
      <div>
        <label class="flex items-center text-sm mb-1">
          <i data-lucide="file-text" class="w-4 h-4 mr-1 text-green-600"></i>
          Application fee (₦)
        </label>
        <input type="number" class="w-full p-2 border border-gray-300 rounded-md fee-input" placeholder="Enter application fee" name="application_fee" value="0">
      </div>
      <div>
        <label class="flex items-center text-sm mb-1">
          <i data-lucide="file-check" class="w-4 h-4 mr-1 text-green-600"></i>
          Processing fee (₦)
        </label>
        <input type="number" class="w-full p-2 border border-gray-300 rounded-md fee-input" placeholder="Enter processing fee" name="processing_fee" value="0">
      </div>
      <div>
        <label class="flex items-center text-sm mb-1">
          <i data-lucide="map" class="w-4 h-4 mr-1 text-green-600"></i>
          Site Plan (₦)
        </label>
        <input type="number" class="w-full p-2 border border-gray-300 rounded-md fee-input" placeholder="Enter site plan fee" name="site_plan_fee" value="0">
      </div>
    </div>
    
    <div class="flex justify-between items-center mb-4">
      <div class="flex items-center">
        <i data-lucide="file-text" class="w-4 h-4 mr-1 text-green-600"></i>
        <span>Total:</span>
      </div>
      <span class="font-bold" id="total-amount">₦0.00</span>
    </div>
    
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="flex items-center text-sm mb-1">
          <i data-lucide="calendar" class="w-4 h-4 mr-1 text-green-600"></i>
          has been paid on
        </label>
        <input type="date" class="w-full p-2 border border-gray-300 rounded-md" value="2025-04-15" name="payment_date">
      </div>
      <div>
        <label class="flex items-center text-sm mb-1">
          <i data-lucide="receipt" class="w-4 h-4 mr-1 text-green-600"></i>
          with receipt No.
        </label>
        <input type="number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter receipt number" name="receipt_number">
      </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const feeInputs = document.querySelectorAll('.fee-input');
    const totalDisplay = document.getElementById('total-amount');
    
    // Function to calculate and update the total
    function updateTotal() {
        let total = 0;
        feeInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });
        
        // Format the total with 2 decimal places and the Naira symbol
        totalDisplay.textContent = '₦' + total.toFixed(2);
    }
    
    // Add event listeners to all fee inputs
    feeInputs.forEach(input => {
        input.addEventListener('input', updateTotal);
    });
    
    // Calculate initial total
    updateTotal();
});
</script>