<?php

/**
 * Observium
 *
 *   This file is part of Observium.
 *
 * @package    observium
 * @subpackage webui
 * @copyright  (C) 2006-2015 Adam Armstrong
 *
 */

echo('<tr class="list">');

echo('<td class="list">');

if (get_device_id_by_hostname($vm['vmwVmDisplayName']))
{
  echo(generate_device_link(device_by_name($vm['vmwVmDisplayName'])));
} else {
  echo $vm['vmwVmDisplayName'];
}

echo("</td>");
echo('<td class="list">' . $vm['vmwVmState'] . "</td>");

if ($vm['vmwVmGuestOS'] == "E: tools not installed")
{
  echo('<td class="small">Unknown (VMware Tools not installed)</td>');
}
else if ($vm['vmwVmGuestOS'] == "")
{
  echo('<td class="small"><i>(Unknown)</i></td>');
}
elseif (isset($config['vmware_guestid'][$vm['vmwVmGuestOS']]))
{
  echo('<td class="list">' . $config['vmware_guestid'][$vm['vmwVmGuestOS']] . "</td>");
}
else
{
  echo('<td class="list">' . $vm['vmwVmGuestOS'] . "</td>");
}

if ($vm['vmwVmMemSize'] >= 1024)
{
  echo("<td class=list>" . sprintf("%.2f",$vm['vmwVmMemSize']/1024) . " GB</td>");
} else {
  echo("<td class=list>" . sprintf("%.2f",$vm['vmwVmMemSize']) . " MB</td>");
}

echo('<td class="list">' . $vm['vmwVmCpus'] . " CPU</td>");

?>
