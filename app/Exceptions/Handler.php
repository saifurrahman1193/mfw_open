<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        // setSessionLanguage();


        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.' . '404', compact('genericbrandpicData', 'reviewData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData', 'categoryData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter3rdportion_category_products_data', 'topoffooter4thportion_category_products_data', 'bottomfooter_data'), 404)->header('name', 'error');
            }
        }
        
        return parent::render($request, $exception);
    }
}
