<?php

use CodeIgniter\HTTP\Request;
use Config\Roles;

function get_location($is_terminal = 0): string
{
    return $is_terminal ? 'Binangonan' : 'Isla';
}

function get_trip_type($start1, $start2): string
{
    return strtotime($start1) > strtotime($start2) ? 'A' : 'B';
}

function get_time_diff($t1, $t2 = null) {
    if (is_null($t2)) {
        $t2 = strtotime(date('Y-m-d H:i:s'));
    }
    return abs(floor(($t2 - $t1) / 60));
}

function extract_time($date) {
    return date_format(date_create($date), 'h:i a');
}

function extract_date($date) {
    return date_format(date_create($date), 'F j, o h:i a');
}

function make_reference(): string {
    return (string) ceil(floatval(microtime()) + rand(10000, 99999) + rand());
}

function peso_sign(): string {
    return '₱';
}

function get_sidebar(): string
{
    $uri = service('uri');
    $active = $uri->getSegment(2);
    $sub = $uri->setSilent()->getSegment(3);
    $sub_is_int = preg_match('/\d+/', $sub);
    return view('includes/sidebar/' . str_replace('-dashboard', '', config(Roles::class)->role_uri_assignments[session()->get('role')]), [
        'active' => $active,
        'sub' => $sub,
        'breadcrumbs' => view('includes/breadcrumbs', [
            'current_page' => ucfirst($sub != '' && !$sub_is_int && $uri->getTotalSegments() == 3 ? ucfirst($sub) : ucfirst($active)),
            'segments_count' => $uri->getTotalSegments(),
            'active' => ucfirst($active),
            'sub' => ucfirst($sub),
            'sub_is_int' => $sub_is_int
        ])
    ]);
}
