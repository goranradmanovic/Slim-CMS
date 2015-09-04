<?php

//Ukljucivanje svih fajlova sa putanjama do stranica iz views foldera.Svaki novi routes file sa putanjom moramo ovdje uljuciti

require_once INC_ROOT . '/app/routes/home.php';
require_once INC_ROOT . '/app/routes/auth/register.php';
require_once INC_ROOT . '/app/routes/auth/login.php';
require_once INC_ROOT . '/app/routes/auth/activate.php';
require_once INC_ROOT . '/app/routes/auth/logout.php';
require_once INC_ROOT . '/app/routes/user/profile.php';
require_once INC_ROOT . '/app/routes/user/delete_img.php';
require_once INC_ROOT . '/app/routes/user/all.php';
require_once INC_ROOT . '/app/routes/upload/upload_img.php';
require_once INC_ROOT . '/app/routes/admin/example.php';
require_once INC_ROOT . '/app/routes/errors/404.php';


?>