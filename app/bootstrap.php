<?php

//require_once 'libraries/Controller.php';
//require_once 'libraries/Database.php';
//require_once 'libraries/Core.php';

require_once 'utils/GeneralUtils.php';
require_once 'utils/SessionUtils.php';

require_once 'config/db_config.php';

/** Instead of including all required files like above, spl_autoload_register is used */
spl_autoload_register(function ($class){
    require_once 'libraries/'.$class . '.php';
});