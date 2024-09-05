<?php 
    //start session

    //remove the user session
    unset ($_SESSION ['loggeduser']);

    //redirect back to index.php
    header("Location:/");
    exit;