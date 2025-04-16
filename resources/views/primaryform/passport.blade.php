<div class="col-span-1">
    <div class="mb-2">
        <div class="mb-2">
            <label class="font-medium">Passport Photo</label>
        </div>
        <div id="passportPhotoContainer" class="border-2 border-dashed border-gray-300 rounded-md p-2 text-center w-32 h-32 flex flex-col items-center justify-center relative">
            <div class="w-24 h-24 border border-gray-200 bg-gray-50 rounded-sm overflow-hidden flex items-center justify-center">
                <i data-lucide="user" class="w-12 h-12 text-gray-300" id="passportPlaceholder"></i>
                <img id="passportPreview" class="hidden w-full h-full object-cover" alt="Passport Preview">
            </div>
            
            <button type="button" id="uploadPassportBtn" class="flex items-center px-2 py-1 text-xs bg-white border border-gray-300 rounded-md mt-2">
                <i data-lucide="upload" class="w-3 h-3 mr-1"></i>
                <span>Upload</span>
            </button>
            <input type="file" id="passportInput" name="passportInput" accept="image/jpeg,image/png" class="hidden">
            
            <p id="photoErrorText" class="text-xs text-red-500 mt-1 hidden"></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadBtn = document.getElementById('uploadPassportBtn');
    const fileInput = document.getElementById('passportInput');
    const preview = document.getElementById('passportPreview');
    const placeholder = document.getElementById('passportPlaceholder');
    const noPhotoText = document.getElementById('noPhotoText');
    const errorText = document.getElementById('photoErrorText');
    
    uploadBtn.addEventListener('click', function() {
        fileInput.click();
    });
    
    fileInput.addEventListener('change', function() {
        // Reset error messages
        errorText.classList.add('hidden');
        errorText.textContent = '';
        
        const file = this.files[0];
        if (file) {
            // Check file type
            if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                errorText.textContent = 'Please upload a JPG or PNG image only';
                errorText.classList.remove('hidden');
                return;
            }
            
            // Check file size (2MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                errorText.textContent = 'Image size should not exceed 2MB';
                errorText.classList.remove('hidden');
                return;
            }
            
            // Create a preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                noPhotoText.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>