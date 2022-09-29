<?php
session_start();
session_destroy();
echo "<script>alert('Bye bye'); 
                location.href='./' </script>";
