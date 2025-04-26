@if (request()->query('landuse') === 'Residential' || request()->query('landuse') === 'Mixed')
<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">Type of Ownership:</label>
    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-4 gap-4">
        <div>
            <label class="inline-flex items-center">
                <input type="radio" name="ownershipType" value="gift" class="form-radio text-blue-600">
                <span class="ml-2">Gift</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="radio" name="ownershipType" value="inheritance" class="form-radio text-blue-600">
                <span class="ml-2">Inheritance</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="radio" name="ownershipType" value="purchase" class="form-radio text-blue-600">
                <span class="ml-2">Purchase</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="radio" name="ownershipType" value="government" class="form-radio text-blue-600">
                <span class="ml-2">Government</span>
            </label>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="radio" name="ownershipType" value="others" class="form-radio text-blue-600">
                <span class="ml-2">Others (Specify)</span>
            </label>
        </div>
        <div class="form-group" id="otherOwnershipType" style="display: none;">
            <label for="otherOwnership">Please Specify:</label>
            <input type="text" id="otherOwnership" name="otherOwnership"  class="w-full p-2 border border-gray-300 rounded-md">
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('input[name="ownershipType"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const otherField = document.getElementById('otherOwnershipType');
            if (this.value === 'others') {
                otherField.style.display = 'block';
            } else {
                otherField.style.display = 'none';
            }
        });
    });
</script>
@endif