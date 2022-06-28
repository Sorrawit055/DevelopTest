<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('loginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->get('/signin', 'loginController::index');
$routes->post('/loginAuth', 'loginController::loginAuth');
$routes->get('/logout', 'loginController::logout');
$routes->get('/logout_message', 'loginController::logout_message');

$routes->get('/dashboard', 'AdminController::index', ['filter' => 'authGuard']);
$routes->get('/deleteProduct/(:any)', 'AdminController::deleteProduct/$1');
$routes->get('/deleteUser/(:any)', 'AdminController::deleteUser/$1');
$routes->get('/deleteCustomer/(:any)', 'AdminController::deleteCustomer/$1');
$routes->get('/deleteCategoryProduct/(:any)', 'AdminController::deleteCategoryProduct/$1');

$routes->get('/dashboard/index', 'AdminController::Cartindex');
$routes->post('/dashboard/update', 'AdminController::update');
$routes->get('/dashboard/buy/(:any)', 'AdminController::buy/$1');
$routes->get('/dashboard/remove/(:any)', 'AdminController::remove/$1');




$routes->post('/insertUser', 'AdminController::InsertUser');
$routes->post('/insertCustomer', 'AdminController::InsertCustomer');
$routes->post('/insertProduct', 'AdminController::InsertProduct');
$routes->post('/insertCategoryProduct', 'AdminController::InsertCategoryProduct');

$routes->get('/editUser/(:num)', 'AdminController::editUser/$1');
$routes->get('/editCustomer/(:num)', 'AdminController::editCustomer/$1');
$routes->get('/editProduct/(:num)', 'AdminController::editProduct/$1');
$routes->get('/editCategoryProduct/(:num)', 'AdminController::editCategoryProduct/$1');
$routes->get('/searchDataCustomer', 'AdminController::searchDataCustomer');
$routes->get('/order/(:num)/(:any)', 'AdminController::order/$1/$2');


$routes->post('/updateUser/(:any)', 'AdminController::updateUser/$1');
$routes->post('/updateCustomer/(:any)', 'AdminController::updateCustomer/$1');
$routes->post('/updateProduct/(:any)', 'AdminController::updateProduct/$1');
$routes->post('/updateCategoryProduct/(:any)', 'AdminController::updateCategoryProduct/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
