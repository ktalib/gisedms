<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Offer of Grant/Conveyance of Approval</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 3px; /* Further reduced padding */
            font-size: 12px; /* Reduced base font size */
        }
        .header {
            margin-bottom: 3px; /* Further reduced margin */
        }
        .address-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px; /* Further reduced margin */
        }
        .address-box {
            border: 1px solid #000;
            padding: 3px; /* Further reduced padding */
            width: 45%;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin: 5px 0; /* Further reduced margin */
            font-size: 12px; /* Further reduced font size */
        }
        .content-box {
            border: 1px solid #000;
            padding: 3px; /* Further reduced padding */
        }
        .conditions {
            margin-left: 3px; /* Further reduced margin */
        }
        .condition-item {
            margin-bottom: 2px; /* Further reduced margin */
        }
        .sub-condition {
            margin-left: 3px; /* Further reduced margin */
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 5px; /* Further reduced margin */
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 80px; /* Further reduced width */
            margin-top: 2px; /* Further reduced margin */
            text-align: center;
        }
        input[type="text"] {
            border: none;
            border-bottom: 1px solid #000;
            width: 100%;
            margin-bottom: 2px; /* Further reduced margin */
            font-size: 10px; /* Reduced input font size */
        }
        .checkbox {
            margin-right: 1px; /* Further reduced margin */
        }
        .header2 {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px; /* Further reduced margin */
        }
        .commissioner-box {
            border: 1px solid #4CAF50;
            padding: 3px; /* Further reduced padding */
            width: 45%;
            border-radius: 3px; /* Further reduced border radius */
            position: relative;
        }
        .date-box {
            border: 1px solid #000;
            padding: 3px; /* Further reduced padding */
            width: 45%;
        }
        .content {
            text-align: justify;
            margin-bottom: 5px; /* Further reduced margin */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px; /* Further reduced margin */
            font-size: 10px; /* Reduced table font size */
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 2px; /* Further reduced padding */
            text-align: left;
        }
        .checkbox-container {
            margin-bottom: 3px; /* Further reduced margin */
        }
        .checkbox-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2px; /* Further reduced margin */
        }
        .checkbox {
            display: inline-block;
            width: 8px; /* Further reduced size */
            height: 8px; /* Further reduced size */
            border: 1px solid #4CAF50;
            margin-right: 2px; /* Further reduced margin */
        }
        .checkbox-text {
            flex: 1;
            font-size: 10px; /* Reduced checkbox text font size */
        }
        .note-box {
            display: flex;
            border: 1px solid #000;
            margin-top: 5px; /* Further reduced margin */
        }
        .note-left {
            width: 70%;
            padding: 2px; /* Further reduced padding */
            border-right: 1px solid #000;
            font-size: 10px; /* Reduced note font size */
        }
        .note-right {
            width: 30%;
            padding: 2px; /* Further reduced padding */
        }
    </style>
