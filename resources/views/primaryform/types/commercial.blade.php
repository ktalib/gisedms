@if (request()->query('landuse') === 'Commercial' || request()->query('landuse') === 'Mixed')
<div class="mb-6">
    <h2 class="section-title">Types of Commercial <span style="color:red"></span></h2>

    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-4 gap-4">
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Block of Flats"
            class="radio-custom commercial-type-radio" required>
        <span class="text-sm">Block of Flats</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Plaza" class="radio-custom commercial-type-radio"
            required>
        <span class="text-sm">Plaza</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Housing Estate"
            class="radio-custom commercial-type-radio" required>
        <span class="text-sm">Housing Estate</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Unit of Shops" class="radio-custom commercial-type-radio"
            required>
        <span class="text-sm">Unit of Shops</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Fragmented Layout"
            class="radio-custom commercial-type-radio" required>
        <span class="text-sm">Fragmented Layout</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Unit of Offices" class="radio-custom commercial-type-radio"
            required>
        <span class="text-sm">Unit of Offices</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Others" class="radio-custom"
            id="commercialTypeOthers" required>
        <span class="text-sm">Others</span>
        </label>
        <label class="flex items-center space-x-3">
        <input type="radio" name="commercial_type" value="Shopping Mall" class="radio-custom commercial-type-radio"
            required>
        <span class="text-sm">Shopping Mall</span>
        </label>
        <div class="col-span-2" id="commercialTypeOthersContainer" style="display: none;">
        <input type="text" id="commercialTypeOthersInput" name="commercial_type_others"
            class="w-full p-2 border border-gray-300 rounded-md" placeholder="Specify other type">
        </div>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all commercial type radio buttons
        const commercialRadios = document.querySelectorAll('input[name="commercial_type"]');
        const othersInput = document.getElementById('commercialTypeOthersContainer');
        const othersRadio = document.getElementById('commercialTypeOthers');

        // Add change event listener to each radio button
        commercialRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Check if the "Others" option is selected
            if (this.value === 'Others' && this.checked) {
            // Show the others input field
            othersInput.style.display = 'block';
            document.getElementById('commercialTypeOthersInput').required = true;
            } else {
            // Hide the others input field and clear its value
            othersInput.style.display = 'none';
            document.getElementById('commercialTypeOthersInput').value = '';
            document.getElementById('commercialTypeOthersInput').required = false;
            }
        });
        });
    });
    </script>
@endif
