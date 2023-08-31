<?php

require '../classes/firebase/vendor/autoload.php';

require '../admin/config.php';
require '../admin/functions.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('../classes/firebase/google-service-account.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$auth = $firebase->getAuth();

$users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

$data = iterator_to_array($users);

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData"=>$data);

echo json_encode($results);

?>
