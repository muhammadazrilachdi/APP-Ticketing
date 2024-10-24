<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    }

    $departement_id = $ci->session->userdata('departement_id');
    $uri = $ci->uri->segment(1);

    if ($uri == 'admin' && $departement_id != 1) {
        redirect('user/dashboard');
    }
}

function pre($string, $is_die = true)
{
    echo "<pre>";
    print_r($string);
    echo "</pre>";
    if($is_die){
        die();
    }
}
