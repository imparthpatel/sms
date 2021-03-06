<?php
include('header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <a href="vehical_list.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car-side"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Your vehicles </span>
                <span class="info-box-text">
                    <?php 
                  $sql=mysqli_query($con,"SELECT COUNT(*) COUNT from vehicle_detail where uid=".$_SESSION['uid']."");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn=$row['COUNT'];
                  }
                  echo $cmpn;
                  ?>
                  </span>              
                <!-- <span class="info-box-number" id="vehicles"></span> -->
              </div>
              </div>
              <!-- /.info-box-content -->
          </a>
            </div>
            <!-- /.info-box -->
        <!-- </div> -->

        <div class="col-12 col-sm-6 col-md-3">
          <a href="memberview.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas  fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Family Members  </span>
                <span class="info-box-text">
                    <?php 
                  $sql=mysqli_query($con,"SELECT COUNT(*) COUNT from member_detail where uid=".$_SESSION['uid']."");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn1=$row['COUNT'];
                  }
                  echo $cmpn1;
                  ?>
                  </span>
                <!-- <span class="info-box-number" id="memberdetails"></span> -->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <a href="event_book_tbl.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning  elevation-1"><i class="fas fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Your registered events  </span>
                <span class="info-box-text">
                    <?php 
                  $sql=mysqli_query($con,"SELECT COUNT(*) COUNT from booking where mem_id=".$_SESSION['uid']."");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn2=$row['COUNT'];
                  }
                  echo $cmpn2;
                  ?>
                  </span>

                <!-- <span class="info-box-number" id="ownevents"></span> -->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div> 

        <div class="col-12 col-sm-6 col-md-3">
          <a href="maintenance_bill_history.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-receipt "></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Bills</span>
                <span class="info-box-number" id="">
                  <?php 
                  $sql=mysqli_query($con,"SELECT count(*) COUNT from maintenance_bill where fid=".$_SESSION['uid']."");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn=$row['COUNT'];
                  }
                  echo $cmpn;
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <a href="cmp_history.php">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Complaint Status  </span>
                <span class="info-box-number" id="">
                  <?php 
                  $sql=mysqli_query($con,"SELECT COUNT(*) COUNT from tblcomplaints where userId=".$_SESSION['uid']."");
                  while($row=mysqli_fetch_array($sql))
                  {
                    $cmpn=$row['COUNT'];
                  }
                  echo $cmpn;
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>    
      </div>     
      <div class="row">
      <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Past Expenses(Total Expenses)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">This Month</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

      </div>




      <section class="content-header">
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h1 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  Notice Board
                </h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                $query1="select * from notice order by nid desc";
                $result=mysqli_query($con,$query1);
              // print_r($result);l
                if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
          }
          while($rows=$result->fetch_assoc())
          {
            ?>
            <div class="callout callout-info">

              <h5><?php echo ($rows['title']); ?></h5>

              <p><?php echo ($rows['descr']); ?></p>
              <p><?php echo ($rows['date']); ?></p>
              <div id="<?php echo "progress".$rows['nid'];?>"  >
              </div>
              <span>
                <i class="fa fa-thumbs-up" onclick="vote('y',<?php echo ($rows['nid']);?>, this)" ></i>
                <span>Yes </span>
              </span>
              <span>
                <i class="fa fa-thumbs-down" onclick="vote('n',<?php echo ($rows['nid']);?>, this)"></i>
                <span>No</span>
              </span>
              
            </div>
          <?php } ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>



  </div><!-- /.container-fluid -->
