<?php
// Get current page name
$current_page = basename($_SERVER['PHP_SELF']);

// Function to check if a menu item is active
function is_menu_active($page_name) {
    global $current_page;
    return $current_page === $page_name ? 'menu-active menu-icon-' . str_replace('.php', '', $page_name) . '-active' : '';
}

// Function to check if a menu link is active
function is_link_active($page_name) {
    global $current_page;
    return $current_page === $page_name ? 'non-style-link-menu-active' : '';
}

// Function to get menu item classes
function get_menu_classes($page_name) {
    return 'menu-btn menu-icon-' . str_replace('.php', '', $page_name) . ' ' . is_menu_active($page_name);
}

// Function to get menu link classes
function get_link_classes($page_name) {
    return 'non-style-link-menu ' . is_link_active($page_name);
}
?> 