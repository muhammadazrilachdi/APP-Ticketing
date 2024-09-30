<?php

function is_logged_in()
{
    $ci = get_instance();

    // Memeriksa apakah pengguna sudah login
    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    }
}
