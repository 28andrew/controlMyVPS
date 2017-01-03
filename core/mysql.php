<?php
function connection() {
  global $CONFIG;
  static $pdo;
  if(!$pdo) {
      $host = $CONFIG['mysql']['host'];
      $db   = $CONFIG['mysql']['database'];
      $user = $CONFIG['mysql']['user'];
      $pass = $CONFIG['mysql']['password'];
      $charset = 'utf8';

      //TURN OFF LATER
      ini_set('display_errors', 1);

      $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
      $opt = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => true,
      ];
      $pdo = new PDO($dsn, $user, $pass, $opt);
  }
  return $pdo;
}
?>
