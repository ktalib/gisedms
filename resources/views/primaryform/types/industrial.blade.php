@if(request()->query('landuse') === 'Industrial')
<div class="mb-4">
    <h2 class="section-title">Type of Industrial</h2>
    <div class="grid grid-cols-4 gap-4">
        <label class="flex items-center space-x-3">
            <input type="radio" name="industrial_type" value="Industrial Layout" class="radio-custom">
            <span class="text-sm">Industrial Layout</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="industrial_type" value="Industrial Estate" class="radio-custom">
            <span class="text-sm">Industrial Estate</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="industrial_type" value="Section" class="radio-custom">
            <span class="text-sm">Section</span>
        </label>
        <label class="flex items-center space-x-3">
            <input type="radio" name="industrial_type" value="Others" class="radio-custom" id="industrialTypeOthers">
            <span class="text-sm">Others</span>
        </label>
        <div class="col-span-2" id="industrialTypeOthersContainer" style="display: none;">
            <input type="text" id="industrialTypeOthersInput" name="industrial_type_others" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Specify other type">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const industrialTypeRadios = document.querySelectorAll('input[name="industrial_type"]');
        const industrialOthersContainer = document.getElementById('industrialTypeOthersContainer');
        const industrialOthersInput = document.getElementById('industrialTypeOthersInput');

        industrialTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Others' && this.checked) {
                    industrialOthersContainer.style.display = 'block';
                    industrialOthersInput.required = true;
                } else {
                    industrialOthersContainer.style.display = 'none';
                    industrialOthersInput.value = '';
                    industrialOthersInput.required = false;
                }
            });
        });
    });
</script>
@endif