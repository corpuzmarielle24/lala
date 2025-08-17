@extends('layouts.admin')

@section('nav')


<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-8">
            <h4 style="font-weight: bold" class="mt-1">Dashboard
            </h4>
          </div>
        </div>
</nav>
@endsection

@section('content')
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 99999;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 99999;
}
.modal-backdrop{
    z-index: 10;
}
.text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
#example1{
  border: 0
}
#example1 th, #example1 td {
        padding: 1px; /* Adjust the value to control the spacing */
    }

    /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
{{--  --}}
<br>
<div class="card">

<div class="tab">

  <button class="tablinks" onclick="openCity(event, 'analytics')">Analytics</button>
</div>


<div id="analytics" class="tabcontent">
    <div class="row mt-2">
        <div class="col-lg-4 col-4">
            <div class="small-box bg-success">
            <div class="inner">
            <h3>{{$customerCount}}</h3>
            <p>Total Report Missing</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars" style="font-size: 50px;"></i>
            </div>
            <a href="/admin/pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-4">
          <div class="small-box bg-info">
          <div class="inner">
          <h3>{{$kitchenCount}}</h3>
          <p>Total Found Pets</p>
          </div>
          <div class="icon">
          <i class="ion ion-stats-bars" style="font-size: 50px;"></i>
          </div>
          <a href="/admin/approved" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-4 col-4">
        <div class="small-box bg-blue">
        <div class="inner">
        <h3>{{$staffCount}}</h3>
        <p>Total Pets Reported</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars" style="font-size: 50px;"></i>
        </div>
        <a href="/admin/pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

  </div>





  <div class="row ml-2">


  <div class="col-lg-4 col-4" style="box-sizing: border-box; padding: 10px;">
    <!-- Card Container -->
    <div style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; background-color: #fff;">
        <canvas id="dailyReportChart" ></canvas>



    </div>
</div>

<div class="col-lg-4 col-4" style="box-sizing: border-box; padding: 10px;">
    <!-- Card Container -->
    <div style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; background-color: #fff;">
        <canvas id="dailyReportChart2" ></canvas>



    </div>
</div>

<div class="col-lg-4 col-4" style="box-sizing: border-box; padding: 10px;">
    <!-- Card Container -->
    <div style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; background-color: #fff;">
        <canvas id="dailyReportChart3" ></canvas>



    </div>
</div>
</div>

<div class="row ml-2">

    <div class="col-lg-3 col-3" style="box-sizing: border-box; padding: 10px;">
        <p>Breed Percentage</p>
        <canvas id="breedPieChart" width="400" height="400"></canvas>

    </div>


    <div class="col-lg-3 col-3" style="box-sizing: border-box; padding: 10px;">
        <p>Gender Percentage</p>
        <canvas id="breedPieChart2" width="400" height="400"></canvas>

    </div>

    <div class="col-lg-6 col-6" style="box-sizing: border-box; padding: 10px;">
        <p>Age Bracket</p>
        <canvas id="ageChart" width="800" height="400"></canvas>

    </div>

</div>



</div>

</div>


  </body>
  </html>


  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

  <script>
    var ctx = document.getElementById('ageChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Number of Reports',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: {!! json_encode($data) !!}
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1 // Ensure y-axis starts at 0 and only whole numbers
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of Reports'
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Age'
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
</script>


  <script>
    var ctx = document.getElementById('breedPieChart2').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels5) !!},
            datasets: [{
                label: 'Breed Distribution',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                    // Add more colors if you have more than 10 breeds
                ],
                data: {!! json_encode($data5) !!}
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Gender Distribution'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>


  <script>
    var ctx = document.getElementById('breedPieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels4) !!},
            datasets: [{
                label: 'Breed Distribution',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                    // Add more colors if you have more than 10 breeds
                ],
                data: {!! json_encode($data4) !!}
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Breed Distribution'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>



<script>
    var ctx = document.getElementById('breedPieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels4) !!},
            datasets: [{
                label: 'Breed Distribution',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                    // Add more colors if you have more than 10 breeds
                ],
                data: {!! json_encode($data4) !!}
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Breed Distribution'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>

  <script>
    var ctx = document.getElementById('dailyReportChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Daily Reports Count',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: {!! json_encode($data) !!}
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day',
                        tooltipFormat: 'MMM DD, YYYY'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // Ensures only integer values on y-axis
                        callback: function(value, index, values) {
                            return Number.isInteger(value) ? value : ''; // Hide the label if not an integer
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of Reports'
                    }
                }]
            }
        }
    });
</script>

  <script>
    var ctx = document.getElementById('dailyReportChart2').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels2) !!},
            datasets: [{
                label: 'Daily Reports Found Count',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: {!! json_encode($data2) !!}
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day',
                        tooltipFormat: 'MMM DD, YYYY'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of Reports'
                    }
                }]
            }
        }
    });
</script>


<script>
    var ctx = document.getElementById('dailyReportChart3').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels3) !!},
            datasets: [{
                label: 'Monthly Reports Count',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: {!! json_encode($data3) !!}
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day',
                        tooltipFormat: 'MMM DD, YYYY'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Number of Reports'
                    }
                }]
            }
        }
    });
</script>













<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Call the openCity function with the "officers" tab as the default
  openCity(event, 'analytics');
</script>



{{--  --}}
@endsection

