<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * All urls should be hyphenated
 */

// All api route names are prefixed with api.
Route::name('api.')->group(function () {
    // Stripe (not auth restricted)
    Route::post('stripe/intent/make', 'Api\Banking\StripeController@makeIntent')->name('stripe.make-intent');
    Route::post('stripe/intent/update', 'Api\Banking\StripeController@updateIntent')->name('stripe.update-intent');
    Route::post('stripe/intent/success', 'Api\Banking\StripeController@intentSuccess')->name('stripe.intent-success');

    Route::middleware('auth:api')->group(function () {
        // Search for members
        // api/search/users/matt                    Search term as part of the
        // api/search/users?q=matt                  Search term as a parameter
        // api/search/users?q=matt&withAccount=true Only search for members with Accounts
        Route::get('search/users/{searchQuery?}', 'Api\SearchController@users')
            ->name('search.users');

        Route::get('search/invites/{searchQuery?}', 'Api\SearchController@invites')
            ->name('search.invites');

        // Snackspace
        Route::patch(
            'snackspace/vending-machines/{vendingMachine}/locations',
            'Api\Snackspace\VendingMachineController@locationAssign'
        )->name('snackspace.vending-machines.locations.assign');

        // Tools
        Route::apiResource('tools/{tool}/bookings', 'Api\Tools\BookingController');
    });
});

// All 'client_credentials' api route names are prefixed with client.
Route::name('client.')->middleware('client')->group(function () {
    // upload new bankTransactions/
    Route::post('bank-transactions/upload', 'Api\Banking\TransactionUploadController@upload')
        ->name('bankTransactions.upload');
});

Route::name('webhook.')->group(function () {
    Route::stripeWebhooks('stripe/webhook')->name('stripe');
});
