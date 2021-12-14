<?php
function activeMenu($route = '') {
    $active = '';
    if (Request::route()->getName() == $route) {
        $active = 'active';
    }
    return $active;
}
