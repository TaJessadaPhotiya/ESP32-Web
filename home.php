<!DOCTYPE HTML>
<html>
  <head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fontawesome.com/v5/icons/battery-half?f=classic&s=solid">
    <link rel="icon" href="data:,">

    <!-- เฟรทข้อมูลทุกๆ 5 วินาที -->
    <script>
          // ฟังก์ชันสำหรับอัปเดตข้อมูลจากเซิร์ฟเวอร์
          function updateData() {
            // ใช้ AJAX เรียกสคริปต์ PHP สำหรับอัปเดตข้อมูล
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "update_data.php", true);

            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                // เมื่อสำเร็จในการเรียกข้อมูล
                var data = JSON.parse(xhr.responseText);

                // อัปเดตข้อมูลบนหน้าเว็บ
                document.getElementById("temperatureValue").textContent = data.Ds;
                document.getElementById("ultrasonicValue").textContent = data.Ult;
                document.getElementById("phsensorValue").textContent = data.Ph;
                document.getElementById("DateValue").textContent = data.Date;
                document.getElementById("TimeValue").textContent = data.Time;

                // เรียกใช้ฟังก์ชันนี้ใหม่ทุก 5 วินาที
                setTimeout(updateData, 5000);
              }
            };

            xhr.send();
          }

          // เรียกใช้งานฟังก์ชันเพื่อเริ่มต้นการอัปเดตข้อมูล
          updateData();
    </script>
      
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.7rem;}
      h4 {font-size: 1rem;}
      body {margin: 0;}
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.size {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #fff; border-radius: 15px; size: 50%;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 1000px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .reading {font-size: 1.3rem;}
      .packet {color: #bebebe;}
      .temperatureColor {color: #fd7e14;}
      .ultrasonicColor {color: #1b78e2;}
      .phsensorColor {color: #1be23e;}
      .statusreadColor {color: #702963; font-size:12px;}
      .LEDColor {color: #183153;}
      
      /* ----------------------------------- สลับสวิตช์ */
      .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
      }

      .switch input {display:none;}

      .sliderTS {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #D3D3D3;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
      }

      .sliderTS:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: #f7f7f7;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
      }

      input:checked + .sliderTS {
        background-color: #00878F;
      }

      input:focus + .sliderTS {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .sliderTS:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .sliderTS:after {
        content:'OFF';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 70%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
      }

      input:checked + .sliderTS:after {  
        left: 25%;
        content:'ON';
      }

      input:disabled + .sliderTS {  
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
      }
      /* ----------------------------------- */
      
    </style>
  </head>
  
  <body>
    
    <div class="topnav">
      <h3>ESP32 TEST DATABASE</h3>
    </div>
    
    <br>
    
    <!-- __ แสดงการตรวจสอบและการควบคุม ____________________________________________________________________________________________ -->
    <div class="content">
      <div class="cards">
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITORING</h3>
          </div>
          
          <!-- แสดงค่าอุณหภูมิที่ได้รับจาก ESP32. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE</h4>
          <p class="temperatureColor"><span class="reading"><span id="temperatureValue"><?php echo $Ds; ?></span> &deg;C</span></p>
          <!-- *********************************************************************** -->
          
          <p class="statusreadColor"><span>Status Read Sensor DS : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        <!-- ======================================================================================================= -->

                <!-- == MONITORING ======================================================================================== -->
                <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITORING</h3>
          </div>
          
          <!-- แสดงค่าการวัดระยะที่ได้รับจาก ESP32. *** -->
          <h4 class="ultrasonicColor"><i class="fas fa-battery-half"></i> ULTRASONIC</h4>
          <p class="ultrasonicColor"><span class="reading"><span id="ultrasonicValue"><?php echo $Ult; ?></span> cm</span></p>
          <!-- *********************************************************************** -->
          
          <p class="statusreadColor"><span>Status Read Sensor Ultrasonic : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        <!-- ======================================================================================================= -->
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITORING</h3>
          </div>
          
          <!-- แสดงค่า PH ที่ได้รับจาก ESP32. *** -->
          <h4 class="phsensorColor"><i class="fas fa-tint"></i> PH SENSOR</h4>
          <p class="phsensorColor"><span class="reading"><span id="phsensorValue"><?php echo $Ph; ?></span> &percnt;</span></p>
          <!-- *********************************************************************** -->
          
          <p class="statusreadColor"><span>Status Read Sensor PH : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        <!-- ======================================================================================================= -->     
      </div>
    </div>
     
    <br>
    
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 0.7rem;">LAST TIME RECEIVED DATA FROM ESP32 [ <span id="DateValue"><?php echo $Date; ?></span> ] [ <span id="TimeValue"><?php echo $Time; ?></span> ]</h3>
            <button onclick="window.open('recordtable.php', '_blank');">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>
    <!-- ___________________________________________________________________________________________________________________________________ -->

        <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>

  </body>
</html>