<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Default application goes to form -builder


Route::get('/','FormsController@render_form_creator');

Route::post('/saveForm','FormsController@saveForm');


Route::get('/select_form','FormsController@select_form');
Route::model('form_c','Form_config');
// routes are added to render a particular form,, a form identifies by model using its form id
Route::get('/render_form/{form_c}','FormsController@render_form');
Route::post('/save_form_data','FormsController@save_form_data');
Route::get('/save_form_data','FormsController@save_form_data');
Route::get('/page_builder','FormsController@page_builder');
Route::post('/save_page_build','FormsController@save_page_build');
Route::post('/generate_form_data_table','FormsController@generate_form_data_table');
Route::model("page","Page_build");
Route::get("/arrange_page_elements/{page}","FormsController@arrange_page_elements");
