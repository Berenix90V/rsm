<?php

function detectLogin($username) {
   //$CI =& get_instance();
    if ($username == '') {
        redirect(site_url('UserManagement'));
    } 
}