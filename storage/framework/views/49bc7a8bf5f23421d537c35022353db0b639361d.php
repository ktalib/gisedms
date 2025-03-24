

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('GIS Data Capture Module')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('GIS Data Capture Module')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/ckeditor/classic/ckeditor.js')); ?>"></script>

    <script>
        if ($('#classic-editor').length > 0) {
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
                console.error(error);
            });
        }
        setTimeout(() => {
            feather.replace();
        }, 500);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- ...existing head code... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            zoom: 88%;
        }

        .record-group {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .record-group h3 {
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
        }

        .modal-xl {
            max-width: 1140px;
        }

        .modal-backdrop {
            background-color: transparent;
        }

        /* Add this line */

        input,
        textarea,
        select {
            text-transform: uppercase;
        }

        .grid-container {
            display: grid;
            /* Adjust the grid layout as needed */
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .record-group {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .record-group legend {
            font-size: 1.125rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: 0;
        }
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">

            <div>
                <div class="card shadow-sm" style="width:100%">
                    <div class="card-body">
                        <form action="<?php echo e(route('propertycard.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                        
                            <!-- Group: OBJECTID * (Identification Details) -->
                            <fieldset class="record-group mb-4">
                                 
                                <div class="grid-container">
                                     
                                    <div class="form-group">
                                        <label for="planid" class="form-label">Plan ID</label>
                                        <input type="text" class="form-control" id="planid" name="planid">
                                    </div>
                                    <div class="form-group">
                                        <label for="mlsfNo" class="form-label">Mlsf No</label>
                                        <input type="text" class="form-control" id="mlsfNo" name="mlsfNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="kangisFileNo" class="form-label">Kangis File No</label>
                                        <input type="text" class="form-control" id="kangisFileNo" name="kangisFileNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="plotNo" class="form-label">Plot No</label>
                                        <input type="text" class="form-control" id="plotNo" name="plotNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="blockNo" class="form-label">Block No</label>
                                        <input type="text" class="form-control" id="blockNo" name="blockNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="approvedPlanNo" class="form-label">Approved Plan No</label>
                                        <input type="text" class="form-control" id="approvedPlanNo" name="approvedPlanNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="tpPlanNo" class="form-label">Tp Plan No</label>
                                        <input type="text" class="form-control" id="tpPlanNo" name="tpPlanNo">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Personnel & Survey Information -->
                            <fieldset class="record-group mb-4">
                                <legend>Personnel & Survey Information</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="surveyedBy" class="form-label">Surveyed By</label>
                                        <input type="text" class="form-control" id="surveyedBy" name="surveyedBy">
                                    </div>
                                    <div class="form-group">
                                        <label for="drawnBy" class="form-label">Drawn By</label>
                                        <input type="text" class="form-control" id="drawnBy" name="drawnBy">
                                    </div>
                                    <div class="form-group">
                                        <label for="checkedBy" class="form-label">Checked By</label>
                                        <input type="text" class="form-control" id="checkedBy" name="checkedBy">
                                    </div>
                                    <div class="form-group">
                                        <label for="passedBy" class="form-label">Passed By</label>
                                        <input type="text" class="form-control" id="passedBy" name="passedBy">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Plot Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Plot Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="plotYearCreated" class="form-label">Plot Year Created</label>
                                        <input type="text" class="form-control" id="plotYearCreated" name="plotYearCreated">
                                    </div>
                                    <div class="form-group">
                                        <label for="beaconControlName" class="form-label">Beacon Control Name</label>
                                        <input type="text" class="form-control" id="beaconControlName" name="beaconControlName">
                                    </div>
                                    <div class="form-group">
                                        <label for="beaconControlX" class="form-label">Beacon Control X</label>
                                        <input type="text" class="form-control" id="beaconControlX" name="beaconControlX">
                                    </div>
                                    <div class="form-group">
                                        <label for="beaconControlY" class="form-label">Beacon Control Y</label>
                                        <input type="text" class="form-control" id="beaconControlY" name="beaconControlY">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Measurement Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Measurement Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="metricSheetIndex" class="form-label">Metric Sheet Index</label>
                                        <input type="text" class="form-control" id="metricSheetIndex" name="metricSheetIndex">
                                    </div>
                                    <div class="form-group">
                                        <label for="metricSheetNo" class="form-label">Metric Sheet No</label>
                                        <input type="text" class="form-control" id="metricSheetNo" name="metricSheetNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="imperialSheet" class="form-label">Imperial Sheet</label>
                                        <input type="text" class="form-control" id="imperialSheet" name="imperialSheet">
                                    </div>
                                    <div class="form-group">
                                        <label for="imperialSheetNo" class="form-label">Imperial Sheet No</label>
                                        <input type="text" class="form-control" id="imperialSheetNo" name="imperialSheetNo">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Location Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Location Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="layoutName" class="form-label">Layout Name</label>
                                        <input type="text" class="form-control" id="layoutName" name="layoutName">
                                    </div>
                                    <div class="form-group">
                                        <label for="districtName" class="form-label">District Name</label>
                                        <input type="text" class="form-control" id="districtName" name="districtName">
                                    </div>
                                    <div class="form-group">
                                        <label for="lgaName" class="form-label">Lga Name</label>
                                        <input type="text" class="form-control" id="lgaName" name="lgaName">
                                    </div>
                                    <div class="form-group">
                                        <label for="streetName" class="form-label">Street Name</label>
                                        <input type="text" class="form-control" id="streetName" name="streetName">
                                    </div>
                                    <div class="form-group">
                                        <label for="houseNo" class="form-label">House No</label>
                                        <input type="text" class="form-control" id="houseNo" name="houseNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="tenancy" class="form-label">Tenancy</label>
                                        <input type="text" class="form-control" id="tenancy" name="tenancy">
                                    </div>
                                    <div class="form-group">
                                        <label for="areaInHectares" class="form-label">Area In Hectares</label>
                                        <input type="text" class="form-control" id="areaInHectares" name="areaInHectares">
                                    </div>
                                    <div class="form-group">
                                        <label for="titleStatus" class="form-label">Title Status</label>
                                        <input type="text" class="form-control" id="titleStatus" name="titleStatus">
                                    </div>
                                    <div class="form-group">
                                        <label for="picture" class="form-label">Picture</label>
                                        <input type="file" class="form-control" id="picture" name="picture">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Title Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Title Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="oldTitleSerialNo" class="form-label">Old Title Serial No</label>
                                        <input type="text" class="form-control" id="oldTitleSerialNo" name="oldTitleSerialNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="oldTitlePageNo" class="form-label">Old Title Page No</label>
                                        <input type="text" class="form-control" id="oldTitlePageNo" name="oldTitlePageNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="oldTitleVolumeNo" class="form-label">Old Title Volume No</label>
                                        <input type="text" class="form-control" id="oldTitleVolumeNo" name="oldTitleVolumeNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="deedsDate" class="form-label">Deeds Date</label>
                                        <input type="date" class="form-control" id="deedsDate" name="deedsDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="deedsTime" class="form-label">Deeds Time</label>
                                        <input type="time" class="form-control" id="deedsTime" name="deedsTime">
                                    </div>
                                    <div class="form-group">
                                        <label for="certificateDate" class="form-label">Certificate Date</label>
                                        <input type="date" class="form-control" id="certificateDate" name="certificateDate">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Allottee & Contact Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Allottee & Contact Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="originalAllottee" class="form-label">Original Allottee</label>
                                        <input type="text" class="form-control" id="originalAllottee" name="originalAllottee">
                                    </div>
                                    <div class="form-group">
                                        <label for="addressOfOriginalAllottee" class="form-label">Address Of Original Allottee</label>
                                        <input type="text" class="form-control" id="addressOfOriginalAllottee" name="addressOfOriginalAllottee">
                                    </div>
                                    <div class="form-group">
                                        <label for="titleIssuedYear" class="form-label">Title Issued Year</label>
                                        <input type="text" class="form-control" id="titleIssuedYear" name="titleIssuedYear">
                                    </div>
                                    <div class="form-group">
                                        <label for="currentAllottee" class="form-label">Current Allottee</label>
                                        <input type="text" class="form-control" id="currentAllottee" name="currentAllottee">
                                    </div>
                                    <div class="form-group">
                                        <label for="addressOfCurrentAllottee" class="form-label">Address Of Current Allottee</label>
                                        <input type="text" class="form-control" id="addressOfCurrentAllottee" name="addressOfCurrentAllottee">
                                    </div>
                                    <div class="form-group">
                                        <label for="titleOfCurrentAllottee" class="form-label">Title Of Current Allottee</label>
                                        <input type="text" class="form-control" id="titleOfCurrentAllottee" name="titleOfCurrentAllottee">
                                    </div>
                                    <div class="form-group">
                                        <label for="currentYearTitleOwned" class="form-label">Current Year Title Owned</label>
                                        <input type="text" class="form-control" id="currentYearTitleOwned" name="currentYearTitleOwned">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNo" class="form-label">Phone No</label>
                                        <input type="text" class="form-control" id="phoneNo" name="phoneNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress">
                                    </div>
                                    <div class="form-group">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" id="occupation" name="occupation">
                                    </div>
                                    <div class="form-group">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Digitization & Work Details -->
                            <fieldset class="record-group mb-4">
                                <legend>Digitization & Work Details</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="parcelNewlyDigitized" class="form-label">Parcel Newly Digitized</label>
                                        <input type="text" class="form-control" id="parcelNewlyDigitized" name="parcelNewlyDigitized">
                                    </div>
                                    <div class="form-group">
                                        <label for="digitizationSource" class="form-label">Digitization Source</label>
                                        <input type="text" class="form-control" id="digitizationSource" name="digitizationSource">
                                    </div>
                                    <div class="form-group">
                                        <label for="workTime" class="form-label">Work Time</label>
                                        <input type="text" class="form-control" id="workTime" name="workTime">
                                    </div>
                                    <div class="form-group">
                                        <label for="electronicSupervisor" class="form-label">Electronic Supervisor</label>
                                        <input type="text" class="form-control" id="electronicSupervisor" name="electronicSupervisor">
                                    </div>
                                    <div class="form-group">
                                        <label for="directorGeneral" class="form-label">Director General</label>
                                        <input type="text" class="form-control" id="directorGeneral" name="directorGeneral">
                                    </div>
                                    <div class="form-group">
                                        <label for="evidenceOfPayment" class="form-label">Evidence Of Payment</label>
                                        <input type="text" class="form-control" id="evidenceOfPayment" name="evidenceOfPayment">
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="transactionDocument" class="form-label">Transaction Document</label>
                                        <input type="text" class="form-control" id="transactionDocument" name="transactionDocument">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Documents -->
                            <fieldset class="record-group mb-4">
                                <legend>Documents</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="passportPhoto" class="form-label">Passport Photo</label>
                                        <input type="file" class="form-control" id="passportPhoto" name="passportPhoto">
                                    </div>
                                    <div class="form-group">
                                        <label for="nationalId" class="form-label">National Id</label>
                                        <input type="file" class="form-control" id="nationalId" name="nationalId">
                                    </div>
                                    <div class="form-group">
                                        <label for="internationalPassport" class="form-label">International Passport</label>
                                        <input type="file" class="form-control" id="internationalPassport" name="internationalPassport">
                                    </div>
                                    <div class="form-group">
                                        <label for="businessRegCert" class="form-label">Business Reg Cert</label>
                                        <input type="file" class="form-control" id="businessRegCert" name="businessRegCert">
                                    </div>
                                    <div class="form-group">
                                        <label for="formCO7AndCO4" class="form-label">Form CO7 And CO4</label>
                                        <input type="file" class="form-control" id="formCO7AndCO4" name="formCO7AndCO4">
                                    </div>
                                    <div class="form-group">
                                        <label for="certOfIncorporation" class="form-label">Cert Of Incorporation</label>
                                        <input type="file" class="form-control" id="certOfIncorporation" name="certOfIncorporation">
                                    </div>
                                    <div class="form-group">
                                        <label for="memorandumAndArticle" class="form-label">Memorandum And Article</label>
                                        <input type="file" class="form-control" id="memorandumAndArticle" name="memorandumAndArticle">
                                    </div>
                                    <div class="form-group">
                                        <label for="letterOfAdmin" class="form-label">Letter Of Admin</label>
                                        <input type="file" class="form-control" id="letterOfAdmin" name="letterOfAdmin">
                                    </div>
                                    <div class="form-group">
                                        <label for="courtAffidavit" class="form-label">Court Affidavit</label>
                                        <input type="file" class="form-control" id="courtAffidavit" name="courtAffidavit">
                                    </div>
                                    <div class="form-group">
                                        <label for="policeReport" class="form-label">Police Report</label>
                                        <input type="file" class="form-control" id="policeReport" name="policeReport">
                                    </div>
                                    <div class="form-group">
                                        <label for="newspaperAdvert" class="form-label">Newspaper Advert</label>
                                        <input type="file" class="form-control" id="newspaperAdvert" name="newspaperAdvert">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <!-- Group: Acknowledgement, Bank & Conflict -->
                            <fieldset class="record-group mb-4">
                                <legend>Acknowledgement, Bank & Conflict</legend>
                                <div class="grid-container">
                                    <div class="form-group">
                                        <label for="acknowledgementStatus" class="form-label">Acknowledgement Status</label>
                                        <input type="text" class="form-control" id="acknowledgementStatus" name="acknowledgementStatus">
                                    </div>
                                    <div class="form-group">
                                        <label for="acknowledgementIssuedDate" class="form-label">Acknowledgement Issued Date</label>
                                        <input type="date" class="form-control" id="acknowledgementIssuedDate" name="acknowledgementIssuedDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="acknowledgementIssuedBy" class="form-label">Acknowledgement Issued By</label>
                                        <input type="text" class="form-control" id="acknowledgementIssuedBy" name="acknowledgementIssuedBy">
                                    </div>
                                    <div class="form-group">
                                        <label for="bankDraftSerialNo" class="form-label">Bank Draft Serial No</label>
                                        <input type="text" class="form-control" id="bankDraftSerialNo" name="bankDraftSerialNo">
                                    </div>
                                    <div class="form-group">
                                        <label for="bankName" class="form-label">Bank Name</label>
                                        <input type="text" class="form-control" id="bankName" name="bankName">
                                    </div>
                                    <div class="form-group">
                                        <label for="conflictExistence" class="form-label">Conflict Existence</label>
                                        <input type="text" class="form-control" id="conflictExistence" name="conflictExistence">
                                    </div>
                                    <div class="form-group">
                                        <label for="problemNature1" class="form-label">Problem Nature 1</label>
                                        <input type="text" class="form-control" id="problemNature1" name="problemNature1">
                                    </div>
                                    <div class="form-group">
                                        <label for="problemNature2" class="form-label">Problem Nature 2</label>
                                        <input type="text" class="form-control" id="problemNature2" name="problemNature2">
                                    </div>
                                    <div class="form-group">
                                        <label for="landUse" class="form-label">Land Use</label>
                                        <input type="text" class="form-control" id="landUse" name="landUse">
                                    </div>
                                    <div class="form-group">
                                        <label for="specifically" class="form-label">Specifically</label>
                                        <input type="text" class="form-control" id="specifically" name="specifically">
                                    </div>
                                </div>
                            </fieldset>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>



            <!-- jQuery and DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script></script>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/propertycard/capture.blade.php ENDPATH**/ ?>