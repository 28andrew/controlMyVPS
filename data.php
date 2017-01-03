<?php
  /* -- CPU LOAD -- */
  function getLatestCPULoad(){
    $exec_loads = sys_getloadavg();
    $exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
    $cpu = $exec_loads[0]/($exec_cores + 1);
    return $cpu;
  }
  function getLatestCPULoadPercentage(){
    return getLatestCPULoad() * 100;
  }
  function getCPUModel(){
    $cpu_model = "???";
    $fh = fopen('/proc/cpuinfo','r');
    while ($line = fgets($fh)) {
      $pieces = array();
      if (preg_match('/^model name\s+: (.*)$/', $line, $pieces)){
        $cpu_model = $pieces[1];
        break;
      }
    }
    fclose($fh);
    $cpu_model = str_replace(" CPU ", " ", $cpu_model);
    return $cpu_model;
  }
  /* -- MEMORY USAGE -- */
  function getMemoryInfo(){
    $fh = fopen('/proc/meminfo','r');
    $memory_total = 0;
    $memory_free = 0;
    while ($line = fgets($fh)) {
      $pieces = array();
      if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
        $memory_total = $pieces[1];
      }
      if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
        $memory_free = $pieces[1];
      }
    }
    $memory_used = $memory_total - $memory_free;
    fclose($fh);
    return array('total' => $memory_total, 'free' => $memory_free, 'used' => $memory_used);
  }

  function getMemoryUsedPercentage($memory_info){
    return getRoundedPercentage($memory_info['used'] / $memory_info['total']);
  }

  function getMemoryUsedFormatted($memory_info){
    return formatKilobytes($memory_info['used']);
  }

  function getMemoryTotalFormatted($memory_info){
    return formatKilobytes($memory_info['total']);
  }

  /* -- DISK -- */
  function getTotalSpace($disk){ //BYTES
    return disk_total_space($disk);
  }
  function getFreeSpace($disk){
    return disk_free_space($disk);
  }
  function getUsedSpace($disk){
    return getTotalSpace($disk) - getFreeSpace($disk);
  }
  function getUsedSpacePercentage($disk){
    return getRoundedPercentage(getUsedSpace($disk) / getTotalSpace($disk));
  }
  function getUsedSpaceFormatted($disk){
    return formatBytes(getUsedSpace($disk));
  }
  function getTotalSpaceFormatted($disk){
    return formatBytes(getTotalSpace($disk));
  }

  /* -- FORMATTING -- */
  function formatBytes($size, $precision = 2){
      $base = log($size, 1024);
      $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
      return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
  }
  function formatKilobytes($size, $precision = 2){
    return formatBytes($size * 1024, $precision);
  }
  function getRoundedPercentage($decimal_percentage){
    return round($decimal_percentage * 100, 2);
  }

  /* -- WEB WORKERS -- */
  if (!isset($no_print)){
    if (isset($_GET['json'])){
      $memory_info = getMemoryInfo();
      $disk = "/";

      $data = array(
        'CPU' => array(
          'load' => array(
            'decimal' => getLatestCPULoad(),
            'percentage' => getLatestCPULoadPercentage()
          ),
          'model' => getCPUModel()
        ),
        'memory' => array(
          'used' => array(
            'kb' => $memory_info['used'],
            'percentage' => getMemoryUsedPercentage($memory_info),
            'formatted' => getMemoryUsedFormatted($memory_info)
          ),
          'total' => array(
            'kb' => $memory_info['total'],
            'formatted' => formatKilobytes($memory_info['total'])
          ),
          'free' => array(
            'kb' => $memory_info['free'],
            'formatted' => formatKilobytes($memory_info['free'])
          )
        ),
        'disk' => array(
          'total' => array(
            'b' => getTotalSpace($disk),
            'formatted' => getTotalSpaceFormatted($disk)
          ),
          'free' => array(
            'b' => getFreeSpace($disk),
            'formatted' => formatBytes(getFreeSpace($disk))
          ),
          'used' => array(
            'b' => getUsedSpace($disk),
            'formatted' => formatBytes(getUsedSpace($disk)),
            'percentage' => getUsedSpacePercentage($disk)
          )
        )
      );
      header('Content-Type: text/plain');
      if ($_GET['json'] == "pretty"){
        echo json_encode($data, JSON_PRETTY_PRINT);
      }else{
        echo json_encode($data);
      }
    }
  }
 ?>
