<?php
$path=rawurldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/');
if($path==='/')return false;
$pages=['index.php','login.php','forgot_password.php','reset_password.php','register.php','dashboard.php','beneficiaries.php','cases.php','case_details.php','referrals.php','follow_ups.php','reports.php','users_admin.php','audit.php','backups.php','documents.php','export.php','search.php','supervisor_workload.php','logout.php'];
if(in_array(ltrim($path,'/'),$pages,true)&&substr_count($path,'/')===1)return false;
if(preg_match('~^/assets/[a-zA-Z0-9_.-]+\.(css|js|png|jpg|svg|woff2?)$~',$path))return false;
http_response_code(404);echo 'Not found.';
