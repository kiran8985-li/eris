<?php
$view = isset($_GET['view']) ? $_GET['view'] : "";
$appl = new Applicants();
$applicant = $appl->single_applicant($_SESSION['APPLICANTID']);
?>

<style type="text/css">
    /*    #image-container {
          width: 230px;
        }*/
    .panel-body img {
        width: 100%;
        height: 50%;
    }

    .panel-body img:hover {
        cursor: pointer;
    }
</style>
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">Profile</h2>
            </div>
        </div>
    </div>
</section>
<div class="container" style="margin-top: 10px;min-height: 600px;">

    <div class="row">

        <div class="col-sm-3">
            <!--left col-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="image-container">
                        <img title="profile image" data-target="#myModal" data-toggle="modal" src="<?php echo web_root . 'applicant/' . $applicant->APPLICANTPHOTO; ?>">
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-muted">Profile</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Real Name</strong></span>
                        <?php echo $applicant->FNAME . ' ' . substr($applicant->MNAME, 1, 2) . '. ' . $applicant->LNAME; ?>
                    </li>
                </ul>
                <div class="box box-solid">
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="<?php echo ($view == 'appliedjobs' || $view == '') ? 'active' : ''; ?>"><a href="<?php echo web_root . 'applicant/index.php?view=appliedjobs'; ?>"><i class="fa fa-list"></i> Applied Jobs
                                </a></li>
                            <li class="<?php echo ($view == 'accounts') ? 'active' : ''; ?>"><a href="<?php echo web_root . 'applicant/index.php?view=accounts'; ?>"><i class="fa fa-user"></i> Accounts </a></li>
                            <li class="<?php echo ($view == 'message') ? 'active' : ''; ?>"><a href="<?php echo web_root . 'applicant/index.php?view=message'; ?>"><i class="fa fa-envelope-o"></i> Messages
                                    <span class="label label-success pull-right"><?php echo isset($showMsg->COUNT) ? $showMsg->COUNT : 0; ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <?php
            check_message();
            check_active();
            ?>

            <?php
            switch ($view) {
                case 'message':
                    require_once("message.php");
                    break;
                case 'notification':
                    require_once("notification.php");
                    break;
                case 'appliedjobs':
                    require_once("appliedjobs.php");
                    break;
                case 'accounts':
                    // require_once("accounts.php");
                    break;

                default:
                    require_once("appliedjobs.php");
                    break;
            }
            ?>

            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Interview Analysis</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <canvas id="line-chart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample data for the chart
    var salesData = {
        labels: ["problem solving", "communucation", "skill", "confidence", "decision making"],
        datasets: [{
            label: 'Sales',
            data: [70, 80, 95, 75, 65],
            borderColor: 'teal',
            backgroundColor: 'rgba(0, 128, 128, 0.2)',
            borderWidth: 2
        }]
    };

    // Chart configuration
    var ctx = document.getElementById('line-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: salesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
