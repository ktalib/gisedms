<script>
    // Selected recipients for bulk SMS
    let primarySelectedRecipients = [];
    let secondarySelectedRecipients = [];
    
    document.addEventListener('DOMContentLoaded', function() {
        const primaryTab = document.getElementById('primaryTab');
        const secondaryTab = document.getElementById('secondaryTab');
        const primaryTabContent = document.getElementById('primaryTabContent');
        const secondaryTabContent = document.getElementById('secondaryTabContent');
        
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        primaryTab.addEventListener('click', function() {
            // Update tab styles
            primaryTab.classList.add('border-blue-500', 'text-blue-600');
            primaryTab.classList.remove('border-transparent', 'text-gray-500');
            secondaryTab.classList.add('border-transparent', 'text-gray-500');
            secondaryTab.classList.remove('border-blue-500', 'text-blue-600');
            
            // Show/hide content
            primaryTabContent.classList.remove('hidden');
            primaryTabContent.classList.add('block');
            secondaryTabContent.classList.add('hidden');
            secondaryTabContent.classList.remove('block');
        });
        
        secondaryTab.addEventListener('click', function() {
            // Update tab styles
            secondaryTab.classList.add('border-blue-500', 'text-blue-600');
            secondaryTab.classList.remove('border-transparent', 'text-gray-500');
            primaryTab.classList.add('border-transparent', 'text-gray-500');
            primaryTab.classList.remove('border-blue-500', 'text-blue-600');
            
            // Show/hide content
            secondaryTabContent.classList.remove('hidden');
            secondaryTabContent.classList.add('block');
            primaryTabContent.classList.add('hidden');
            primaryTabContent.classList.remove('block');
        });

        // Setup the dropdown toggle for the primary message menu
        const openMessageMenuBtn = document.getElementById('openMessageMenuBtn');
        const messageTypeMenu = document.getElementById('messageTypeMenu');
        
        if (openMessageMenuBtn && messageTypeMenu) {
            openMessageMenuBtn.addEventListener('click', function() {
                messageTypeMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!openMessageMenuBtn.contains(event.target) && !messageTypeMenu.contains(event.target)) {
                    messageTypeMenu.classList.add('hidden');
                }
            });
        }
        
        // Setup the dropdown toggle for the secondary message menu
        const openSecondaryMessageMenuBtn = document.getElementById('openSecondaryMessageMenuBtn');
        const secondaryMessageTypeMenu = document.getElementById('secondaryMessageTypeMenu');
        
        if (openSecondaryMessageMenuBtn && secondaryMessageTypeMenu) {
            openSecondaryMessageMenuBtn.addEventListener('click', function() {
                secondaryMessageTypeMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!openSecondaryMessageMenuBtn.contains(event.target) && !secondaryMessageTypeMenu.contains(event.target)) {
                    secondaryMessageTypeMenu.classList.add('hidden');
                }
            });
        }
        
        // Initialize Lucide icons again for newly added elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
    
    // Toggle selection of a customer for bulk SMS
    function toggleCustomerSelection(checkbox, type = 'primary') {
        const customerId = parseInt(checkbox.value);
        const customerName = checkbox.dataset.name;
        
        if (type === 'primary') {
            if (checkbox.checked) {
                if (!primarySelectedRecipients.some(r => r.id === customerId)) {
                    primarySelectedRecipients.push({ id: customerId, name: customerName });
                }
            } else {
                primarySelectedRecipients = primarySelectedRecipients.filter(r => r.id !== customerId);
                document.getElementById('selectAllCheckbox').checked = false;
            }
        } else {
            if (checkbox.checked) {
                if (!secondarySelectedRecipients.some(r => r.id === customerId)) {
                    secondarySelectedRecipients.push({ id: customerId, name: customerName });
                }
            } else {
                secondarySelectedRecipients = secondarySelectedRecipients.filter(r => r.id !== customerId);
                document.getElementById('selectAllSecondaryCheckbox').checked = false;
            }
        }
    }
    
    // Toggle selection of all customers
    function toggleSelectAll(type = 'primary') {
        if (type === 'primary') {
            const selectAll = document.getElementById('selectAllCheckbox').checked;
            const checkboxes = document.querySelectorAll('.customer-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll;
                
                const customerId = parseInt(checkbox.value);
                const customerName = checkbox.dataset.name;
                
                if (selectAll) {
                    if (!primarySelectedRecipients.some(r => r.id === customerId)) {
                        primarySelectedRecipients.push({ id: customerId, name: customerName });
                    }
                }
            });
            
            if (!selectAll) {
                primarySelectedRecipients = [];
            }
        } else {
            const selectAll = document.getElementById('selectAllSecondaryCheckbox').checked;
            const checkboxes = document.querySelectorAll('.secondary-customer-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll;
                
                const customerId = parseInt(checkbox.value);
                const customerName = checkbox.dataset.name;
                
                if (selectAll) {
                    if (!secondarySelectedRecipients.some(r => r.id === customerId)) {
                        secondarySelectedRecipients.push({ id: customerId, name: customerName });
                    }
                }
            });
            
            if (!selectAll) {
                secondarySelectedRecipients = [];
            }
        }
    }
    
    // Call Modal Functions
    function openCallModal(customerId, type = 'primary') {
        // Add a loading indication
        document.getElementById('callCustomerName').textContent = 'Loading...';
        document.getElementById('callCustomerPhone').textContent = '';
        document.getElementById('callCustomerImage').innerHTML = `<span class="text-gray-500">Loading...</span>`;
        
        // Show the modal before the data loads to improve UX
        document.getElementById('callModal').classList.remove('hidden');
        
        // Make the request to get customer data
        fetch(`{{ url('/customer_care/customer') }}/${customerId}?type=${type}`)
            .then(response => response.json())
            .then(data => {
                console.log('Call modal data:', data); // Debugging
                
                if (data.success) {
                    // Update the modal with customer data
                    document.getElementById('callCustomerName').textContent = data.name || 'N/A';
                    document.getElementById('callCustomerPhone').textContent = data.phone_number || 'N/A';
                    
                    if (data.image) {
                        document.getElementById('callCustomerImage').innerHTML = `<img src="${data.image}" alt="Customer" class="w-full h-full object-cover">`;
                    } else {
                        document.getElementById('callCustomerImage').innerHTML = `<span class="text-gray-500">No Image</span>`;
                    }
                    
                    document.getElementById('callRecipientId').value = data.id;
                    document.getElementById('callRecipientType').value = type;
                } else {
                    // Show error and close modal
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to load customer data'
                    });
                    closeCallModal();
                }
            })
            .catch(error => {
                console.error('Error loading customer data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load customer data'
                });
                closeCallModal();
            });
    }
    
    function closeCallModal() {
        document.getElementById('callModal').classList.add('hidden');
    }
    
    function initiateCall() {
        const recipientId = document.getElementById('callRecipientId').value;
        const type = document.getElementById('callRecipientType').value || 'primary';
        
        // Send AJAX request to make call
        fetch('{{ url('/customer_care/make-call') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_id: recipientId,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeCallModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // SMS Modal Functions
    function openSmsModal(customerId, type = 'primary') {
        // Add a loading indication
        document.getElementById('smsCustomerName').textContent = 'Loading...';
        document.getElementById('smsCustomerPhone').textContent = '';
        document.getElementById('smsCustomerImage').innerHTML = `<span class="text-gray-500">Loading...</span>`;
        
        // Show the modal before the data loads to improve UX
        document.getElementById('smsModal').classList.remove('hidden');
        
        // Make the request to get customer data
        fetch(`{{ url('/customer_care/customer') }}/${customerId}?type=${type}`)
            .then(response => response.json())
            .then(data => {
                console.log('SMS modal data:', data); // Debugging
                
                if (data.success) {
                    // Update the modal with customer data
                    document.getElementById('smsCustomerName').textContent = data.name || 'N/A';
                    document.getElementById('smsCustomerPhone').textContent = data.phone_number || 'N/A';
                    
                    if (data.image) {
                        document.getElementById('smsCustomerImage').innerHTML = `<img src="${data.image}" alt="Customer" class="w-full h-full object-cover">`;
                    } else {
                        document.getElementById('smsCustomerImage').innerHTML = `<span class="text-gray-500">No Image</span>`;
                    }
                    
                    document.getElementById('smsRecipientId').value = data.id;
                    document.getElementById('smsRecipientType').value = type;
                } else {
                    // Show error and close modal
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to load customer data'
                    });
                    closeSmsModal();
                }
            })
            .catch(error => {
                console.error('Error loading customer data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load customer data'
                });
                closeSmsModal();
            });
    }
    
    function closeSmsModal() {
        document.getElementById('smsModal').classList.add('hidden');
        document.getElementById('smsMessage').value = '';
    }
    
    function sendSms() {
        const recipientId = document.getElementById('smsRecipientId').value;
        const message = document.getElementById('smsMessage').value;
        const type = document.getElementById('smsRecipientType').value || 'primary';
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        // Send AJAX request to send SMS
        fetch('{{ url('/customer_care/send-sms') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_id: recipientId, 
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeSmsModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Bulk SMS Modal Functions
    function openBulkSmsModal(type = 'primary') {
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientsList = document.getElementById('selectedRecipientsList');
        recipientsList.innerHTML = '';
        
        selectedRecipients.forEach(recipient => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-2';
            item.innerHTML = `
                <span class="truncate max-w-xs">${recipient.name}</span>
                <button type="button" class="text-red-500" onclick="removeRecipient(${recipient.id}, '${type}')">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            `;
            recipientsList.appendChild(item);
        });
        
        document.getElementById('bulkSmsModal').classList.remove('hidden');
        document.getElementById('bulkSmsType').value = type;
        document.getElementById('selectedRecipientCount').textContent = selectedRecipients.length;
        
        // Initialize Lucide icons for newly added elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    
    function removeRecipient(customerId, type = 'primary') {
        if (type === 'primary') {
            primarySelectedRecipients = primarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        } else {
            secondarySelectedRecipients = secondarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.secondary-customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        }
        
        // Update recipients list
        openBulkSmsModal(type);
    }
    
    function closeBulkSmsModal() {
        document.getElementById('bulkSmsModal').classList.add('hidden');
        document.getElementById('bulkSmsMessage').value = '';
    }
    
    function sendBulkSms() {
        const message = document.getElementById('bulkSmsMessage').value;
        const type = document.getElementById('bulkSmsType').value || 'primary';
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientIds = selectedRecipients.map(r => r.id);
        
        // Send AJAX request to send bulk SMS
        fetch('{{ url('/customer_care/send-bulk-sms') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_ids: recipientIds, 
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeBulkSmsModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // WhatsApp Modal Functions
    function openWhatsAppModal(customerId, type = 'primary') {
        // Add a loading indication
        document.getElementById('whatsAppCustomerName').textContent = 'Loading...';
        document.getElementById('whatsAppCustomerPhone').textContent = '';
        document.getElementById('whatsAppCustomerImage').innerHTML = `<span class="text-gray-500">Loading...</span>`;
        
        // Show the modal before the data loads to improve UX
        document.getElementById('whatsAppModal').classList.remove('hidden');
        
        // Make the request to get customer data
        fetch(`{{ url('/customer_care/customer') }}/${customerId}?type=${type}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the modal with customer data
                    document.getElementById('whatsAppCustomerName').textContent = data.name || 'N/A';
                    document.getElementById('whatsAppCustomerPhone').textContent = data.phone_number || 'N/A';
                    
                    if (data.image) {
                        document.getElementById('whatsAppCustomerImage').innerHTML = `<img src="${data.image}" alt="Customer" class="w-full h-full object-cover">`;
                    } else {
                        document.getElementById('whatsAppCustomerImage').innerHTML = `<span class="text-gray-500">No Image</span>`;
                    }
                    
                    document.getElementById('whatsAppRecipientId').value = data.id;
                    document.getElementById('whatsAppRecipientType').value = type;
                } else {
                    // Show error and close modal
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to load customer data'
                    });
                    closeWhatsAppModal();
                }
            })
            .catch(error => {
                console.error('Error loading customer data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load customer data'
                });
                closeWhatsAppModal();
            });
    }
    
    function closeWhatsAppModal() {
        document.getElementById('whatsAppModal').classList.add('hidden');
        document.getElementById('whatsAppMessage').value = '';
    }
    
    function sendWhatsApp() {
        const recipientId = document.getElementById('whatsAppRecipientId').value;
        const message = document.getElementById('whatsAppMessage').value;
        const type = document.getElementById('whatsAppRecipientType').value || 'primary';
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        // Send AJAX request to send WhatsApp
        fetch('{{ url('/customer_care/send-whatsapp') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_id: recipientId, 
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeWhatsAppModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Email Modal Functions
    function openEmailModal(customerId, type = 'primary') {
        // Add a loading indication
        document.getElementById('emailCustomerName').textContent = 'Loading...';
        document.getElementById('emailCustomerEmail').textContent = '';
        document.getElementById('emailCustomerImage').innerHTML = `<span class="text-gray-500">Loading...</span>`;
        
        // Show the modal before the data loads to improve UX
        document.getElementById('emailModal').classList.remove('hidden');
        
        // Make the request to get customer data
        fetch(`{{ url('/customer_care/customer') }}/${customerId}?type=${type}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the modal with customer data
                    document.getElementById('emailCustomerName').textContent = data.name || 'N/A';
                    document.getElementById('emailCustomerEmail').textContent = data.email || 'N/A';
                    
                    if (data.image) {
                        document.getElementById('emailCustomerImage').innerHTML = `<img src="${data.image}" alt="Customer" class="w-full h-full object-cover">`;
                    } else {
                        document.getElementById('emailCustomerImage').innerHTML = `<span class="text-gray-500">No Image</span>`;
                    }
                    
                    document.getElementById('emailRecipientId').value = data.id;
                    document.getElementById('emailRecipientType').value = type;
                } else {
                    // Show error and close modal
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to load customer data'
                    });
                    closeEmailModal();
                }
            })
            .catch(error => {
                console.error('Error loading customer data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load customer data'
                });
                closeEmailModal();
            });
    }
    
    function closeEmailModal() {
        document.getElementById('emailModal').classList.add('hidden');
        document.getElementById('emailSubject').value = '';
        document.getElementById('emailMessage').value = '';
    }
    
    function sendEmail() {
        const recipientId = document.getElementById('emailRecipientId').value;
        const subject = document.getElementById('emailSubject').value;
        const message = document.getElementById('emailMessage').value;
        const type = document.getElementById('emailRecipientType').value || 'primary';
        
        if (!subject.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Subject',
                text: 'Please enter a subject'
            });
            return;
        }
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        // Send AJAX request to send Email
        fetch('{{ url('/customer_care/send-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_id: recipientId,
                subject: subject,
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeEmailModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Bulk Email Modal Functions
    function openBulkEmailModal(type = 'primary') {
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientsList = document.getElementById('selectedEmailRecipientsList');
        recipientsList.innerHTML = '';
        
        selectedRecipients.forEach(recipient => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-2';
            item.innerHTML = `
                <span class="truncate max-w-xs">${recipient.name}</span>
                <button type="button" class="text-red-500" onclick="removeEmailRecipient(${recipient.id}, '${type}')">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            `;
            recipientsList.appendChild(item);
        });
        
        document.getElementById('bulkEmailModal').classList.remove('hidden');
        document.getElementById('bulkEmailType').value = type;
        document.getElementById('selectedEmailRecipientCount').textContent = selectedRecipients.length;
        
        // Initialize Lucide icons for newly added elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    
    function removeEmailRecipient(customerId, type = 'primary') {
        if (type === 'primary') {
            primarySelectedRecipients = primarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        } else {
            secondarySelectedRecipients = secondarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.secondary-customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        }
        
        // Update recipients list
        openBulkEmailModal(type);
    }
    
    function closeBulkEmailModal() {
        document.getElementById('bulkEmailModal').classList.add('hidden');
        document.getElementById('bulkEmailSubject').value = '';
        document.getElementById('bulkEmailMessage').value = '';
    }
    
    function sendBulkEmail() {
        const subject = document.getElementById('bulkEmailSubject').value;
        const message = document.getElementById('bulkEmailMessage').value;
        const type = document.getElementById('bulkEmailType').value || 'primary';
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (!subject.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Subject',
                text: 'Please enter a subject'
            });
            return;
        }
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientIds = selectedRecipients.map(r => r.id);
        
        // Send AJAX request to send bulk Email
        fetch('{{ url('/customer_care/send-bulk-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_ids: recipientIds, 
                subject: subject,
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeBulkEmailModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Bulk WhatsApp Modal Functions
    function openBulkWhatsAppModal(type = 'primary') {
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientsList = document.getElementById('selectedWhatsAppRecipientsList');
        recipientsList.innerHTML = '';
        
        selectedRecipients.forEach(recipient => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-2';
            item.innerHTML = `
                <span class="truncate max-w-xs">${recipient.name}</span>
                <button type="button" class="text-red-500" onclick="removeWhatsAppRecipient(${recipient.id}, '${type}')">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            `;
            recipientsList.appendChild(item);
        });
        
        document.getElementById('bulkWhatsAppModal').classList.remove('hidden');
        document.getElementById('bulkWhatsAppType').value = type;
        document.getElementById('selectedWhatsAppRecipientCount').textContent = selectedRecipients.length;
        
        // Initialize Lucide icons for newly added elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    
    function removeWhatsAppRecipient(customerId, type = 'primary') {
        if (type === 'primary') {
            primarySelectedRecipients = primarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        } else {
            secondarySelectedRecipients = secondarySelectedRecipients.filter(r => r.id !== customerId);
            
            // Update checkboxes
            document.querySelectorAll('.secondary-customer-checkbox').forEach(checkbox => {
                if (parseInt(checkbox.value) === customerId) {
                    checkbox.checked = false;
                }
            });
        }
        
        // Update recipients list
        openBulkWhatsAppModal(type);
    }
    
    function closeBulkWhatsAppModal() {
        document.getElementById('bulkWhatsAppModal').classList.add('hidden');
        document.getElementById('bulkWhatsAppMessage').value = '';
    }
    
    function sendBulkWhatsApp() {
        const message = document.getElementById('bulkWhatsAppMessage').value;
        const type = document.getElementById('bulkWhatsAppType').value || 'primary';
        const selectedRecipients = type === 'primary' ? primarySelectedRecipients : secondarySelectedRecipients;
        
        if (!message.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Message',
                text: 'Please enter a message'
            });
            return;
        }
        
        if (selectedRecipients.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Recipients',
                text: 'Please select at least one recipient'
            });
            return;
        }
        
        const recipientIds = selectedRecipients.map(r => r.id);
        
        // Send AJAX request to send bulk WhatsApp
        fetch('{{ url('/customer_care/send-bulk-whatsapp') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                recipient_ids: recipientIds, 
                message: message,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message
                });
                closeBulkWhatsAppModal();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Individual Outreach Functions
    function promptForIndividualOutreach(type, tabType = 'primary') {
        const checkboxSelector = tabType === 'primary' ? '.customer-checkbox:checked' : '.secondary-customer-checkbox:checked';
        const selectedCheckboxes = document.querySelectorAll(checkboxSelector);
        
        // Check if any customers are selected
        if (selectedCheckboxes.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Customer Selected',
                text: 'Please select a customer from the table first.'
            });
            return;
        }
        
        // Check if multiple customers are selected
        if (selectedCheckboxes.length > 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Multiple Customers Selected',
                text: 'Please select only one customer for individual outreach.'
            });
            return;
        }
        
        // Get the selected customer ID
        const customerId = selectedCheckboxes[0].value;
        
        // Perform the appropriate action
        switch(type) {
            case 'call':
                openCallModal(customerId, tabType);
                break;
            case 'sms':
                openSmsModal(customerId, tabType);
                break;
            case 'email':
                openEmailModal(customerId, tabType);
                break;
        }
    }
</script>