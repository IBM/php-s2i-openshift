<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Summit Health</title>
  <meta name="description" content="Summit Health Admin">
  <meta name="Max Shapiro" content="Summit Health">
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet">
  <link rel="stylesheet" href="style/styles.css?v=1.0">
  <link rel="icon" type="image/png" href="images/summitlogo@2x.png">
</head>

<body>
  <div class="container">
    <div class="banner">
      <div class="control">
        <div class="brand">
          <img class="logo" src="/images/logo.svg" alt="summit health logo">
          <div class="summit">Summit Health</div>
        </div>
        <menu class="menu">
          <menuitem class="lit">management console</menuitem>
          <menuitem class="account">admin</menuitem>
        </menu>
      </div>
    </div>

    <div class="boxes">
		<?php require "dataHandler.php";

			$patients = getPatients();
			$totalPatients = count($patients);
			$diseases = getDiseases();

			$age = [0,0,0,0,0];
			$males = 0;
			$females = 0;

			for($patient = 0; $patient < $totalPatients; $patient++) {

				$patientAge = getAge($patients[$patient]["CA_DOB"]);
				if ($patientAge < 19) {
					$age[0] += 1;
				} elseif ($patientAge < 31) {
					$age[1] += 1;
				} elseif ($patientAge < 51) {
					$age[2] += 1;
				} elseif ($patientAge < 76) {
					$age[3] += 1;
				} else {
					$age[4] += 1;
				}

				if ($patients[$patient]["CA_GENDER"] == "M") {
					$males += 1;
				} else {
					$females += 1;
				}

			} 

	      	echo '<div class="box">
			        <div class="info">
			        	<div><b>Total Patients</b> ' . $totalPatients . '</div>
			        	<div><b>By Gender</b>
			        		<div><b>Male</b> ' . ($males * 100.0)/$totalPatients . '%</div>
			        		<div><b>Females</b> ' . ($females * 100.0)/$totalPatients . '%</div> 
			        	</div>
			        	<div>
			        		<div>
			        			<div><b>0 - 18 yrs:</b> ' . ($age[0] * 100.0)/$totalPatients . '%</div>
			        			<div style="background: #CCEEF2;height:10px;"><div style="background: #00ABC0;width:' . ($age[0] * 100.0)/$totalPatients . '%;height:10px;"></div></div>
			        		</div>
			        		<div>
			        			<div><b>19 - 30 yrs:</b> ' . ($age[1] * 100.0)/$totalPatients . '%</div>
			        			<div style="background: #CCEEF2;height:10px;"><div style="background: #00ABC0;width:' . ($age[1] * 100.0)/$totalPatients . '%;height:10px;"></div></div>
			        		</div>
			        		<div>
			        			<div><b>31 - 50 yrs:</b> ' . ($age[2] * 100.0)/$totalPatients . '%</div>
			        			<div style="background: #CCEEF2;height:10px;"><div style="background: #00ABC0;width:' . ($age[2] * 100.0)/$totalPatients . '%;height:10px;"></div></div>
			        		</div>
			        		<div>
			        			<div><b>51 - 75 yrs:</b> ' . ($age[3] * 100.0)/$totalPatients . '%</div>
			        			<div style="background: #CCEEF2;height:10px;"><div style="background: #00ABC0;width:' . ($age[3] * 100.0)/$totalPatients . '%;height:10px;"></div></div>
			        		</div>
			        		<div>
			        			<div><b>76+ yrs:</b> ' . ($age[4] * 100.0)/$totalPatients . '%</div>
			        			<div style="background: #CCEEF2;height:10px;"><div style="background: #00ABC0;width:' . ($age[4] * 100.0)/$totalPatients . '%;height:10px;"></div></div>
			        		</div>
			        	</div>
			        	<div><b>Diabetes Prevelance</b> '. ($diseases["DIABETES"] * 100.0)/$totalPatients .'%</div>
			        	<div><b>Asthma Prevelance</b> '. ($diseases["ASTHMA"] * 100.0)/$totalPatients .'%</div>
			        </div>
				</div>';

          	echo '<div class="box">
          			<div class="boxheader">
            			<img class="boxicon" src="/images/health.svg">
            			<div class="boxlabel">Patient List ' . $totalPatients . '</div>
          			</div>
          			<div class="info">';

				for($x = 0; $x < $totalPatients; $x++) {
					$gender = "";

					if ($patients[$x]["CA_GENDER"] == "M")
						$gender = "Male";
					else
						$gender = "Female";

				    echo $patients[$x]["CA_FIRST_NAME"] . ' ' . $patients[$x]["CA_LAST_NAME"] . ' - ' . $gender . ' - Age ' . getAge($patients[$x]["CA_DOB"]) . '<br>';
				}
				echo "</div></div>";
		?>
      </div>

    </div>

  </div>

</body>

</html>
