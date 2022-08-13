<?php

use Config\Configuration;

require 'vendor/autoload.php';

(new Configuration());
chdir('src/property/');
require_once 'property.php';
