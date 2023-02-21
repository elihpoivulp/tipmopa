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

function get_time_diff($t1, $t2 = null)
{
    if (is_null($t2)) {
        $t2 = strtotime(date('Y-m-d H:i:s'));
    }
    return abs(floor(($t2 - $t1) / 60));
}

function extract_time($date)
{
    return date_format(date_create($date), 'h:i a');
}

function extract_date($date)
{
    return date_format(date_create($date), 'F j, o h:i a');
}

function make_reference(): string
{
    return (string)ceil(floatval(microtime()) + rand(10000, 99999) + rand());
}

function peso_sign(): string
{
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
            'current_page' => ucfirst($sub != '' && !$sub_is_int && $uri->getTotalSegments() >= 3 ? ucfirst($sub) : ucfirst($active)),
            'segments_count' => $uri->getTotalSegments(),
            'active' => ucfirst($active),
            'sub' => ucfirst($sub),
            'sub_is_int' => $sub_is_int
        ])
    ]);
}

function get_ts_init_data(): array
{
    return [
        [
            'boat_id' => '1',
            'schedule_id' => '1',
            'start_location_id' => '2',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '2',
            'schedule_id' => '2',
            'start_location_id' => '3',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '3',
            'schedule_id' => '3',
            'start_location_id' => '4',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '4',
            'schedule_id' => '4',
            'start_location_id' => '5',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '5',
            'schedule_id' => '5',
            'start_location_id' => '1',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '6',
            'schedule_id' => '6',
            'start_location_id' => '1',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '7',
            'schedule_id' => '7',
            'start_location_id' => '1',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
        [
            'boat_id' => '8',
            'schedule_id' => '8',
            'start_location_id' => '1',
            'schedule_date' => date('Y-m-d'),
            'departed_1' => 0,
            'departed_2' => 0
        ],
    ];
}

function get_reserved_by_user($ts_id, $type = 'in', $id = null) {
    if (is_null($id)) {
        $id = session()->get('id');
    }
    return array_column(model(\App\Models\Reservation::class)->select('trip_schedule_id')
        ->where('user_id', $id)
        ->where('trip_schedule_id', $ts_id)
        ->where('type', $type)
        ->findAll(), 'trip_schedule_id');
}
