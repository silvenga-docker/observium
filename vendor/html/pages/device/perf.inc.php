<?php

/**
 * Observium Network Management and Monitoring System
 * Copyright (C) 2006-2015, Adam Armstrong - http://www.observium.org
 *
 * @package    observium
 * @subpackage webui
 * @author     Adam Armstrong <adama@memetic.org>
 * @copyright  (C) 2006-2015 Adam Armstrong
 *
 */

$graph_array = array('type'   => 'device_poller_perf',
                     'device' => $device['device_id'],
                     'operation' => 'poll',
                     'width'  => 1095,
                     'height' => 150,
                     'from'   => $config['time']['week'],
                     'to'     => $config['time']['now'],
                     );
echo(generate_graph_tag($graph_array));

?>

<div class="row">
  <div class="col-md-6">
    <div class="well info_box">
      <div class="title">
        <i class="oicon-blocks"></i> Module Performance
      </div>
      <div class="content">
        <table class="table table-hover table-striped table-bordered table-condensed table-rounded">
          <thead>
            <tr>
              <th>Module</th>
              <th colspan="2">Duration</th>
            </tr>
          </thead>
          <tbody>
<?php

arsort($device['state']['poller_mod_perf']);

foreach ($device['state']['poller_mod_perf'] as $module => $time)
{
  if ($time > 0.001)
  {
    $perc = round($time / $device['last_polled_timetaken'] * 100, 2, 2);

    echo('    <tr>
      <td>'.$module.'</td>
      <td>'.$time.'s</td>
      <td>'.$perc.'%</td>
    </tr>');
  }
}

?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
      <div class="well info_box">
        <div class="title">
          <i class="oicon-blocks"></i> Total Performance
        </div>
        <div class="content">
          <table class="table table-hover table-striped table-bordered table-condensed table-rounded">
            <thead>
              <tr>
                <th>Time</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
<?php

$times = dbFetchRows("SELECT * FROM `devices_perftimes` WHERE `operation` = 'poll' AND `device_id` = ? ORDER BY `start` DESC LIMIT 100", array($device['device_id']));

foreach ($times as $time)
{
  echo('    <tr>
      <td>'.format_unixtime($time['start']).'</td>
      <td>'.$time['duration'].'s</td>
    </tr>');
}

?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="well info_box">
        <div class="title">
          <i class="oicon-blocks"></i> Discovery Times
        </div>
        <div class="content">
          <table class="table table-hover table-striped table-bordered table-condensed table-rounded">
            <thead>
              <tr>
                <th>Time</th>
                <th>Duration</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
<?php

$times = dbFetchRows('SELECT * FROM `devices_perftimes` WHERE `operation` = "discover" AND `device_id` = ? ORDER BY `start` DESC LIMIT 100', array($device['device_id']));

foreach ($times as $time)
{
  echo('    <tr>
      <td>'.format_unixtime($time['start']).'</td>
      <td>'.$time['duration'].'s</td>
      <td></td>
    </tr>');
}

?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php

// EOF
