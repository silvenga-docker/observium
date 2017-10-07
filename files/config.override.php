<?php

## Have a look in includes/defaults.inc.php for examples of settings you can set here. DO NOT EDIT defaults.inc.php!

include("config.env.php");
file_exists("config.custom.php") && include("config.custom.php");

$config['install_dir'] = "/opt/observium";
$config['log_file'] = "/dev/stdout";


// Custom ------------------------------

$config['page_title_prefix'] = "Observium ";

// Location
$config['install_dir']  = "/opt/observium";
$config['log_file'] = "/var/log/nginx/observium.log";

// Thie should *only* be set if you want to *force* a particular hostname/port
// It will prevent the web interface being usable form any other hostname
// $config['base_url']        = "https://ops.silvenga.com";

// Default community list to use when adding/discovering
$config['snmp']['community'] = array("public");

// Authentication Model
$config['auth_mechanism'] = "mysql";    // default, other options: ldap, http-auth, please see documentation for config help

// Enable alerter
$config['poller-wrapper']['alerter']       = TRUE;

// Set up a default alerter (email to a single address)

$config['ignore_mount_regexp'][] = '^\/run.*';

$config['front_page']       = "pages/front/default.alt.php";
$config['login_message'] = "";
$config['allow_unauth_graphs'] = 1;
$config['enable_pseudowires'] = 0;
$config['enable_printers'] = 0;
$config['enable_inventory'] = 0;
$config['geocoding']['api'] = 'google';
$config['frontpage']['map']['region']              = "US";
$config['frontpage']['map']['resolution']          = "provinces"; 
$config['frontpage']['map']['realworld']           = true;
$config['frontpage']['map']['dotsize']             = 50;     
$config['frontpage']['map']['api'] = 'google';

$config['frontpage']['device_status']['uptime']    = true;         // Show the uptime status

$config['enable_sla']                   = 0; # Enable Cisco SLA collection and display
$config['enable_bgp']                   = 0; # Enable BGP session collection and display
$config['int_customers']           = 0;  # Enable Customer Port Parsing
$config['int_transit']             = 0;  # Enable Transit Types
$config['int_peering']             = 0;  # Enable Peering Types
$config['int_core']                = 0;  # Enable Core Port Types
$config['int_l2tp']                = 0;  # Enable L2TP Port Types
$config['show_locations']          = 0;  # Enable Locations on menu
$config['show_locations_dropdown'] = 0;  # Enable Locations dropdown on menu
$config['show_overview_tab'] = false;

$config['ping']['timeout'] = 500;          # timeout in ms
$config['ping']['retries'] = 3;            # how many times to retry the query

$config['housekeeping']['deleted_ports']['age'] = 1*86400;
$config['housekeeping']['syslog']['age'] = 30*86400;
$config['housekeeping']['eventlog']['age'] = 30*86400;
$config['housekeeping']['rrd']['invalid'] = TRUE;
$config['housekeeping']['timing']['age'] = 7*86400;

$config['bad_if_regexp'][] = "/^(veth|docker0|vnet|gre|eth1|em2).*/";

$config['version_check']                = 0;

//Smokeping
$config['smokeping']['dir']     = "/var/lib/smokeping";

// End config.php

