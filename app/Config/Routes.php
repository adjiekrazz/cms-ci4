<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Welcome');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'Welcome::index');

    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');

    // Routes for search
    $routes->get('search', 'Welcome::search');
    $routes->get('search/(:any)', 'Welcome::search/$1');
    $routes->get('search/(:any)/(:num)', 'Welcome::search/$1/$2');

    // Routes for blog
    $routes->get('blog', 'Welcome::blog');
    $routes->get('blog/(:num)', 'Welcome::blog/$1');
    // Routes for page
    $routes->get('page/(:any)', 'Welcome::page/$1');

    $routes->group('backend', ['filter' => 'login'],function($routes){
        $routes->get('', 'Dashboard::index');
        // article
        $routes->get('article', 'Article::index');
        $routes->post('article/getArticles', 'Article::getArticles');
        $routes->post('article/addArticle', 'Article::addArticle');
        $routes->post('article/editArticle', 'Article::editArticle');
        $routes->post('article/deleteArticle/(:num)', 'Article::deleteArticle/$1');
        // category
        $routes->get('category', 'Category::index');
        $routes->post('category/getCategories', 'Category::getCategories');
        $routes->post('category/addCategory', 'Category::addCategory');
        $routes->post('category/editCategory', 'Category::editCategory');
        $routes->post('category/deleteCategory/(:num)', 'Category::deleteCategory/$1');
        // page
        $routes->get('page', 'Page::index');
        $routes->post('page/getPages', 'Page::getPages');
        $routes->post('page/addPage', 'Page::addPage');
        $routes->post('page/editPage', 'Page::editPage');
        $routes->post('page/deletePage/(:num)', 'Page::deletePage/$1');
        // user
        $routes->get('user', 'User::index');
        $routes->post('user/getUsers', 'User::getUsers');
        $routes->post('user/addUser', 'User::addUser');
        $routes->post('user/editUser', 'User::editUser');
        $routes->post('user/deleteUser/(:num)', 'User::deleteUser/$1');
        // setting
        $routes->get('setting', 'Setting::index');
        $routes->post('setting/editSetting', 'Setting::editSetting');

        $routes->get('profile', 'Profile::index');
        $routes->post('profile/change-password', 'Profile::changePassword');
        
        $routes->get('about', 'About::index');
        $routes->match(['get', 'post'], 'ImageRender/(:segment)', 'ImageRender::index/$1');
    });

    // Routes for articles
    $routes->get('(:any)', 'Welcome::single/$1');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
