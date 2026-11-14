<?php require __DIR__.'/app/core.php'; if(!currentUser()){go('login.php');} if(role()!=='Admin'){http_response_code(403);exit('Access denied.');} go('users_admin.php');
