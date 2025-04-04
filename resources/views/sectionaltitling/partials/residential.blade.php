<br>

<div class="form-section">
    <h2 class="section-title">Property Address</h2>
    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">House No. <span style="color:red">*</span></label>
            <input type="text" name="property_house_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number">
        </div> 
        
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Plot No. <span style="color:red">*</span></label>
            <input type="text" name="property_plot_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Street Name <span style="color:red">*</span></label>
            <input type="text" name="property_street_name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter street name">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">District <span style="color:red">*</span></label>
            <input type="text" name="property_district" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter district">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">LGA <span style="color:red">*</span></label>
            <input type="text" name="property_lga" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter LGA">
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700">State <span style="color:red">*</span></label>
            <input type="text" name="property_state" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter state">
        </div>
    </div>
</div>  

<div class="form-section">
    <h2 class="section-title">Residential Information</h2>
    <div>
        <h3 class="text-sm font-medium mb-4">Residential Type <span style="color:red">*</span></h3>
        <div class="grid grid-cols-3 gap-4">
            <label class="flex items-center space-x-3">
                <input type="radio" name="residential_type" value="Single Family" class="radio-custom">
                <span class="text-sm">Single Family Home</span>
            </label>
            <label class="flex items-center space-x-3">
                <input type="radio" name="residential_type" value="Apartment" class="radio-custom">
                <span class="text-sm">Apartment</span>
            </label>
            <label class="flex items-center space-x-3">
                <input type="radio" name="residential_type" value="Condominium" class="radio-custom">
                <span class="text-sm">Condominium</span>
            </label>
            <label class="flex items-center space-x-3">
                <input type="radio" name="residential_type" value="Town House" class="radio-custom">
                <span class="text-sm">Townhouse</span>
            </label>
            <!-- Other field with custom input -->
            <div class="col-span-3 flex items-center space-x-3">
                <input type="radio" name="residential_type" value="others" class="radio-custom" id="residentialOthers">
                <span class="text-sm">Others (Specify)</span>
                <input type="text" id="residentialOthersInput" name="residentialOthersInput"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-1"
                    placeholder="Specify other residential type" disabled>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-sm font-medium mb-4">Number of Units <span style="color:red">*</span></h3>
        <input type="number" name="NoOfUnits" 
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" 
            placeholder="Enter number of units">
    </div>
</div>

<div class="form-section">
    <h2 class="section-title">House and Floor Number</h2>
    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">House Number</label>
            <input type="text" name="house_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter house number">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">No of Sections (Floors)</label>
            <input type="text" name="floor_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter No of Sections (Floors)">
        </div>
    </div>
</div>
<br>

<!-- Type of Ownership -->
<div class="form-section">
    <h2 class="section-title">Type of Ownership <span style="color:red">*</span></h2>
    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-2 md:grid-cols-4 gap-4">
        <label class="flex items-center space-x-3">
            <input type="radio" name="ownership_type" value="gift" class="radio-custom">
            <span class="text-sm">Gift</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="ownership_type" value="inheritance" class="radio-custom">
            <span class="text-sm">Inheritance</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="ownership_type" value="purchase" class="radio-custom">
            <span class="text-sm">Purchase</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="ownership_type" value="government" class="radio-custom">
            <span class="text-sm">Government</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="ownership_type" id="ownership_type_others" value="others" class="radio-custom">
            <span class="text-sm">Others</span>
        </label>
    </div>
    <div id="others_ownership_type" style="display: none;">
        <label class="block text-sm font-medium text-gray-700">Please Specify <span style="color:red">*</span></label>
        <input type="text" name="ownership_type_others_text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter specification">
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[type=radio][name=ownership_type]').change(function() {
            if (this.value == 'others') {
                $('#others_ownership_type').show();
            } else {
                $('#others_ownership_type').hide();
            }
        });

        $('#residentialOthers').change(function() {
            if ($(this).is(':checked')) {
                $('#residentialOthersInput').prop('disabled', false);
            } else {
                $('#residentialOthersInput').prop('disabled', true);
            }
        });
    });
</script>
<br>