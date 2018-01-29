<?php
$id = $_GET['id'];
require_once('../../../config.inc.php');
$objContact = new contact();

$objContact-> contact($id);

?>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="118">Name</td>
    <td width="482"><?php echo $objContact->getName();?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $objContact->getEmail();?></td>
  </tr>
  <tr>
    <td>Telephone</td>
    <td><?php echo $objContact->getTelephone();?></td>
  </tr>
  <tr>
    <td>Date</td>
    <td><?php echo $objContact->getDate();?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Message</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $objContact->getMessage();?></td>
  </tr>
</table>
