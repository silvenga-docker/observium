<?php


//FE-FIREEYE-MIB::feActiveVMs.0 = 5

$table_defs['MSERIES-ALARM-MIB']['alarmGeneral'] = array(
  'file'          => 'MSERIES-ALARM-MIB-alarmGeneral.rrd',
  'call_function' => 'snmp_get',
  'mib'           => 'MSERIES-ALARM-MIB',
  'mib_dir'       => 'smartoptics',
  'table'         => 'alarmGeneral',
  'ds_rename'     => array('smartAlarmGeneralNumberActiveList' => 'active_alarms',
                           'smartAlarmGeneralNumberLogList'    => 'logged_alarms'),
  'graphs'        => array('mseries_alarms'),
  'oids'          => array(
     'smartAlarmGeneralNumberActiveList' => array('descr'  => 'Active Alarms', 'ds_type' => 'GAUGE', 'ds_min' => '0'),
     'smartAlarmGeneralNumberLogList'    => array('descr'  => 'Logged Alarms', 'ds_type' => 'GAUGE', 'ds_min' => '0'),

  )
);

// EOF
