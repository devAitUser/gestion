<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('pdfview',[App\Http\Controllers\DevisController::class, 'pdf']);






/*** Model clients  * */

Route::resource('clients', App\Http\Controllers\ClientsController::class);
Route::get('/getclient',[App\Http\Controllers\ClientsController::class, 'get_client']);
Route::get('/clients/{id}/edit',[App\Http\Controllers\ClientsController::class, 'edit']);
Route::post('/clients/store',[App\Http\Controllers\ClientsController::class, 'store']);

Route::delete('/deleteclients/{id}',[App\Http\Controllers\ClientsController::class, 'destroy']);
Route::post('/updateclients/{id}',[App\Http\Controllers\ClientsController::class, 'update']);

Route::get('/client/{id}/edit',[App\Http\Controllers\ClientsController::class, 'edit']);

Route::get('/getclients',[App\Http\Controllers\ClientsController::class, 'get_clients']);

/*** Model historique paiements   * */

Route::get('/paiements/{id}',[App\Http\Controllers\Historique_paiementController::class, 'index']);
Route::get('/paiements/create/{id}',[App\Http\Controllers\Historique_paiementController::class, 'create']);
Route::get('/getpaiements/{id}',[App\Http\Controllers\Historique_paiementController::class, 'get_paiements']);
Route::get('/paiements/{id}/edit',[App\Http\Controllers\Historique_paiementController::class, 'edit']);
Route::post('/paiements/store',[App\Http\Controllers\Historique_paiementController::class, 'store']);

Route::delete('/deletepaiements/{id}',[App\Http\Controllers\Historique_paiementController::class, 'destroy']);
Route::post('/updatepaiements/{id}',[App\Http\Controllers\Historique_paiementController::class, 'update']);

Route::get('/paiements/{id}/edit',[App\Http\Controllers\Historique_paiementController::class, 'edit']);


/*** Model factures fournisseur  ***/


