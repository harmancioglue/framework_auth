<?php

/** you can create a class and define constants */
/** you can create .env file and put below constants inside it */

//DB Params

define('DB_HOST','localhost');
define('DB_USER','__YOUR_USER__');
define('DB_PASS','__YOUR_PASS__');
define('DB_NAME','__YOUR__DBNAME__');

//App Root
define('APP_ROUTE',dirname(dirname(__FILE__)));

//Url Root
define('URL_ROOT','http://localhost/projectmvc_auth');

//Sitename
define('SITE_NAME','Auth');