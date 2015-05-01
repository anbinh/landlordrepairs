<?php

return array(
 
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 465,
    'from' => array('address' => 'codelution@gmail.com', 'name' => 'Admin Codelution'),
    'encryption' => 'tls',
    'username' => 'hieunguyen991989@gmail.com',
    'password' => 'q2w3e4r5t',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
 
);