<?php
/**
 * Created by PhpStorm.
 * User: Roni Sinaga
 * Date: 11/23/2017
 * Time: 4:01 AM
 */

Route::get('/general/home/','jayakari\bic\general\Controllers\HomeController@index');
Route::get('/general/home/old','jayakari\bic\general\Controllers\HomeController@index_old');
Route::get('/general/home/new','jayakari\bic\general\Controllers\HomeController@newLayout');
Route::get('/general/home/new1','jayakari\bic\general\Controllers\HomeController@newLayout1');
Route::get('/general/home/kegiatan','jayakari\bic\general\Controllers\HomeController@kegiatan');
Route::get('/general/about/','jayakari\bic\general\Controllers\AboutController@index');
Route::get('/general/inovasi/','jayakari\bic\general\Controllers\InnovasiController@index');
Route::get('/general/inovasi/inovasipertahun/{tahun}','jayakari\bic\general\Controllers\InnovasiController@inovasipertahun');
Route::get('/general/inovasi/inovasidetail/{judul}','jayakari\bic\general\Controllers\InnovasiController@inovasidetail');
Route::get('/general/login/','jayakari\bic\general\Controllers\HomeController@login');
Route::get('/general/manual','jayakari\bic\general\Controllers\HomeController@manual');
Route::get('/general/manual/inovator','jayakari\bic\general\Controllers\HomeController@inovator');
Route::get('/general/manual/inovator/{id}','jayakari\bic\general\Controllers\HomeController@detailInovator');
Route::get('/general/manual/reviewer','jayakari\bic\general\Controllers\HomeController@reviewer');
Route::get('/general/manual/reviewer/{id}','jayakari\bic\general\Controllers\HomeController@detailReviewer');
Route::get('/general/manual/proses','jayakari\bic\general\Controllers\HomeController@adminProses');
Route::get('/general/manual/proses/{id}','jayakari\bic\general\Controllers\HomeController@detailAdminProses');
Route::get('/general/manual/juri','jayakari\bic\general\Controllers\HomeController@juri');
Route::get('/general/manual/juri/{id}','jayakari\bic\general\Controllers\HomeController@detailJuri');
Route::get('/general/diagram','jayakari\bic\general\Controllers\HomeController@diagram');
Route::post('/general/sendEmail','jayakari\bic\general\Controllers\HomeController@sendEmail');
Route::get('/general/registrasi/','jayakari\bic\general\Controllers\HomeController@registrasi');
Route::get('/general/registrasi/seminar','jayakari\bic\general\Controllers\HomeController@registrasiseminar')->name('registrasi.seminar');
Route::post('/general/registrasi/seminar/save','jayakari\bic\general\Controllers\HomeController@saveRegistrasiSeminar')->name('registrasi.seminar.save');
Route::get('/general/terimakasih/','jayakari\bic\general\Controllers\HomeController@terimakasih');
Route::get('/general/registrasi/seminar/terimakasih','jayakari\bic\general\Controllers\HomeController@terimakasihSeminar');
Route::get('/general/email/','jayakari\bic\general\Controllers\HomeController@emailContent');
Route::get('/general/statistic','jayakari\bic\general\Controllers\HomeController@statistic');
Route::get('/general/viewVideo/{videoid}','jayakari\bic\general\Controllers\HomeController@viewVideo');
Route::get('/general/about','jayakari\bic\general\Controllers\HomeController@about')->name('general.about');
Route::get('/general/about/bic','jayakari\bic\general\Controllers\HomeController@aboutBIC')->name('general.about.bic');
Route::get('/general/testimoni','jayakari\bic\general\Controllers\HomeController@testimoni')->name('general.testimoni');
Route::post('/general/faq','jayakari\bic\general\Controllers\HomeController@faq')->name('general.faq');

Route::get('/blog/{judul?}','jayakari\bic\general\Controllers\BlogController@index')->name('general.kristanto');
Route::post('/blog/saveComment','jayakari\bic\general\Controllers\BlogController@saveComment')->name('blog.save.comment');

Route::get('/general/home/migrasi','jayakari\bic\general\Controllers\HomeController@migrasi');

/*
 * Berita
 */
Route::get('/general/berita/','jayakari\bic\general\Controllers\InnovasiController@index');
Route::get('/general/berita/all','jayakari\bic\general\Controllers\BeritaController@all');
Route::get('/general/berita/{kategori}/{title}/{id}','jayakari\bic\general\Controllers\BeritaController@showBerita');
Route::post('/general/berita/saveComment','jayakari\bic\general\Controllers\BeritaController@saveComment');
Route::get('/general/berita/{id}/download/{title}','jayakari\bic\general\Controllers\BeritaController@download');
/*
 * End Berita
 */

/*
 * Video
 */
Route::get('/general/video/all','jayakari\bic\general\Controllers\VideoController@all');
/*
 * End Video
 */

/*
 * Buku
 */
Route::get('/general/buku/{judul}','jayakari\bic\general\Controllers\BukuController@index');
Route::get('/general/buku/{judul}/{sort}/{alphabet}','jayakari\bic\general\Controllers\BukuController@alphabet');
Route::get('/general/buku/{judul}/{sort}','jayakari\bic\general\Controllers\BukuController@sort');
Route::get('/general/inreview/buku','jayakari\bic\general\Controllers\BukuController@inreview')->name('general.book.inreview');
Route::get('/general/buku/all/in/all/incubator','jayakari\bic\general\Controllers\BukuController@incubator')->name('general.book.incubator');
Route::get('/general/berita/{kategori}/{title}','jayakari\bic\general\Controllers\BeritaController@showBerita');
Route::post('/general/berita/saveComment','jayakari\bic\general\Controllers\BeritaController@saveComment');
Route::get('/general/download/{id}/','jayakari\bic\general\Controllers\BukuController@download');
Route::get('/general/downloadFile/{id}/','jayakari\bic\general\Controllers\BukuController@downloadFile');
Route::get('/general/view/{judul}/','jayakari\bic\general\Controllers\BukuController@view')->name('buku.view');
Route::get('/general/kategori/{kategori}','jayakari\bic\general\Controllers\BukuController@kategori');
Route::get('/general/kategori/{kategori}/{sort}/{alphabet}','jayakari\bic\general\Controllers\BukuController@kategoriAlphabet');
Route::get('/general/kategori/{kategori}/{sort}','jayakari\bic\general\Controllers\BukuController@kategoriSort');
Route::get('/general/view/proposal/{id}/','jayakari\bic\general\Controllers\BukuController@viewProposal')->name('buku.proposal');
Route::get('/general/buku/inreview/page/all/view','jayakari\bic\general\Controllers\BukuController@inreviewPage')->name('general.book.inreview.page');
Route::get('/general/inreview/{judul}/','jayakari\bic\general\Controllers\BukuController@inreviewTitle')->name('buku.inreview');
Route::get('/general/inreview/proposal/{id}/','jayakari\bic\general\Controllers\BukuController@viewProposalInReview')->name('buku.inreview.proposal');
Route::get('/general/inreview/downloadFile/{id}/','jayakari\bic\general\Controllers\BukuController@downloadFileInReview')->name('buku.inreview.download.file');
/*
 * End Buku
 */

/*
 * Buku
 */
Route::get('/general/inovator/{nickname}','jayakari\bic\general\Controllers\InovatorController@index')->name('buku.inovasi');