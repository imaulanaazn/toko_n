<?php

if (!function_exists('user')) {
    function user()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) return null;

        $users = $session->get('users') ?? [];
        $activeId = $session->get('active_user_id');

        foreach ($users as $u) {
            if ($u['id'] == $activeId) {
                return (object)$u;
            }
        }
        return null;
    }
}
