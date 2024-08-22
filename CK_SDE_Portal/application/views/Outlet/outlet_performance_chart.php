<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Program Outlets Performance</title>
	
    <?php include('application/views/layouts/common_css_links.php'); ?>

    <style>
        /* Customize the label style for "Rising Star" */
        


        .rising_star{
            background-color: #bab4b452;
            padding: 4px 15px;
            margin-left: 31px;
            font-size: 16px;
        }

        .rising_balanced{
            background-color: #bab4b452;
            padding: 4px 15px;
            margin-left: 10px;
            font-size: 16px;
        }

        #halfDoughtName{
            position: absolute; 
            top: 63%; 
            left: 33%; 
            transform: translate(-50%, -50%); 
            font-size: 17px;
        }

        #halfDoughtName2{
            position: absolute; 
            top: 63%; 
            left: 33%; 
            transform: translate(-50%, -50%); 
            font-size: 17px;
        }

        table {
            border-collapse: separate;
            border-radius: 6px;
            border-spacing: 0px;
        }

        /* @media screen (min-width: 80px) and (max-width: 1080px) { */

        @media only screen and (min-device-width: 81px) and (max-device-width: 1024px) {

            #halfDoughtName{
                position: absolute; 
                top: 63%; 
                left: 47%; 
                transform: translate(-50%, -50%); 
                font-size: 17px;
            }

            #halfDoughtName2{
                position: absolute; 
                top: 63%; 
                left: 46%; 
                transform: translate(-50%, -50%); 
                font-size: 17px;
            }


        }

    </style>

