<?php
   session_start();
   
   if(session_destroy()) {
      header("refresh:1; url=login.html");
   }
?>