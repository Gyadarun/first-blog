<!-- Défaire la session et redirection -->
<?php
    unset($_SESSION['admin']);
    header("Location:../");