</head>
<body>
    <img src="<?php echo e(asset('assets/logo/logo1.jpg')); ?>" alt="Right Logo" style="float: right; width: 60px; height: auto;"> <!-- Further reduced size -->
    <img src="<?php echo e(asset('assets/logo/logo2.jpg')); ?>" alt="Left Logo" style="float: left; width: 60px; height: auto;"> <!-- Further reduced size -->

    <br><br><br><br><br><br><br><br>

    <div class="header">
        <h2>TO</h2>
    </div>

    <div class="address-container">
        <div class="address-box">
            <div>
                <label for="name">NAME</label>
                <input type="text" id="name" value="<?php echo e($application->applicant_title ?? ''); ?> <?php echo e($application->first_name ?? ''); ?> <?php echo e($application->middle_name ?? ''); ?> <?php echo e($application->surname ?? ''); ?>">
            </div>
            <div>
                <label for="address1">ADDRESS</label>
               
            </div>
            
        </div>

        <div class="address-box">
            <div>
                <label for="rofo">R OF O NO.</label>
                <input type="text" id="rofo">
            </div>
            <div>
                <label for="shop">SHOP/HOUSE NO.</label>
                <input type="text" id="shop" value="<?php echo e($application->plot_house_no ?? ''); ?>">
            </div>
            <div>
                <label for="floor">FLOOR NO.</label>
                 
            </div>
            <div>
                <label for="location">LOCATION.</label>
                 
            </div>
        </div>
    </div>

    <div class="title">
        TERMS OF OFFER OF GRANT/CONVEYANCE OF APPROVAL
    </div>

    <div class="content-box">
        <p>
            Reference to your application dated........20.............. I am directed to inform you that, The Governor of Kano State has approved
            the Grant of a Right of occupancy to you over a shop/plot No......Block No...... Floor No..... Situated at..........as per plan No ...................... 
            on the following conditions.
        </p>

        <div class="conditions">
            <div class="condition-item">
                1.payment of
                <div class="sub-condition">
                    a.Ground rent N.................
                </div>
                <div class="sub-condition">
                    b.Development Charges .................. (payable only once)
                </div>
                <div class="sub-condition">
                    c.Survey and processing fees .................
                </div>
            </div>

            <div class="condition-item">
                2.
                <div class="sub-condition">
                    a.Term...............................................
                </div>
                <div class="sub-condition">
                    b.Purpose..........................................
                </div>
                <div class="sub-condition">
                    c.Value of improvements thereon....... Within......... years
                </div>
            </div>

            <div class="condition-item">
                3.Not to alienate the Right of Occupancy in part or whole without the written consent of the Governor
            </div>

            <div class="condition-item">
                4.To be responsible for the development, maintenance and general beautifications of the frontage of the subject property
            </div>

            <div class="condition-item">
                5.Not to erect or permit to be erected on the subject land any building or development except in accordance with plans and specifications
                approved by the state Planning Authority in the case of urban areas or the ministry of Land and Physical Planning the case of rural areas.
            </div>

            <div class="condition-item">
                6.To Complete Development on Land Within ..................... Years
            </div>

            <div class="condition-item">
                7.To become joint owner of the common property of the sectional Title land and actively participate in all quotas that benefit or burden sections
            </div>

            <div class="condition-item">
                8.To exclusively use certain parts and share undivided sections of the common property e.g. Garage, Garden, Parking space, Storeroom
                among others.
            </div>

            <div class="condition-item">
                9.This letter of Grant must be returned immediately duly accepted with the required fees to enable production of C OF O, otherwise the offer
                lapses.
            </div>
        </div>

        <div class="signature-section">
            <div>
                <div class="signature-line">
                    HONOURABLE COMMISIONER
                </div>
            </div>
            <div>
                <div class="signature-line">
                    DATE
                </div>
            </div>
        </div>
    </div>

<hr>
<br><br><br><br>
    <div class="container">
        <div class="header2">
            <div class="commissioner-box">
                <p>The Honorable Commissioner<br>
                Ministry of Land and Physical Planning</p>
            </div>
            <div class="date-box">
                
                <label for="date">Date</label>
               
            </div>
        </div>

        <div class="title">
            ACCEPTANCE LETTER
        </div>
        <div class="content">
            Reference to the offer of Grant, I hereby accept the terms and condition of the grant of right of
            occupancy as conveyed to me by your overleaf quoted letter.
        </div>

        <table>
            <tr>
                <td>Land Use</td>
                <td>Survey / Processing Fees</td>
                <td>Dev. Charges N</td>
            </tr>
            <tr>
                <td>
                    a.Residential Fees<br>
                    i.Processing Fee<br>
                    b.Survey Fees<br>
                    i.Block of Flats<br>
                    ii.Appartment<br>
                    c.Assignment Fees<br>
                    d.Bill Balance<br>
                    e.Commercial Fees<br>
                    i.Processing Fee<br>
                    ii.Survey Fees<br>
                    iii.Assignment Fees<br>
                    iv.Bill Balance
                </td>
                <td>
                    <br>
                    N 20,000.00K<br>
                    <br>
                    N 50,000.00K<br>
                    N 70,000.00K<br>
                    N 50,000.00<br>
                    N 30,525.00K<br>
                    <br>
                    N 50,000.00K<br>
                    N 100,000.00K<br>
                    N 100,000.00K<br>
                    N 30,525.00K
                </td>
                <td></td>
            </tr>
            <tr>
                <td>One year Ground Rent</td>
                <td>₦ <input type="text" style="width: 70%;"></td>
                <td>₦<input type="text" style="width: 70%;"></td>
            </tr>
            <tr>
                <td colspan="3">TOTAL ₦ <input type="text" style="width: 70%;"></td>
            </tr>
        </table>

        <div class="checkbox-container">
            <div class="checkbox-item">
                <div class="checkbox"></div>
                <div class="checkbox-text">I require the Director Survey to carry out the land survey for me</div>
            </div>
            <div class="checkbox-item">
                <div class="checkbox"></div>
                <div class="checkbox-text">I require a licensed Surveyor to carry out the land survey for me</div>
            </div>
        </div>

        <div class="note-box">
            <div class="note-left">
                <p>*NOTE</p>
                <p>APPLICANT TO RETAIN ORIGINAL AND RETURN 2</p>
                <p>COPIES AFTER SIGNING HIS/HER ACCEPTANCE OF THE</p>
            </div>
            <div class="note-right">
                <input type="text" style="height: 40px;"> <!-- Further reduced height -->
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\wamp64\www\gisedms\resources\views/sectionaltitling/AcceptLetter.blade.php ENDPATH**/ ?>