</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
        <?php include('application/views/layouts/sidebar.php'); ?>

		<!--end sidebar-wrapper-->
		<!--header-->
        <?php include('application/views/layouts/topbar.php'); ?>
		
		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					
                    <div class="row">
						<div class="col-12 col-lg-12 col-md-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="mb-0">Outlets Performance Chart</h4>
                                                <input type="hidden" name="mobile_no" id="mobile_no" value="<?php echo $this->session->userdata('mobile'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>JTD Billed</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="width: 300px; height: 300px; position: relative;">
                                            <canvas id="myDoubleDoughnutChart"></canvas>
                                            <div id="percentageLabel" style="position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); font-size: 17px;"></div>
                                            <div id="percentageLabel2" style="position: absolute; top: 65%; left: 50%; transform: translate(-50%, -50%); font-size: 17px;"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Value Target vs Achieved</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="width: 300px; height: 250px;margin-left: 20px;">
                                                <canvas id="myHalfCircleDoughnutChart"></canvas>
                                                <div id="halfDoughtName" ></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-5 rising_star">Achieved : <span id="rising_star"></span></div>
                                                <div class="col-md-3 col-5 rising_balanced">Balanced : <span id="rising_balanced"></span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div style="width: 300px; height: 250px;margin-left: 20px;">
                                                <canvas id="myHalfCircleDoughnutChart2"></canvas>
                                                <div id="halfDoughtName2" ></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-5 rising_star">Achieved : <span id="smart_outlets"></span></div>
                                                <div class="col-md-3 col-5 rising_balanced">Balanced : <span id="outlets_balanced"></span></div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Growth LM JTD</h4>
                                        </div>
                                       
                                        <div class="col-md-4 mt-4">
                                          <table class="table table-borderless" style="border:1px #13d913b3 solid;    margin-left: 17px;">
                                            <thead style="background-color: #13d913b3;">
                                                <tr>
                                                    <td class="text-white">Rising Star</td>
                                                    <td class="text-white">13%</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Value Achieved LM JTD</td>
                                                    <td><div id="value_achieved_lm" >7</div></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4 mt-4">
                                            <table class="table table-borderless" style="border:1px #f04949b5 solid;">
                                                <thead style="background-color: #f04949b5;">
                                                    <tr>
                                                        <td class="text-white">Smart Outlets</td>
                                                        <td class="text-white">20%</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Value Achieved LM JTD</td>
                                                        <td><div id="value_achieved_lm" >10</div></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <hr />
                                </div>
                            </div>
						</div>
						
					</div>
					
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
		<!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->
        <?php include('application/views/layouts/footer.php'); ?>
		
		<!-- end footer -->
	</div>
	<!-- end wrapper -->
	
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
    <?php include('application/views/layouts/common_script_links.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>
        $(document).ready(function () {
           
            $(".eform_m2").addClass("mm-active");
        });

        // Sample data for the double doughnut chart

        // Desired percentage to fill the doughnut chart (e.g., 75%)
        var fillPercentage = 75;
        var fillPercentage2 = 40;

        // Calculate the dataset values based on the desired percentage
        var fillValue = fillPercentage;
        var fillValue2 = fillPercentage2;
        var emptyValue = 100 - fillPercentage;
        var emptyValue2 = 100 - fillPercentage2;

        var labels = [
            'Rising Star', // Label for the first dataset (fillValue)
            'Smart Outlets', // Label for the second dataset (fillValue2)
            'Value Target', // Label for the first dataset (emptyValue)
        ];

        var data = {
        labels: labels,
        datasets: [
                {
                    data: [fillValue,0, emptyValue],
                    backgroundColor: ['#673ab7cc', '#3a89b7d6', '#e6e2ec'],
                    borderWidth: 1, 
                    borderAlign: 'inner', 
                },
                { 
                    weight: 0.2
                },
                {
                    data: [0, fillValue2, emptyValue2],
                    backgroundColor: ['#673ab7cc','#3a89b7d6', 'lightgray'],
                },
            ],
        };

        // Configuration options for the chart
        var options = {
            legend: {
                display: true, // Set to true to display the legend
                position: 'bottom', // You can change the legend position (top, left, right, bottom)
                labels: {
                    fontColor: 'black', // Set the font color of the legend labels
                    fontSize: 10, // Set the font size of the legend labels
                    boxWidth: 0, // Set the width of the legend color boxes
                    padding: 2, // Set padding between legend items
                },
            },
        };

        // Create the double doughnut chart
        var ctx = document.getElementById('myDoubleDoughnutChart').getContext('2d');
        var myDoubleDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options,
        });

        // Display the fill percentage
        var percentageLabel = document.getElementById('percentageLabel');
        percentageLabel.textContent = 'Completed';
        var percentageLabel2 = document.getElementById('percentageLabel2');
        percentageLabel2.innerHTML = '<div class="row"><p style="color:#673ab7cc;">'+fillPercentage +'% </p><p style="color:#3a89b7d6;">' +fillPercentage2 + '% </p></div>';




        // --------------------JTD Billed Chart Completed ----------------------------------


        // Sample data for the half-circle doughnut chart
        var rising_achieved = 7;
        var rising_balanced = 3;
        $('#rising_star').html(rising_achieved);
        $('#rising_balanced').html(rising_balanced);
        var hdata = {
            labels: ['Achieved', 'Balanced'],
            datasets: [
                {
                    data: [70, 30], // Adjust the values as needed
                    backgroundColor: ['#673ab7cc', 'lightgray'],
                    borderWidth: 0,
                    borderAlign: 'inner',
                },
                { 
                    weight: 0.2
                },
            ],
        };

        // Configuration options for the half-circle doughnut chart
        var hoptions = {
            cutoutPercentage: 50, // Set to 50 to create a half-circle
            rotation: -Math.PI, // Rotate the chart to start from the top
            circumference: Math.PI, // Set the circumference to Math.PI to create a half-circle
            rotation: -90,
            circumference: 180,
            cutout: "70%",
            legend: {
                display: true,
                position: 'bottom',
            },
        };

        // Create the half-circle doughnut chart
        var hctx = document.getElementById('myHalfCircleDoughnutChart').getContext('2d');
        var myHalfCircleDoughnutChart = new Chart(hctx, {
            type: 'doughnut',
            data: hdata,
            options: hoptions,
        });

        var halfDoughtName = document.getElementById('halfDoughtName');
        halfDoughtName.textContent = 'Rising Star';


        // ------------------------ Smart Outlets chart ------------------------------------------------

        // Sample data for the half-circle doughnut chart
        var outlets_achieved = 8;
        var outlets_balanced = 2;
        $('#smart_outlets').html(outlets_achieved);
        $('#outlets_balanced').html(outlets_balanced);
        var sdata = {
            labels: ['Achieved', 'Balanced'],
            datasets: [
                {
                    data: [35, 65], // Adjust the values as needed
                    backgroundColor: ['#3a89b7d6', 'lightgray'],
                    borderWidth: 0,
                    borderAlign: 'inner',
                },
                { 
                    weight: 0.2
                },
            ],
        };

        // Configuration options for the half-circle doughnut chart
        var soptions = {
            cutoutPercentage: 50, // Set to 50 to create a half-circle
            rotation: -Math.PI, // Rotate the chart to start from the top
            circumference: Math.PI, // Set the circumference to Math.PI to create a half-circle
            rotation: -90,
            circumference: 180,
            cutout: "70%",
            legend: {
                display: true,
                position: 'bottom',
            },
        };

        // Create the half-circle doughnut chart
        var sctx = document.getElementById('myHalfCircleDoughnutChart2').getContext('2d');
        var myHalfCircleDoughnutChart2 = new Chart(sctx, {
            type: 'doughnut',
            data: sdata,
            options: soptions,
        });

        var halfDoughtName2 = document.getElementById('halfDoughtName2');
        halfDoughtName2.textContent = 'Smart Outlets';



    </script>
</body>

</html>