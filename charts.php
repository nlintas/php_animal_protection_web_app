<?php 

//SELECT COUNT(*) from event_type WHERE type = 'Poison'   Poison food
//SELECT COUNT(*) from event_type WHERE type = 'Lost Pet'   Lost pet
//SELECT COUNT(health_status) from pet WHERE health_status = 'Healthy'   Health status = Healthy
//SELECT COUNT(health_status) from pet WHERE health_status = 'In Recover'  Health status = In Recover
//SELECT COUNT(health_status) from pet WHERE health_status = 'Injured'   Health status = Injured
//SELECT COUNT(for_adoption) from pet WHERE for_adoption = '0'  
//SELECT COUNT(for_adoption) from pet WHERE for_adoption = '1'

require("Connection.php");
//Poisonous food
$poison ="SELECT COUNT(*) from event_type WHERE type = 'Poison' ";
$posionResult = $conn->query($poison);
$p = mysqli_fetch_assoc($posionResult);
//echo "{$p['COUNT(*)']}";
//Lost pet
$lostPet ="SELECT COUNT(*) from event_type WHERE type = 'Lost Pet' ";
$lostPetResult = $conn->query($lostPet);
$l = mysqli_fetch_assoc($lostPetResult);
//echo "{$l['COUNT(*)']}";
//For Adoption
$adoption ="Select COUNT(for_adoption) from pet WHERE for_adoption = '1' ";
$adoptionResult = $conn->query($adoption);
$a = mysqli_fetch_assoc($adoptionResult);
//echo "{$a['COUNT(for_adoption)']}";
//Missing pets
$missingPet =' Select COUNT(for_adoption) from pet WHERE for_adoption = 0 ';
$missingPetResult = $conn->query($missingPet);
$m = mysqli_fetch_assoc($missingPetResult);
//echo "{$m['COUNT(for_adoption)']}";
//HS = healthy
$healthy ="Select COUNT(health_status) from pet WHERE health_status = 'Healthy' ";
$healthResult = $conn->query($healthy);
$h = mysqli_fetch_assoc($healthResult);
//echo "{$h['COUNT(health_status)']}";
//HS = in recovery
$inRecover ="SELECT COUNT(health_status) from pet WHERE health_status = 'In Recover' ";
$inRecoverResult = $conn->query($inRecover);
$i = mysqli_fetch_assoc($inRecoverResult);
//echo "{$i['COUNT(health_status)']}";
//HS = injured
$injured ="SELECT COUNT(health_status) from pet WHERE health_status = 'Injured' ";
$injuredResult = $conn->query($injured);
$n = mysqli_fetch_assoc($injuredResult);
//echo "{$n['COUNT(health_status)']}";

?> 
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Chart.js CSS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

        <title>Charts</title>

    </head>
    <body>
        <div class="container-fluid py-3">
            <div class="row justify-content-md-center">
                <p>

                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Click on me to see some overall stats
                    </button>
                </p>
            </div>
            <div class="collapse alert alert-success" id="collapseExample">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md">
                            <canvas id="chart" ></canvas>
                        </div>
                        <div class="col-md">
                            <canvas id="chart1" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- Chart.js JavaScript -->
        <script>

            let chart = document.getElementById('chart').getContext('2d');

            // Global Options
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';


            let chart_first = new Chart(chart, {
                type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Pets for adoption', 'Missing pets', 'Poisionous food', 'Traps for pets'],
                    datasets:[{
                        label:'Total number',
                        data:[
                            <?php echo "{$a['COUNT(for_adoption)']}"; ?>,
                            <?php echo "{$l['COUNT(*)']}"; ?>,
                            <?php echo "{$p['COUNT(*)']}"; ?>,
                            0
                        ],
                        //backgroundColor:'green',
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:3,
                        hoverBorderColor:'#000'
                    }]
                },
                options:{
                    title:{
                        display:true,
                        text:'Overall analysis',
                        fontSize:25
                    },
                    legend:{
                        display:false,
                        //position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                    },
                    layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                    },
                    tooltips:{
                        enabled:true
                    }
                }
            });


            //===================================================================================================================================


            let chart1 = document.getElementById('chart1').getContext('2d');

            // Global Options
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';


            let chart_second = new Chart(chart1, {
                type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data:{
                    labels:['Healthy', 'In Recovery', 'Injured'],
                    datasets:[{
                        label:'Total number',
                        data:[
                            <?php echo "{$h['COUNT(health_status)']}"; ?>,
                            <?php echo "{$i['COUNT(health_status)']}"; ?>,
                            <?php echo "{$n['COUNT(health_status)']}"; ?>
                        ],
                        //backgroundColor:'green',
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        borderWidth:1,
                        borderColor:'#777',
                        hoverBorderWidth:3,
                        hoverBorderColor:'#000'
                    }]
                },
                options:{
                    title:{
                        display:true,
                        text:'Health status',
                        fontSize:25
                    },
                    legend:{
                        display:true,
                        //position:'right',
                        labels:{
                            fontColor:'#000'
                        }
                    },
                    layout:{
                        padding:{
                            left:50,
                            right:0,
                            bottom:0,
                            top:0
                        }
                    },
                    tooltips:{
                        enabled:true
                    }
                }
            });

        </script>
    </body>
</html>



<!--

-->


