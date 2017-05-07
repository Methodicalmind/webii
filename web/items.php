<?php session_start();
$session_products = array();
if(array_key_exists("items", $_SESSION))
{
  if($_SESSION["items"] != null)
  {
    $session_products = $_SESSION["items"];
  }
}
?>
<table class="table table-hover">
<tr>
  <th>Items</th>
  <th>Description</th>
  <th>Cart</th>
</tr>
<tr>
  <td><img class="product" src="img/duc.jpg"></td>
  <td><p>2017 Ducati Panigale 959<br><div id="price">$16,999</div></p></td>
  <td class="center-checkbox"><input type="checkbox" name="items[]"
    value="duc" id="duc" <?php if(in_array("duc", $session_products)) echo 'checked="checked"';?>>    <label for="duc"></label></td>
</tr>
<tr>
  <td><img class="product" src="img/gxr.jpg"></td>
  <td><p>2017 Suzuki GXR1000R<br><div id="price">$17,895</div></p></td>
  <td class="center-checkbox"><input type="checkbox" name="items[]"
    value="gxr" id="gxr">
    <label for="gxr"></label></td>
</tr>
<tr>
  <td><img class="product" src="img/cbr.jpg"></td>
  <td><p>2017 Honda CBR1000R<br><div id="price">$19,799</div></p></td>
  <td class="center-checkbox"><input type="checkbox" name="items[]"
    value="cbr" id="cbr">
    <label for="cbr"></label></td>
</tr>
<tr>
  <td><img class="product" src="img/bmw.jpg"></td>
  <td><p>2017 BMW 1000R<br><div id="price">$15,695</div></p></td>
  <td class="center-checkbox"><input type="checkbox" name="items[]"
    value="bmw" id="bmw">
    <label for="bmw"></label></td>
</tr>
</table>
