<div id="instrumentModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h4 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Select Instrument type below to begin Registration</h4>
                        <div class="mt-2">
                            <div class="mb-4">
                                <label for="instrumentType" class="block text-xl font-medium text-gray-700">Instrument Types</label>
                                <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="powerOfAttorney" name="instrumentType" value="powerOfAttorney">
                                        <label for="powerOfAttorney" class="mt-2 text-center">Power of Attorney/Irrevocable Power of Attorney</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="DeedOfMortgage" name="instrumentType" value="DeedOfMortgage">
                                        <label for="DeedOfMortgage" class="mt-2 text-center">Deed of Mortgage/Tripartite Mortgage</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfAssignment" name="instrumentType" value="deedOfAssignment">
                                        <label for="deedOfAssignment" class="mt-2 text-center">Deed of Assignment</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfLease" name="instrumentType" value="deedOfLease">
                                        <label for="deedOfLease" class="mt-2 text-center">Deed of Lease</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfSubLease" name="instrumentType" value="deedOfSubLease">
                                        <label for="deedOfSubLease" class="mt-2 text-center">Deed of Sub-Lease</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfSubUnderLease" name="instrumentType" value="deedOfSubUnderLease">
                                        <label for="deedOfSubUnderLease" class="mt-2 text-center">Deed of Sub-Under Lease</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfSubDivision" name="instrumentType" value="deedOfSubDivision">
                                        <label for="deedOfSubDivision" class="mt-2 text-center">Deed of Sub-Division</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfMerger" name="instrumentType" value="deedOfMerger">
                                        <label for="deedOfMerger" class="mt-2 text-center">Deed of Merger</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfSurrender" name="instrumentType" value="deedOfSurrender">
                                        <label for="deedOfSurrender" class="mt-2 text-center">Deed of Surrender</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfVariation" name="instrumentType" value="deedOfVariation">
                                        <label for="deedOfVariation" class="mt-2 text-center">Deed of Variation</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfAssent" name="instrumentType" value="deedOfAssent">
                                        <label for="deedOfAssent" class="mt-2 text-center">Deed of Assent</label>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <input type="radio" id="deedOfRelease" name="instrumentType" value="deedOfRelease">
                                        <label for="deedOfRelease" class="mt-2 text-center">Deed of Release</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Close</button>
           
                <button id="proceedButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Proceed</button>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('registerButton').addEventListener('click', function() {
    document.getElementById('instrumentModal').classList.remove('hidden');
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('instrumentModal').classList.add('hidden');
});

document.getElementById('proceedButton').addEventListener('click', function() {
    var instrumentType = document.querySelector('input[name="instrumentType"]:checked');
    if (instrumentType) {
        var routes = {
            'powerOfAttorney': "<?php echo e(route('instruments.powerOfAttorney')); ?>",
            'DeedOfMortgage': "<?php echo e(route('instruments.DeedOfMortgage')); ?>"
        };
        
        var route = routes[instrumentType.value];
        if (route) {
            window.location.href = route + "?instrumentType=" + instrumentType.value;
        } else {
            alert('Route not defined for the selected instrument type.');
        }
    } else {
        alert('Please select an instrument type.');
    }
});
</script><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/instrument-modal.blade.php ENDPATH**/ ?>