<?php

require_once '../../init.php';

use Src\Property\App\PropertyFindAll\PropertyFindAll;

$propertyFindAll = new PropertyFindAll();
$nextPage = filter_var($_SERVER['QUERY_STRING'] ?? "", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$propertyList = $propertyFindAll->findAll(nextPage: $nextPage);
echo json_encode($propertyList);
