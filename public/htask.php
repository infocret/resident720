<?php
  $Conexion = new mysqli("127.0.0.1", "u749298381_jb", "julio123", "u749298381_kali");
  $RefCAllSp = $Conexion->prepare("CALL sp_itest");
  // $username= "usu1";
  // $RefCAllSp->bind_param('s',$username);
  $RefCAllSp->execute();
  $RefCAllSp->bind_result($resp);
  while ($RefCAllSp->fetch()) {
    echo "$resp";
  }
?>