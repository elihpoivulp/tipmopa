<?php
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
    return date_format(date_create($date), 'H:i a');
}

function make_reference(): string {
    return (string) ceil(floatval(microtime()) + rand(10000, 99999));
}
