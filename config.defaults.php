<?php
  /***
   *                      _             _    __  __        __      _______   _____
   *                     | |           | |  |  \/  |       \ \    / /  __ \ / ____|
   *       ___ ___  _ __ | |_ _ __ ___ | |  | \  / |_   _   \ \  / /| |__) | (___
   *      / __/ _ \| '_ \| __| '__/ _ \| |  | |\/| | | | |   \ \/ / |  ___/ \___ \
   *     | (_| (_) | | | | |_| | | (_) | |  | |  | | |_| |    \  /  | |     ____) |
   *      \___\___/|_| |_|\__|_|  \___/|_|  |_|  |_|\__, |     \/   |_|    |_____/
   *                                                 __/ |
   *                                                |___/
   */

   /*
      %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      ======================================================================================
      ** IF IT IS RECOMMENDED THAT YOU CREATE `config.php` AS ANY OPTIONS IN `config.php`
      ** WILL OVERRIDE THIS FILE, USE THIS FILE ONLY FOR REFERENCE PURPOSES
      ======================================================================================
      %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
   */

   /* --- START DEFAULT CONFIGURATION --- */


   /* Naming & Branding */

   //Name of the Control Panel
   $CONFIG['name'] = "Control My VPS";
   $CONFIG['html_name'] = "<b>Control My</b> VPS";
   //Shortened/Abbreviated version of the $name
   $CONFIG['short_name'] = "CMV";
   $CONFIG['short_html_name'] = "<b>CM</b>V";
   //Company name, used in the Copyright
   $CONFIG['company_name'] = "Control My VPS";

   /* MySQL Connection Detail */
   //The host used to connect to MySQL, for a port specify in the format `HOST:PORT`
   $CONFIG['mysql']['host'] = "localhost";
   //The database to be used for MySQL
   $CONFIG['mysql']['database'] = "controlMyVPS";
   //The user to be used for MySQL
   $CONFIG['mysql']['user'] = "controlMyVPS";
   //The password to be used to authenticate with MySQL
   $CONFIG['mysql']['password'] = "fl0||y8unn1es@re@wesome";
 ?>
