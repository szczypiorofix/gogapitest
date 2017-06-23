<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    if (isset($_POST['task'])) {
        //echo '<h3>OK!</h3>';
        require "./gog_api.php";
        App::init();
        App::showOutput();
    }
    else {
        echo '<h3>Uuups! Something went wrong...</h3>';
    }