<?php

use App\Models\Metadata;

require_once __DIR__ . "/vendor/autoload.php";

$metadata = new Metadata();

$metadata->set("office_location", "629 12th St, Modesto, CA
95354,United States");

$metadata->set("office_phone", "+(111) 65_458_857");
$metadata->set("office_email", "information@gmail.com");
$metadata->set("office_open_info", "Mon - Sat : 9AM - 6PM");
$metadata->set("office_close_info", "Sunday: Closed");
$metadata->set("office_latitude", "-5.1375500");
$metadata->set("office_longitude", "119.4866300");

echo "seeding success";
