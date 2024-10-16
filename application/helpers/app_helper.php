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

function pre($string)
{
    echo "<pre>";
    print($string);
    echo "</pre>";
    die();
}
