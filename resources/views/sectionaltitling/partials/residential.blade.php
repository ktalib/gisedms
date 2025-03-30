

<br>

<div class="form-section">
    <h2 class="section-title">Property Address</h2>
    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">House No.</label>
            <input type="text" name="property_house_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number">
        </div> 
        
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Plot No.</label>
            <input type="text" name="property_plot_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Street Name</label>
            <input type="text" name="property_street_name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter street name">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">District</label>
            <input type="text" name="property_district" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter district">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">LGA</label>
            <input type="text" name="property_lga" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter LGA">
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700">State</label>
            <input type="text" name="property_state" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter state">
        </div>
    </div>
</div>  



   <div class="form-section">
                    <h2 class="section-title">Type of Residential</h2>
                    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-3 gap-4">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="block_of_flats" class="radio-custom">
                            <span class="text-sm">Block of Flats</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="housing_estate" class="radio-custom">
                            <span class="text-sm">Housing Estate</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="fragmented_layout" class="radio-custom">
                            <span class="text-sm">Fragmented Layout</span>
                        </label>
                        
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="terrace" class="radio-custom">
                            <span class="text-sm">Terrace</span>
                        </label>
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
                            <label class="block text-sm font-medium text-gray-700">Floor Number</label>
                            <input type="text" name="floor_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter floor number">
                        </div>
                    </div>
                </div>
                <br>


           

                <!-- Type of Ownership -->
                <div class="form-section">
                    <h2 class="section-title">Type of Ownership</h2>
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
                        <label class="block text-sm font-medium text-gray-700">Please Specify</label>
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
                    });
                </script>
       <br>