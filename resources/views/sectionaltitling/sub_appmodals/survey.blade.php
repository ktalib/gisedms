     
            <div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Survey Department Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="surveyForm">
                                <div class="row g-3">
                                    <!-- First row -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Survey By</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Second row - Drawn By -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Drawn By</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Third row - Checked By -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Checked By</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Fourth row - Approved By -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Approved By</label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewSurveyPlanModal">
                                        <i class="material-icons" style="font-size: 16px; vertical-align: middle;">map</i> View Survey Plan
                                    </button>

                                </div>

                                <div class="modal-footer" style="background-color: #f1f1f1;">
                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                                        <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" 
                                            style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                            OK
                                            <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                                        </button>
                                        <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')"
                                            style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                            Edit
                                            <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                                        </button>
                                        <button type="submit" class="bttn green-shadow"
                                            style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                            Submit
                                            <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
 

         
                                    <!-- View Survey Plan Modal -->
                                    <div class="modal fade" id="viewSurveyPlanModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Survey Plan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Dummy image for demonstration -->
                                                    <div class="text-center">
                                                        <img src="{{ asset(Storage::url('uploads')).'/survey.jpeg' }}" alt="Survey Plan" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                                    <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                                        Close
                                                        <i class="material-icons" style="color: #9E9E9E;">close</i>
                                                    </button>
                                                    <button type="button" class="bttn blue-shadow" onclick="printSurveyPlan()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                                        Print Survey Plan
                                                        <i class="material-icons" style="color: #3F51B5;">print</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function printSurveyPlan() {
                                            // Create a new window with just the image content
                                            const printWindow = window.open('', '_blank');
                                            printWindow.document.write('<html><head><title>Survey Plan</title></head><body>');
                                            printWindow.document.write('<img src="{{ asset('storage/uploads/survey.jpeg') }}" style="width: 100%;">');
                                            printWindow.document.write('</body></html>');
                                            printWindow.document.close();
                                            printWindow.focus();
                                            printWindow.print();
                                            printWindow.close();
                                        }
                                    </script>