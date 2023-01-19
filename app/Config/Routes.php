<?php

namespace Config;
$routes = Services::routes();
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Welcome');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
$routes->get('/', 'Welcome::index');
$routes->get('generate', 'GenerateTestData::index');
$routes->get('login', 'Login::index', ['as' => 'login']);
$routes->post('login', 'Login::action');
$routes->post('logout', 'Logout::action', ['as' => 'logout', 'filter' => 'auth']);
$routes->get('register', 'Register::index', ['as' => 'register']);
$routes->post('register', 'Register::action');
$routes->group('', static function ($routes) {
    $routes->group('account', ['filter' => 'customer_only'], static function ($routes) {
        $routes->get('', 'Customer\\Customer::index', ['as' => 'customer-dashboard']);
        $routes->post('reserve', 'Customer\\Reserve::process_reservation', ['as' => 'customer-reserve-process']);
        $routes->get('reserve/(:num)', 'Customer\\Reserve::index/$1', ['as' => 'customer-reserve']);
        $routes->post('reserve/set-boarded', 'Customer\\Reserve::set_status', ['as' => 'customer-schedule-set-status']);
    });
    $routes->group('operator', ['filter' => 'operator_only'], static function ($routes) {
        $routes->get('', 'Operator\\Operator::index', ['as' => 'operator-dashboard']);
        $routes->post('', 'Operator\\Reserve::accept', ['as' => 'operator-reserve-accept']);
        $routes->post('schedule/set-status', 'Operator\\Schedules::set_status', ['as' => 'operator-schedule-set-status']);
        $routes->get('schedule/set-arrived', 'Operator\\Schedules::set_arrived', ['as' => 'operator-schedule-set-arrived']);
    });
    $routes->group('admin', ['filter' => 'admin_only'], static function ($routes) {
        $routes->get('', 'Admin\\Admin::index', ['as' => 'admin-dashboard']);
        $routes->get('users/create-new', 'Admin\\Users::create_new', ['as' => 'admin-users-register']);
        $routes->post('users/register', 'Admin\\Users::save', ['as' => 'admin-users-register']);
        $routes->get('users/(:alpha)', 'Admin\\Users::users_list/$1', ['as' => 'users-list']);
        $routes->get('reservations', 'Admin\\Users::reservations', ['as' => 'admin-reservations']);
    });

    $routes->post('notification/mark-seen/(:num)', 'Notifications::mark_seen/$1', ['as' => 'notifications-mark_seen']);
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