</section>
        <!-- <div><h2></h2></div>
          <div id="vehicles"></div> -->

        <!-- <div><h2>family members </h2></div>
          <div id="memberdetails"></div> -->

       <!--  <div><h2>Your registered events </h2></div>
        <div id="ownevents"></div>

        <div><h2>Bills </h2></div>
        <div id="billcount"></div>

        <div><h2>Complaint Status </h2></div>
        <div id="compstatus"></div> -->



      </div>
    </section>
  </div>


  <?php
  include('footer.php');
  ?>

  <script>
    <?php

    echo "var id=".$_SESSION['uid'].";var name='".$_SESSION['fullName']."';";

    ?>


    $(function() {


      var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false;

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Maintenance', 
          'Gas Bill',
          'Electricity Bill', 
          'Water Charges', 
          'Parking Charges', 
          'Other', 
      ],
      datasets: [
        {
          data: [400,500,800,100,100,300],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })


    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })



      var myobj1 = {
       uid: id,
       uname: name,
       need: 'vehicles'
     }

     $.ajax({
       type: "POST",
       url: 'dbservices/fetchuserdashboard.php',
       data: myobj1,
       success: function(data)
       {
         document.getElementById('vehicles').innerHTML = data;
       }
     })


     var myobj2 = {
       uid: id,
       uname: name,
       need: 'members'
     }

     $.ajax({
       type: "POST",
       url: 'dbservices/fetchuserdashboard.php',
       data: myobj2,
       success: function(data)
       {
         document.getElementById('memberdetails').innerHTML = data;
       }
     })

     var myobj3 = {
       uid: id,
       uname: name,
       need: 'billcount'
     }

     $.ajax({
       type: "POST",
       url: 'dbservices/fetchuserdashboard.php',
       data: myobj3,
       success: function(data)
       {
         document.getElementById('billcount').innerHTML = data;
       }
     })

     var myobj4 = {
       uid: id,
       uname: name,
       need: 'myevents'
     }

     $.ajax({
       type: "POST",
       url: 'dbservices/fetchuserdashboard.php',
       data: myobj4,
       success: function(data)
       {
         document.getElementById('ownevents').innerHTML = data;
       }
     })

     var myobj5 = {
       uid: id,
       uname: name,
       need: 'compstatus'
     }

     $.ajax({
       type: "POST",
       url: 'dbservices/fetchuserdashboard.php',
       data: myobj5,
       success: function(data)
       {
         document.getElementById('compstatus').innerHTML = data;
       }
     })




     //kjgskcascj

     

   });

    function test(nid)
    {
      alert('onload'+ nid);
      var myobj10 = {
        nid: nid,
        need: 'votingstatus'
      }

      $.ajax({
        type: "POST",
        url: 'dbservices/noticevote.php',
        data: myobj10,
        success: function(data)
        {
          //alert(data);
          var arr = data.split(',');
          var yes = arr[0];
          var total = arr[1];
          var html = '<div class="col-md-6  col-sm-6 col-12">'+
               '<div class="info-box bg-success">'+
               '<span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>'+
              '<div class="info-box-content">'+
                '<span class="info-box-text">Likes</span>'+
                '<span class="info-box-number">'+yes+'</span>'+
                '<span class="info-box-text">DisLikes</span>'+
                '<span class="info-box-number">'+(total - yes)+'</span>'+
                '<div class="progress">'+
                  '<div class="progress-bar" style="width: '+yes*100/total+'%"></div>'+
                '</div></div></div></div>';
          var eleid = 'progress'+nid;
          document.getElementById(eleid).innerHTML = html;
        }
      })



    }

    function vote(d1, nid, ele)
    {
      var txt = "";
      if(d1 === 'y')
      {
        txt = "Clicked Thumbs UP";
      }
      if(d1 === 'n')
      {
        txt = "Clicked Thumbs DOWN";
      }

      var myobj6 = {
        nid: nid,
        usrid: <?php echo ($_SESSION['uid']); ?>,
        ans: d1,
        need: 'voting'
      }

      $.ajax({
        type: "POST",
        url: 'dbservices/noticevote.php',
        data: myobj6,
        success: function(data)
        {
          alert(txt);
          test(nid);
          if(data === '1')
          {
            if(d1 === 'y' )
            {
              ele.classList.toggle("fa-thumbs-o-up");
            }

            if(d1 === 'n' )
            {
              ele.classList.toggle("fa-thumbs-o-down");
            }

          }
        }
      });

    }

  </script>


