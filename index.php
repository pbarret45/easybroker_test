<?php

use Config\Configuration;

require 'vendor/autoload.php';

(new Configuration());
chdir('src/view/home');
require_once 'home.php';
