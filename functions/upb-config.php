<?php
  include "config.php";

  $server_url = "https://api-uat.unionbankph.com/partners/sb/convergent/v1/oauth2/authorize";
  $sb_path = " https://api-uat.unionbankph.com/partners/sb/";
?>
<form action="<?=$server_url;?>" method="post">
  <input type="text" name="authcode" placeholder="Authorization Code">
  <input type="text" name="authcode" placeholder="Authorization Code">
  <input type="passwors" name="password" placeholder="Password">
  <button type="submit">Log In</button>
</form>