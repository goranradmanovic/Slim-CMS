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
require_once INC_ROOT . '/app/routes/upload/gallery.php';
require_once INC_ROOT . '/app/routes/admin/example.php';
require_once INC_ROOT . '/app/routes/errors/404.php';
require_once INC_ROOT . '/app/routes/auth/password/change.php';
require_once INC_ROOT . '/app/routes/auth/password/recover.php';
require_once INC_ROOT . '/app/routes/auth/password/reset.php';
require_once INC_ROOT . '/app/routes/account/profile.php';
require_once INC_ROOT . '/app/routes/assets/pdf.php';
require_once INC_ROOT . '/app/routes/assets/xlsx.php';
require_once INC_ROOT . '/app/routes/articles/article.php';
require_once INC_ROOT . '/app/routes/articles/edit_article.php';
require_once INC_ROOT . '/app/routes/articles/delete_article.php';
require_once INC_ROOT . '/app/routes/post/all_posts.php';
require_once INC_ROOT . '/app/routes/post/show.php';

?>