<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/login', 'Auth\AuthController@getLogin');

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/register', 'Auth\AuthController@showRegistrationForm');

Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm');

Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail');

Route::post('/password/reset', 'Auth\PasswordController@reset');


Route::get('/comment-ca-marche', 'StaticController@CommentCaMarche');

Route::get('/mentions-legales', 'StaticController@MentionsLegales');

Route::get('/contact', 'StaticController@Contact');

Route::post('/contact-nous', 'StaticController@SendMail');

Route::get('/events-hourly', 'StaticController@HourlyEvents');

Route::get('/events-daily', 'StaticController@DailyEvents');

Route::get('/orders/paiement', 'StaticController@Payment');
/**
 * This create the following route:
 * - Method Route MethodController
 * - GET /orders/create create = get the view for create order
 * - POST /orders store = create a new order(Ask for payback)
 * - GET /orders/{id} show = get the order with this id(Order info,
 *   info of payback,info of payment)
 * - GET /orders/{id}/orders edit = get the edit view (view)
 * - PUT/PATCH /orders/{id} update = update the orders with this id(api)
 */
/**
 * This route get the orders where the user is customer (web)
 */
Route::get('/orders/remboursementsamavinoteam', 'OrderController@OrderOwnerList');
/**
 * This route get the orders where the user is seller (web)
 */
Route::get('/orders/mesdemandesderemboursement', 'OrderController@OrderBuyerList');

/**
 * This route get the page for chose the payment Method (web)
 */
Route::get('/orders/{id}/paymentMethod', 'OrderController@OrdersPaymentMethodView');

/**
 * This route redirect to the correct page with the choice (web)
 */
Route::get('/orders/{id}/paymentMethodChoose/{choosePayment}', 'OrderController@OrdersPaymentMethod');

/**
 * This route get the page for put the card information (web)
 */
Route::get('/orders/{id}/paymentCB', 'OrderController@OrdersPaymentCB');

/**
 * This route make the payment with CB (api)
 */
Route::get('/orders/{id}/paymentCBValidate/{cardRegisterId}', 'OrderController@OrdersPaymentCBValidate');

/**
 * This route is for redirect after 3Dsecure (api)
 */
Route::get('/orders/{id}/3Dsecure', 'OrderController@OrdersPaymentCBSecure');

Route::resource('orders', 'OrderController', ['except' => ['destroy']]);

/**
 * This route get the orders where the user is customer (api)
 */
Route::get('/orders/owner/{id}', 'OrderController@OrdersOwners');
/**
 * This route get the orders where the user is seller (api)
 */
Route::get('/orders/buyer/{id}', 'OrderController@OrdersBuyers');

/**
 * This route get the orders where the user is customer (api)
 * And where the order is validate(Payment history)
 */
Route::get('/orders/owner/validated/{id}', 'OrderController@OrdersOwnersValidated');
/**
 * This route get the orders where the user is seller (api)
 * And where the order is validate(Payback history)
 */
Route::get('/orders/buyer/validated/{id}', 'OrderController@OrdersBuyersValidated');
/**
 * This route valide one order(Change status) (view)
 */
Route::put('/orders/{id}/payment/view','OrderController@OrdersPaymentView');
/**
 * This route valide one order(Change status) (api)
 */
Route::put('/orders/{id}/payment','OrderController@OrdersPayment');
/**
 * This route will valid one order(Change status) (web)
 */
Route::get('/orders/{id}/payment/validate','OrderController@OrdersPaymentValidate');
/**
 * This route will cancel one order(Change status) (web)
 */
Route::get('/orders/{id}/cancel','OrderController@OrdersCancel');
/**
 * This route consult the order (web)
 */
Route::get('/orders/{id}/consult','OrderController@consult');

/**
 * This create the following route:
 * - Method Route MethodController
 * - GET /houses/create create = get the view for create houses (view)
 * - POST /houses store = create a new house(Manage wine owner, Add wine in my house,
 *  Add wine in friend house) (api)
 * - GET /houses/{id} show = get the house with this id(house info) (api)
 * - GET /houses/{id}/houses edit = get the edit view (view)
 * - PUT/PATCH /houses/{id} update = update the houses with this id(edit wine in my house,
 *  edit wine in friend house) (api)
 */
/**
 * Get the view of house create when you are buyer (show)
 */
Route::get('/houses/mesvins', 'HouseController@MesVinsList');
/**
 * Get the view of house create when you are owner (show)
 */
Route::get('/houses/lesvinsdemesamis', 'HouseController@AmisVinsList');
Route::resource('houses', 'HouseController', ['except' => ['edit', 'destroy']]);

/**
 * Get the view of house create when you are buyer (show)
 */
