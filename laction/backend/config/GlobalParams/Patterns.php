<?php

return [

    //Devices :: START
    'devices.form.name' => '/^([A-Za-z \'])+$/',
    'devices.form.code' => '/^([A-Za-z0-9_-])+$/',
    'devices.form.description' => '/^([A-Za-z0-9_ "~`@#$!$%^&*()-+={}?,.\'\/|\]\[])+$/',
    'devices.form.status_ranges' => array(1, 2),
    'devices.form.image_extensions' => array('jpg', 'png', 'gif'),
    //Devices :: END
    
    //Roles :: START
    'roles.form.name' => '/^([A-Za-z \'])+$/',
    'roles.form.code' => '/^([A-Za-z0-9_])+$/',
    'roles.form.description' => '/^([A-Za-z0-9_ "~`@#$!$%^&*()-+={}?,.\'\/|\]\[])+$/',
    //Roles :: END
    //Locations :: START
    'locations.form.name' => '/^([A-Za-z \'])+$/',
    'locations.form.code' => '/^([A-Za-z0-9_])+$/',
    'locations.form.description' => '/^([A-Za-z0-9_ "~`@#$!$%^&*()-+={}?,.\'\/|\]\[])+$/',
        //Locations :: END
        //Sectors :: START
        //Sectors :: END
];

