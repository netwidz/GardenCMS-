<?php
$id = $_GET['id'];
require_once('../../../config.inc.php');
$objFAQ = new faq();

$objFAQ-> faq($id);

?>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="118">Title</td>
    <td width="482"><?php echo $objFAQ->getTitle();?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Answer</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $objFAQ->getFAQAnswer();?></td>
  </tr>
</table>
