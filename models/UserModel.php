<?php
    require_once('MainModel.php');

    class UserModel extends MainModel {

        function __construct() {
            parent::__construct("user");
        }
        
    }
?>