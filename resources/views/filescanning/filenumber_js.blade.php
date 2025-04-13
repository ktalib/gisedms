<script>
    // Tab switching function
    function openFileTab(evt, tabName) {
        // Hide all tab content
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active");
        }

        // Remove active class from all tab buttons
        var tablinks = document.getElementsByClassName("tablinks");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the current tab and add active class to the button
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    // Format MLS file number preview
    function updateMlsFileNumberPreview() {
        const prefixEl = document.getElementById('mlsFileNoPrefix');
        const numberEl = document.getElementById('mlsFileNumber');
        const previewEl = document.getElementById('mlsPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            previewEl.value = prefix + '-' + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }

    // Format KANGIS file number preview
    function updateKangisFileNumberPreview() {
        const prefixEl = document.getElementById('kangisFileNoPrefix');
        const numberEl = document.getElementById('kangisFileNumber');
        const previewEl = document.getElementById('kangisPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            // Pad to 5 digits
            number = number.padStart(5, '0');
            numberEl.value = number;
            previewEl.value = prefix + ' ' + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }

    // Format New KANGIS file number preview
    function updateNewKangisFileNumberPreview() {
        const prefixEl = document.getElementById('newKangisFileNoPrefix');
        const numberEl = document.getElementById('newKangisFileNumber');
        const previewEl = document.getElementById('newKangisPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            previewEl.value = prefix + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }

    // AJAX form submissions
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize file number previews
        updateMlsFileNumberPreview();
        updateKangisFileNumberPreview();
        updateNewKangisFileNumberPreview();

        // Add event listeners for file number preview updates
        document.getElementById('mlsFileNoPrefix').addEventListener('change', updateMlsFileNumberPreview);
        document.getElementById('mlsFileNumber').addEventListener('input', updateMlsFileNumberPreview);

        document.getElementById('kangisFileNoPrefix').addEventListener('change', updateKangisFileNumberPreview);
        document.getElementById('kangisFileNumber').addEventListener('input', updateKangisFileNumberPreview);

        document.getElementById('newKangisFileNoPrefix').addEventListener('change',
            updateNewKangisFileNumberPreview);
        document.getElementById('newKangisFileNumber').addEventListener('input',
            updateNewKangisFileNumberPreview);



    });
</script>
