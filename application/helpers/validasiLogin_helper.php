<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('Auth');
    }
}

function check_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') == 1) {
        redirect('auth/block');
    }
}
function check_member()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') == 2) {
        redirect('auth/block_member');
    }
}