Route::get('/houses/buyer/create', 'HouseController@create_buyer');
/**
 * Get the view of house create when you are owner (show)
 */
Route::get('/houses/owner/create', 'HouseController@create_owner');
/**
 * Create house create when you are buyer (api)
 */
Route::post('/houses/buyer/store', 'HouseController@store_buyer');
/**
 * Create a house create when you are owner (api)
 */
Route::post('/houses/owner/store', 'HouseController@store_owner');
/**
 * Get the view of house edit when you are buyer (show)
 */
Route::get('/houses/buyer/{id}/edit', 'HouseController@edit_buyer');
/**
 * Get the view of house edit when you are owner (show)
 */
Route::get('/houses/owner/{id}/edit', 'HouseController@edit_owner');
/**
 * Update house when you are buyer (api)
 */
Route::put('/houses/buyer/{id}/update', 'HouseController@update_buyer');
/**
 * Update a house when you are owner (api)
 */
Route::put('/houses/owner/{id}/update', 'HouseController@update_owner');

/**
 * Get all of the houses where the user is the owner of the wine(wines in friends house's) (api)
 */
Route::get('/houses/owner/{id}', 'HouseController@HousesOwner');
/**
 * Get all of the houses where the user is the seller of the wine(wines in my house) (api)
 */
Route::get('/houses/buyer/{id}', 'HouseController@HousesBuyer');
/**
 * Get the wine's informtions of a house (wines in my house) (api)
 */
Route::get('/houses/{id}/history', 'HouseController@HousesCave');


/**
 * Get all of the houses where the user is the owner of the wine(wines in friends house's) (api)
 */
Route::get('/houses/empty/owner/{id}', 'HouseController@HousesOwnerEmpty');
/**
 * Get all of the houses where the user is the seller of the wine(wines in my house) (api)
 */
Route::get('/houses/empty/buyer/{id}', 'HouseController@HousesBuyerEmpty');


Route::get('/users/profile', 'UserController@profile');

/**
 * Get the update view for payment info of the user
 */
Route::get('/users/paymentInfo', 'UserController@paymentInfoEditView');

Route::get('/users/deletePaymentCard', 'UserController@CBdelete');

/**
 * This create the following route:
 * - Method Route MethodController
 * - GET /users index = list all of the users
 * - GET /users/{id} show = get the user with this id(Profile)
 * - GET /users/{id}/edit edit = get the edit view
 * - PUT/PATCH /users/{id} update = update the user with this id(Update profile)
 */
Route::resource('users', 'UserController', ['except' => ['destroy']]);

/**
 * Get the update view for payment info of the user
 */
Route::get('/newAccount', 'UserController@newAccount');
/**
 * Get the update view for payment info of the user
 */
Route::get('/bankAccountNotVerified', 'UserController@bankAccountNotVerified');

/**
 * Validate account email
 */
Route::get('/users/{id}/activateAccount', 'UserController@validateAccount');

/**
 * Update the payment info of the user
 */
Route::put('/users/{id}/paymentInfo', 'UserController@paymentInfoUpdate');

/**
 * Get the wines of the user
 */
Route::get('/user/{id}/wines', 'UserController@UserWines');


/**
 * This create the following route:
 * - Method Route MethodController
 * - GET /wines/{id} show = get the wine with this id
 */
Route::resource('wines', 'WineController', ['except' => ['destroy','index','update','edit']]);

/**
 * Route for get the city by match expression
 */
Route::get('/cities','CityController@getCities');
Route::get('/cities/zipcode','CityController@getCitiesByZipcode');

 /**
  * Invite Friends
  */
 Route::get('/ma-vinoteam/inviter-des-amis','VinoTeamController@InviteFriendsIndex');

 Route::post('/ma-vinoteam/inviter-des-amis','VinoTeamController@InviteFriends');

/**
 * Ma VinoTeam
 */
Route::get('/ma-vinoteam','VinoTeamController@MaVinoTeamIndex');

Route::get('/ma-vinoteam/rechercher-un-ami','VinoTeamController@SearchFriendsIndex');

Route::get('/ma-vinoteam/supprimer-un-ami/{id}','VinoTeamController@SupprimerAmiDeMaVinoTeam');

Route::post('/ma-vinoteam/rechercher-un-ami','VinoTeamController@SearchFriendsResults');

Route::get('/ma-vinoteam/ajouter-un-ami/{id}','VinoTeamController@AjouterAmiAMaVinoTeam');

 /**
  * Bon plan
  */
 Route::get('/proposer-un-bon-plan','VinoTeamController@BonPlanIndex');

 Route::post('/proposer-un-bon-plan','VinoTeamController@ProposerBonPlan');
