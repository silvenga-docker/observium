<?php

function merge(&$config, $configKey, $envKey){
    $config[$configKey] = getenv($envKey) ?: $confg[$configKey];
}

merge($config, 'db_host', "OB_DB_HOST");
merge($config, 'db_user', "OB_DB_USER");
merge($config, 'db_pass', "OB_DB_PASS");
merge($config, 'db_name', "OB_DB_NAME");