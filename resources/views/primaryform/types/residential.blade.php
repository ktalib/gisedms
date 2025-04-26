@if (request()->query('landuse') === 'Residential' || request()->query('landuse') === 'Mixed')
<div class="mb-4">
    <label class="block mb-2 font-medium">Type of Residence</label>
    <div class="grid grid-cols-2 gap-4">
      <label class="flex items-center">
        <input type="radio" name="residenceType" class="mr-2" value="Detached House" checked>
        <span>Detached House</span>
      </label>
      <label class="flex items-center">
        <input type="radio" name="residenceType" class="mr-2" value="Housing Estate">
        <span>Housing Estate</span>
      </label>
      <label class="flex items-center">
        <input type="radio" name="residenceType" class="mr-2" value="Fragmented Layout">
        <span>Fragmented Layout</span>
      </label>
      <label class="flex items-center">
        <input type="radio" name="residenceType" class="mr-2" value="others">
        <span>Others</span>
      </label>
    </div>
    <div id="otherResidenceTypeField" class="mt-3" style="display: none;">
      <label class="block mb-2 text-sm font-medium">Please specify:</label>
      <input type="text" name="otherResidenceType" class="w-full p-2 border rounded">
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const radioButtons = document.querySelectorAll('input[name="residenceType"]');
      const otherField = document.getElementById('otherResidenceTypeField');
      
      // Check initial state
      if (document.querySelector('input[name="residenceType"]:checked').value === 'others') {
        otherField.style.display = 'block';
      }
      
      // Add change event listeners
      radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
          if (this.value === 'others') {
            otherField.style.display = 'block';
          } else {
            otherField.style.display = 'none';
          }
        });
      });
    });
  </script>
@endif