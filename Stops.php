<?php
include_once("NmbsDB.php");
include_once("Config.php");

$nmbsDB = NmbsDB::getInstantie(Config::getConfigInstantie()->getServer(),
    Config::getConfigInstantie()->getUsername(),
    Config::getConfigInstantie()->getPassword(),
    Config::getConfigInstantie()->getDatabase()
);

$trainStops = $nmbsDB->getTrainStops();
echo(json_encode($trainStops));

?>