Route::get('/factures_fournisseur/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'index']);
Route::get('/factures_fournisseur/create/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'create']);
Route::get('/factures_fournisseur/store',[App\Http\Controllers\Factures_fournisseurController::class, 'store']);
Route::get('/getfactures_fournisseur/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'get_factures_fournisseur']);
Route::get('/factures_fournisseur/{id}/edit',[App\Http\Controllers\Factures_fournisseurController::class, 'edit']);
Route::post('/factures_fournisseur/store',[App\Http\Controllers\Factures_fournisseurController::class, 'store']);

Route::delete('/delete_factures_fournisseur/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'destroy']);
Route::post('/update_factures_fournisseur/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'update']);

Route::get('/factures_fournisseur/{id}/edit',[App\Http\Controllers\Factures_fournisseurController::class, 'edit']);

Route::get('/get_all_factures_fournisseur',[App\Http\Controllers\Factures_fournisseurController::class, 'get_all_factures_fournisseur']);




Route::get('/factures_fournisseur_pdf/{id}',[App\Http\Controllers\Factures_fournisseurController::class, 'pdf']);



Route::get('/view_all_factures_fournisseur',[App\Http\Controllers\Factures_fournisseurController::class, 'view_all']);




/*** Model projets  * */

Route::resource('projets', App\Http\Controllers\ProjetsController::class);
//Route::get('/getprojets',[App\Http\Controllers\ClientsController::class, 'get_projets']);
Route::get('/projets/{id}/edit',[App\Http\Controllers\ProjetsController::class, 'edit']);
Route::post('/projets/store',[App\Http\Controllers\ProjetsController::class, 'store']);

Route::delete('/deleteprojets/{id}',[App\Http\Controllers\ProjetsController::class, 'destroy']);
Route::post('/updateprojets/{id}',[App\Http\Controllers\ProjetsController::class, 'update']);

Route::get('/projets/{id}/edit',[App\Http\Controllers\ProjetsController::class, 'edit']);

Route::get('/getprojets',[App\Http\Controllers\ProjetsController::class, 'get_projets']);






/*** Model Facture  * */

Route::resource('facture', App\Http\Controllers\FactureController::class);
Route::get('/getdevis',[App\Http\Controllers\FactureController::class, 'get_client']);

Route::post('/facture/store',[App\Http\Controllers\FactureController::class, 'store']);

Route::delete('/deletefacture/{id}',[App\Http\Controllers\FactureController::class, 'destroy']);
Route::post('/updatefacture',[App\Http\Controllers\FactureController::class, 'update']);

Route::get('/getdevis1',[App\Http\Controllers\FactureController::class, 'getdevis']);

Route::get('/facture_pdf/{id}',[App\Http\Controllers\FactureController::class, 'pdf']);



/*** Model fournisseur  * */

Route::resource('fournisseur', App\Http\Controllers\FournisseurController::class);
Route::get('/getfournisseur',[App\Http\Controllers\FournisseurController::class, 'get_fournisseur']);
Route::get('/fournisseur/{id}/edit',[App\Http\Controllers\FournisseurController::class, 'edit']);
Route::post('/fournisseur/store',[App\Http\Controllers\FournisseurController::class, 'store']);

Route::delete('/deletefournisseurs/{id}',[App\Http\Controllers\FournisseurController::class, 'destroy']);
Route::post('/updatefournisseurs/{id}',[App\Http\Controllers\FournisseurController::class, 'update']);

Route::get('/fournisseur/{id}/edit',[App\Http\Controllers\FournisseurController::class, 'edit']);





/*** Model stocks   * */

Route::resource('stocks', App\Http\Controllers\StockController::class);

Route::post('/poststocks',[App\Http\Controllers\StockController::class, 'store']);

Route::get('/getstocks',[App\Http\Controllers\StockController::class, 'get_gategorie']);

Route::put('/updatestocks',[App\Http\Controllers\StockController::class, 'update']);


Route::get('/all_stocks',[App\Http\Controllers\StockController::class, 'all_stocks']);


Route::get('/all_views_stock/{id}',[App\Http\Controllers\StockController::class, 'view_stock']);

Route::delete('/deletestocks/{id}',[App\Http\Controllers\StockController::class, 'destroy']);

Route::get('/get_data_stock/{id}',[App\Http\Controllers\StockController::class, 'get_data_stock']);






/*** Model order   * */

Route::resource('order', App\Http\Controllers\OrderController::class);
Route::post('/getphone',[App\Http\Controllers\OrderController::class, 'get_phone_client']);
Route::get('/getorder',[App\Http\Controllers\OrderController::class, 'getorder']);
Route::get('/create_order_s',[App\Http\Controllers\OrderController::class, 'create_superviseur']);
Route::post('/validation_commande',[App\Http\Controllers\OrderController::class, 'validation_commande']);
Route::post('update_order', [App\Http\Controllers\OrderController::class, 'update']);
Route::post('/livre/{id}', [App\Http\Controllers\OrderController::class, 'livre']);
Route::delete('/deleteproduct/{id}',[App\Http\Controllers\OrderController::class, 'destroy']);


/*** Model utilisateurs permission  * */

Route::post('/permission_assigner', [App\Http\Controllers\PermissionsController::class, 'assignPermissions']);

Route::get('permission', [App\Http\Controllers\UserController::class, 'permissions'])->name('permission');

Route::get('users', [App\Http\Controllers\UserController::class, 'users'])->name('users');

Route::get('get_users', [App\Http\Controllers\UserController::class, 'get_users']);



Route::post('user_post', [App\Http\Controllers\UserController::class, 'create_user']);

Route::delete('/delete_user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit']);

Route::get('/user/{id}/edit_owner', [App\Http\Controllers\UserController::class, 'edit_owner'])->name('edit_owner');

Route::post('/update_user',[App\Http\Controllers\UserController::class, 'update']);


Route::get('permission_order', [App\Http\Controllers\UserController::class, 'permission_order'])->name('permission_order');


Route::get('permission', [App\Http\Controllers\UserController::class, 'permissions'])->name('permission');

/*** Model Role  * */

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::post('/postrole',[App\Http\Controllers\RoleController::class, 'store']);

Route::get('/getroles',[App\Http\Controllers\RoleController::class, 'get_roles']);

Route::put('/updaterole',[App\Http\Controllers\RoleController::class, 'update']);

Route::delete('/deleterole/{id}',[App\Http\Controllers\RoleController::class, 'destroy']);





/*** Model RH  * */

Route::resource('rh', App\Http\Controllers\RhController::class);
Route::get('/getrh',[App\Http\Controllers\RhController::class, 'get_rh']);
Route::post('/rh/{id}/edit',[App\Http\Controllers\RhController::class, 'edit']);
Route::post('/rh/store',[App\Http\Controllers\RhController::class, 'store']);

Route::delete('/deleterh/{id}',[App\Http\Controllers\RhController::class, 'destroy']);
Route::post('/updaterh/{id}',[App\Http\Controllers\RhController::class, 'update']);

Route::post('/store_affectation',[App\Http\Controllers\RhController::class, 'store_affectation']);


Route::post('/update_affectation',[App\Http\Controllers\RhController::class, 'update_affectation']);

Route::post('/delete_affectation/{id}',[App\Http\Controllers\RhController::class, 'delete_affectation']);


/*** Model Pointage  * */

Route::resource('pointage', App\Http\Controllers\PointageController::class);
Route::get('/getpointage',[App\Http\Controllers\PointageController::class, 'get_rh']);
Route::post('/pointage/{id}/edit',[App\Http\Controllers\PointageController::class, 'edit']);



























Auth::routes();
