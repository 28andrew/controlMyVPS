<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="favicon.ico"/>
    <?php
			$title = true;
			$needs_login = true;
			include($_SERVER['DOCUMENT_ROOT'] . '/core/head.php');
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <?php include($core . 'headerbar.php') ?>
        <!-- Left side column -->
        <?php include($core . 'navigation.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
        					Dashboard
        					<small>Everything at a quick glance.</small>
      					</h1>
                <?php
									include($core . 'breadcrumb.php');
									breadcrumb_main("Dashboard", "dashboard", true);
								 ?>
            </section>

            <!-- Main content -------------------------------------------->
						<?php
              $no_print = true;
              include('data.php');
              $memory_info = getMemoryInfo();
						 ?>
            <section class="content">
							<!-- Information Row-->
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="info-box bg-green">
											<span class="info-box-icon"><i class="fa fa-dashboard"></i></span>
											<div class="info-box-content">
										    <span class="info-box-text">CPU Usage</span>
										    <span class="info-box-number" id="cpuLoadPercentageDisplay"><?=getLatestCPULoadPercentage()?>%</span>
										    <!-- The progress section is optional -->
										    <div class="progress">
										      <div class="progress-bar" id="cpuLoadPercentageBar" style="width: <?=getLatestCPULoadPercentage()?>%"></div>
										    </div>
                        <span class="progress-description">
      										<?=getCPUModel()?>
    										</span>
											</div>
										</div>
								</div>
								<div class="col-md-6 col-sm-12">
										<div class="info-box bg-yellow">
											<span class="info-box-icon"><i class="fa fa-tasks"></i></span>
											<div class="info-box-content">
										    <span class="info-box-text">Memory Usage</span>
										    <span class="info-box-number" id="memoryUsedPercentageDisplay"><?=getMemoryUsedPercentage($memory_info)?>%</span>
										    <!-- The progress section is optional -->
										    <div class="progress">
										      <div class="progress-bar" id="memoryUsedPercentageBar" style="width: <?=getMemoryUsedPercentage($memory_info)?>%"></div>
										    </div>
												<span id="memoryRatioDisplay" class="progress-description">
      										<?=getMemoryUsedFormatted($memory_info)?> / <?=getMemoryTotalFormatted($memory_info)?>
    										</span>
											</div>
										</div>
								</div>
							</div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
										<div class="info-box bg-aqua">
											<span class="info-box-icon"><i class="fa fa-inbox"></i></span>
											<div class="info-box-content">
										    <span class="info-box-text">Bandwidth Usage</span>
										    <span class="info-box-number"><?=getUsedSpacePercentage("/")?>%</span>
										    <!-- The progress section is optional -->
										    <div class="progress">
										      <div class="progress-bar" style="width: <?=getUsedSpacePercentage("/")?>%"></div>
										    </div>
												<span class="progress-description">
      										<?=getUsedSpaceFormatted("/")?> / <?=getTotalSpaceFormatted("/")?>
    										</span>
											</div>
										</div>
								</div>
                <div class="col-md-6 col-sm-12">
										<div class="info-box bg-red">
											<span class="info-box-icon"><i class="fa fa-inbox"></i></span>
											<div class="info-box-content">
										    <span class="info-box-text">Disk Usage</span>
										    <span class="info-box-number" id="diskUsedPercentageDisplay"><?=getUsedSpacePercentage("/")?>%</span>
										    <!-- The progress section is optional -->
										    <div class="progress">
										      <div class="progress-bar" id="diskUsedPercentageBar" style="width: <?=getUsedSpacePercentage("/")?>%"></div>
										    </div>
												<span class="progress-description">
      										<?=getUsedSpaceFormatted("/")?> / <?=getTotalSpaceFormatted("/")?>
    										</span>
											</div>
										</div>
								</div>
              </div>
							<!-- ./InformationRow -->
            </section>
            <!-- /.content ----------------------------------------------->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include($core . 'footer.php') ?>

        <!-- Control Sidebar -->
        <?php include($core . 'sidebar.php') ?>

    </div>
    <script src="/js/index.js"></script>
		<?php include($core . 'footer_scripts.php'); ?>
</body>

</html>
