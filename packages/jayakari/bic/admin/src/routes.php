<?php

/*
 * Home
 */
Route::get('/admin/home/','jayakari\bic\admin\Controllers\HomeController@index');
Route::get('/admin/home/inovator','jayakari\bic\admin\Controllers\HomeController@inovator');
Route::get('/admin/home/juri','jayakari\bic\admin\Controllers\HomeController@juri');
Route::get('/admin/home/reviewer','jayakari\bic\admin\Controllers\HomeController@reviewer');
Route::get('/admin/home/proposal','jayakari\bic\admin\Controllers\HomeController@proposal');
Route::get('/admin/home/technical','jayakari\bic\admin\Controllers\HomeController@technical');
Route::get('/admin/home/administrasi','jayakari\bic\admin\Controllers\HomeController@administrasi');
Route::get('/admin/home/designer','jayakari\bic\admin\Controllers\HomeController@designer');
/*
 * End Of Home
 */

/*
 * User
 */
Route::get('/admin/usergroup','jayakari\bic\admin\Controllers\UsersController@usergroup');
Route::get('/admin/usergroup/create','jayakari\bic\admin\Controllers\UsersController@addUserGroup');
Route::post('/admin/usergroup/create','jayakari\bic\admin\Controllers\UsersController@storeUserGroup');
Route::get('/admin/usergroup/{id}/edit','jayakari\bic\admin\Controllers\UsersController@editUserGroup');
Route::post('/admin/usergroup/{id}/edit','jayakari\bic\admin\Controllers\UsersController@updateUserGroup');
Route::get('/admin/usergroup/{id}/delete','jayakari\bic\admin\Controllers\UsersController@deleteUserGroup');
Route::post('/admin/usergroup/{id}/delete','jayakari\bic\admin\Controllers\UsersController@deleteDataUserGroup');
Route::get('/admin/users','jayakari\bic\admin\Controllers\UsersController@listusers');
Route::get('/admin/users/create','jayakari\bic\admin\Controllers\UsersController@add');
Route::post('/admin/users/create','jayakari\bic\admin\Controllers\UsersController@store');
Route::get('/admin/users/{id}/edit','jayakari\bic\admin\Controllers\UsersController@edit');
Route::post('/admin/users/{id}/edit','jayakari\bic\admin\Controllers\UsersController@update');
Route::get('/admin/users/{id}/delete','jayakari\bic\admin\Controllers\UsersController@delete');
Route::post('/admin/users/{id}/delete','jayakari\bic\admin\Controllers\UsersController@deleteData');
Route::post('/admin/users/validate','jayakari\bic\admin\Controllers\UsersController@validateUser');
Route::post('/admin/users/updateProfile','jayakari\bic\admin\Controllers\UsersController@updateProfile');
Route::post('/admin/users/ubahPassword','jayakari\bic\admin\Controllers\UsersController@ubahPassword');
Route::post('/admin/users/uploadFile','jayakari\bic\admin\Controllers\UsersController@uploadFile');
Route::get('/admin/userassign','jayakari\bic\admin\Controllers\UsersController@listuserassign');
Route::get('/admin/userassign/{id}/edit','jayakari\bic\admin\Controllers\UsersController@assignCategory');
Route::post('/admin/userassign/{id}/edit','jayakari\bic\admin\Controllers\UsersController@saveAssignCategory');
Route::get('/admin/users/{id}/changeCategory','jayakari\bic\admin\Controllers\UsersController@changeCategory');
Route::get('/admin/juri/reset','jayakari\bic\admin\Controllers\UsersController@resetPassword');
Route::post('/admin/juri/reset','jayakari\bic\admin\Controllers\UsersController@ubahPasswordJuri');

Route::get('/admin/superuser/profile','jayakari\bic\admin\Controllers\UsersController@profile');
Route::get('/admin/proposal/profile','jayakari\bic\admin\Controllers\UsersController@profile');
/*
 * End User
 */

/*
 * Menu
 */
Route::get('/admin/menugroup','jayakari\bic\admin\Controllers\MenusController@menugroup')->name('menus.menugroup');
Route::get('/admin/menugroup/{id}/current','jayakari\bic\admin\Controllers\MenusController@currentMenuGroup')->name('menus.currentMenuGroup');
Route::get('/admin/menugroup/{id}/edit','jayakari\bic\admin\Controllers\MenusController@editMenuGroup')->name('menus.editMenuGroup');
Route::post('/admin/menugroup/{id}/edit','jayakari\bic\admin\Controllers\MenusController@updateMenuGroup')->name('menus.updateMenuGroup');
Route::get('/admin/menugroup/{id}/delete','jayakari\bic\admin\Controllers\MenusController@deleteMenuGroup')->name('menus.deleteMenuGroup');
Route::post('/admin/menugroup/{id}/delete','jayakari\bic\admin\Controllers\MenusController@deleteDataMenuGroup')->name('menus.deleteDataMenuGroup');
Route::get('/admin/menugroup/create','jayakari\bic\admin\Controllers\MenusController@addMenuGroup')->name('menus.addMenuGroup');
Route::post('/admin/menugroup/create','jayakari\bic\admin\Controllers\MenusController@storeMenuGroup')->name('menus.storeMenuGroup');
Route::get('/admin/menus','jayakari\bic\admin\Controllers\MenusController@listmenus')->name('menus.listmenus');
Route::get('/admin/menus/{id}/current','jayakari\bic\admin\Controllers\MenusController@current')->name('menus.current');
Route::get('/admin/menus/{id}/edit','jayakari\bic\admin\Controllers\MenusController@edit')->name('menus.edit');
Route::post('/admin/menus/{id}/edit','jayakari\bic\admin\Controllers\MenusController@update')->name('menus.update');
Route::get('/admin/menus/{id}/delete','jayakari\bic\admin\Controllers\MenusController@delete')->name('menus.delete');
Route::post('/admin/menus/{id}/delete','jayakari\bic\admin\Controllers\MenusController@deleteData')->name('menus.deleteData');
Route::get('/admin/menus/create','jayakari\bic\admin\Controllers\MenusController@add')->name('menus.add');
Route::post('/admin/menus/create','jayakari\bic\admin\Controllers\MenusController@store')->name('menus.store');
/*
 * End Menu
 */

/*
 * News
 */
Route::get('/admin/news/newsgroup','jayakari\bic\admin\Controllers\NewsController@newsgroup');
Route::get('/admin/news/addnewsgroup','jayakari\bic\admin\Controllers\NewsController@addnewsgroup');
Route::get('/admin/news/editNewsGroup','jayakari\bic\admin\Controllers\NewsController@editNewsGroup');
Route::get('/admin/news/deleteNewsGroup','jayakari\bic\admin\Controllers\NewsController@deleteNewsGroup');
Route::get('/admin/news/listnews','jayakari\bic\admin\Controllers\NewsController@listnews');
Route::get('/admin/news/addnews','jayakari\bic\admin\Controllers\NewsController@addnews');
Route::get('/admin/news/editNews','jayakari\bic\admin\Controllers\NewsController@editNews');
Route::get('/admin/news/deleteNews','jayakari\bic\admin\Controllers\NewsController@deleteNews');
Route::get('/admin/news/findnews','jayakari\bic\admin\Controllers\NewsController@findnews');
Route::get('/admin/news/newsimage','jayakari\bic\admin\Controllers\NewsController@newsimage');
Route::get('/admin/news/selectedNewsImage','jayakari\bic\admin\Controllers\NewsController@selectedNewsImage');
Route::post('/admin/news/deaktivasi','jayakari\bic\admin\Controllers\NewsController@deaktivasi')->name('admin.news.deaktivasi');
/*
 * End News
 */

/*
 * Proposals
 */
Route::get('/admin/proposals/{id}/download','jayakari\bic\admin\Controllers\ProposalsController@download');
Route::get('/admin/proposals/listproposals','jayakari\bic\admin\Controllers\ProposalsController@listproposals');
Route::get('/admin/proposals/listProposalsReviewer','jayakari\bic\admin\Controllers\ProposalsController@listProposalsReviewer');
Route::get('/admin/proposals/listProposalsSudahReview','jayakari\bic\admin\Controllers\ProposalsController@listProposalsSudahReview');
Route::get('/admin/proposals/listProposalsBelumReview','jayakari\bic\admin\Controllers\ProposalsController@listProposalsBelumReview');
Route::get('/admin/proposals/listProposalsDitolak','jayakari\bic\admin\Controllers\ProposalsController@listProposalsDitolak');
Route::get('/admin/proposals/listProposalsDiterima','jayakari\bic\admin\Controllers\ProposalsController@listProposalsDiterima');
Route::get('/admin/proposals/detailProposal','jayakari\bic\admin\Controllers\ProposalsController@detailProposal');
Route::get('/admin/proposals/detailProposalReviewer','jayakari\bic\admin\Controllers\ProposalsController@detailProposalReviewer');
Route::get('/admin/proposals/detailProposalReviewerDiterima','jayakari\bic\admin\Controllers\ProposalsController@detailProposalReviewerDiterima');
Route::get('/admin/proposals/detailProposalReviewerDitolak','jayakari\bic\admin\Controllers\ProposalsController@detailProposalReviewerDitolak');
Route::get('/admin/proposals/detailProposalReviewerSudahReview','jayakari\bic\admin\Controllers\ProposalsController@detailProposalReviewerSudahReview');
Route::get('/admin/proposals/listProposalsJuri','jayakari\bic\admin\Controllers\ProposalsController@listProposalsJuri');
Route::get('/admin/proposals/listProposalsInovator','jayakari\bic\admin\Controllers\ProposalsController@listProposalsInovator');
Route::get('/admin/proposals/addproposal','jayakari\bic\admin\Controllers\ProposalsController@addproposal');
Route::get('/admin/proposals/editJudulProposal','jayakari\bic\admin\Controllers\ProposalsController@editJudulProposal');
Route::get('/admin/proposals/lengkapiProposal','jayakari\bic\admin\Controllers\ProposalsController@lengkapiProposal');
Route::get('/admin/proposals/lengkapiProposal1','jayakari\bic\admin\Controllers\ProposalsController@lengkapiProposal1');
Route::get('/admin/proposals/detailProposalInovator','jayakari\bic\admin\Controllers\ProposalsController@detailProposalInovator');
Route::get('/admin/proposals/editProposalInovator/{step}','jayakari\bic\admin\Controllers\ProposalsController@editProposalInovator');
Route::get('/admin/proposals/addProposalInovator','jayakari\bic\admin\Controllers\ProposalsController@addProposalInovator');
Route::get('/admin/proposals/reviewProposal','jayakari\bic\admin\Controllers\ProposalsController@reviewProposal');
Route::get('/admin/proposals/listProposalsSudahNilai','jayakari\bic\admin\Controllers\ProposalsController@listProposalsSudahNilai');
Route::get('/admin/proposals/listProposalsBelumNilai','jayakari\bic\admin\Controllers\ProposalsController@listProposalsBelumNilai');
Route::get('/admin/proposals/detailProposalSudahNilai','jayakari\bic\admin\Controllers\ProposalsController@detailProposalSudahNilai');
Route::get('/admin/proposals/detailProposalBelumNilai','jayakari\bic\admin\Controllers\ProposalsController@detailProposalBelumNilai');
Route::get('/admin/proposals/nilaiProposal','jayakari\bic\admin\Controllers\ProposalsController@nilaiProposal');
Route::get('/admin/proposals/tolakProposal','jayakari\bic\admin\Controllers\ProposalsController@tolakProposal');
Route::post('/admin/proposal/cariProposalDownload','jayakari\bic\admin\Controllers\ProposalsController@cariProposalDownload');
Route::get('/admin/proposal/download/{filename}','jayakari\bic\admin\Controllers\ProposalsController@downloadProposal');

/*
 * NEW PROPOSAL
 */
Route::get('/admin/inovator/proposal','jayakari\bic\admin\Controllers\ProposalsController@index');
Route::get('/admin/inovator/proposal/create','jayakari\bic\admin\Controllers\ProposalsController@judul');
Route::post('/admin/inovator/proposal/create','jayakari\bic\admin\Controllers\ProposalsController@saveJudul');
Route::get('/admin/inovator/proposal/{id}/lengkapi','jayakari\bic\admin\Controllers\ProposalsController@lengkapi');
Route::get('/admin/inovator/proposal/{id}/edit','jayakari\bic\admin\Controllers\ProposalsController@edit');
Route::post('/admin/inovator/proposal/{id}/edit','jayakari\bic\admin\Controllers\ProposalsController@updateJudul');
Route::get('/admin/inovator/proposal/{id}/{tab}/edit','jayakari\bic\admin\Controllers\ProposalsController@editProposal');
Route::post('/admin/inovator/proposal/save','jayakari\bic\admin\Controllers\ProposalsController@saveProposal');
Route::post('/admin/inovator/proposal/saveProposalMember','jayakari\bic\admin\Controllers\ProposalsController@saveProposalMember');
Route::post('/admin/inovator/proposal/updateProposalMember','jayakari\bic\admin\Controllers\ProposalsController@updateProposalMember');
Route::post('/admin/inovator/proposal/deleteProposalMember','jayakari\bic\admin\Controllers\ProposalsController@deleteProposalMember');
Route::get('/admin/inovator/proposal/findProposalMemberInstitusi','jayakari\bic\admin\Controllers\ProposalsController@findProposalMemberInstitusi');
Route::post('/admin/inovator/proposal/uploadFile','jayakari\bic\admin\Controllers\ProposalsController@uploadFile');
Route::post('/admin/inovator/proposal/deleteFile','jayakari\bic\admin\Controllers\ProposalsController@deleteProposalFile');
Route::post('/admin/inovator/proposal/batal','jayakari\bic\admin\Controllers\ProposalsController@batal');
Route::get('/admin/inovator/proposal/{id}/detail','jayakari\bic\admin\Controllers\ProposalsController@detail');
Route::post('/admin/inovator/proposal/ubahBatalToNew','jayakari\bic\admin\Controllers\ProposalsController@ubahBatalToNew');
Route::get('/admin/inovator/aktivasi','jayakari\bic\admin\Controllers\InovatorsController@aktivasi');
Route::post('/admin/inovator/aktivasi','jayakari\bic\admin\Controllers\InovatorsController@saveAktivasi');
Route::get('/admin/inovator/deaktivasi','jayakari\bic\admin\Controllers\InovatorsController@deaktivasi');
Route::post('/admin/inovator/deaktivasi','jayakari\bic\admin\Controllers\InovatorsController@saveDeaktivasi');
Route::get('/admin/inovator/message/{id}/askreview','jayakari\bic\admin\Controllers\EmailController@askReview');
Route::post('/admin/inovator/message/saveMessage','jayakari\bic\admin\Controllers\EmailController@saveMessage');
Route::get('/admin/inovator/message/sent','jayakari\bic\admin\Controllers\EmailController@sent');
Route::get('/admin/inovator/message/content/{id}','jayakari\bic\admin\Controllers\EmailController@content');
Route::get('/admin/inovator/message/inbox/{id}','jayakari\bic\admin\Controllers\EmailController@contentinbox');
Route::get('/admin/inovator/message/inbox','jayakari\bic\admin\Controllers\EmailController@inbox');
Route::get('/admin/inovator/profile','jayakari\bic\admin\Controllers\UsersController@profile');
Route::get('/admin/inovator/video','jayakari\bic\admin\Controllers\InovatorsController@video')->name('inovator.video');
Route::post('/admin/inovator/video/create','jayakari\bic\admin\Controllers\InovatorsController@videoSave')->name('inovator.video.save');
Route::post('/admin/inovator/video/update','jayakari\bic\admin\Controllers\InovatorsController@videoUpdate')->name('inovator.video.update');
Route::post('/admin/inovator/video/delete','jayakari\bic\admin\Controllers\InovatorsController@videoDelete')->name('inovator.video.delete');
Route::get('/admin/inovator/video/add','jayakari\bic\admin\Controllers\InovatorsController@videoAdd')->name('inovator.video.add');
Route::get('/admin/inovator/video/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@videoEdit')->name('inovator.video.edit');
Route::get('/admin/inovator/pemenang','jayakari\bic\admin\Controllers\InovatorsController@pemenang')->name('inovator.pemenang');
Route::get('/admin/inovator/pemenang/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@pemenangEdit')->name('inovator.pemenang.edit');
Route::post('/admin/inovator/pemenang/edit','jayakari\bic\admin\Controllers\InovatorsController@pemenangUpdate')->name('inovator.pemenang.update');
Route::get('/admin/inovator/pemenang/file','jayakari\bic\admin\Controllers\InovatorsController@file')->name('inovator.pemenang.file');
Route::get('/admin/inovator/pemenang/file/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileEdit')->name('inovator.pemenang.file.edit');
Route::post('/admin/inovator/pemenang/file/edit','jayakari\bic\admin\Controllers\InovatorsController@fileUpdate')->name('inovator.pemenang.file.update');
Route::post('/admin/inovator/pemenang/file/remove','jayakari\bic\admin\Controllers\InovatorsController@fileRemove')->name('inovator.pemenang.file.remove');
Route::get('/admin/inovator/pemenang/file/download/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileDownload')->name('inovator.pemenang.file.download');
Route::get('/admin/inovator/pemenang/advanced','jayakari\bic\admin\Controllers\InovatorsController@advanced')->name('inovator.pemenang.advanced');
Route::get('/admin/inovator/pemenang/advanced/edit/{id_proposal}/{id}','jayakari\bic\admin\Controllers\InovatorsController@advancedEdit')->name('inovator.pemenang.advanced.edit');
Route::post('/admin/inovator/pemenang/advanced/edit','jayakari\bic\admin\Controllers\InovatorsController@advancedUpdate')->name('inovator.pemenang.advanced.update');
Route::post('/admin/inovator/pemenang/advanced/remove','jayakari\bic\admin\Controllers\InovatorsController@advancedRemove')->name('inovator.pemenang.advanced.remove');

Route::get('/admin/inovator/pemenang/administrasi','jayakari\bic\admin\Controllers\InovatorsController@pemenangAdministrasi')->name('inovator.pemenang.administrasi');
Route::get('/admin/inovator/pemenang/administrasi/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@pemenangAdministrasiEdit')->name('inovator.pemenang.administrasi.edit');
Route::post('/admin/inovator/pemenang/administrasi/edit','jayakari\bic\admin\Controllers\InovatorsController@pemenangAdministrasiUpdate')->name('inovator.pemenang.administrasi.update');
Route::get('/admin/inovator/pemenang/administrasi/file','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasi')->name('inovator.pemenang.administrasi.file');
Route::get('/admin/inovator/pemenang/administrasi/file/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiEdit')->name('inovator.pemenang.administrasi.file.edit');
Route::post('/admin/inovator/pemenang/administrasi/file/edit','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiUpdate')->name('inovator.pemenang.administrasi.file.update');
Route::post('/admin/inovator/pemenang/administrasi/file/remove','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiRemove')->name('inovator.pemenang.administrasi.file.remove');
Route::get('/admin/inovator/pemenang/administrasi/file/download/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiDownload')->name('inovator.pemenang.administrasi.file.download');
Route::get('/admin/inovator/pemenang/administrasi/advanced','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasi')->name('inovator.pemenang.administrasi.advanced');
Route::get('/admin/inovator/pemenang/administrasi/advanced/edit/{id_proposal}/{id}','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiEdit')->name('inovator.pemenang.administrasi.advanced.edit');
Route::post('/admin/inovator/pemenang/administrasi/advanced/edit','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiUpdate')->name('inovator.pemenang.administrasi.advanced.update');
Route::post('/admin/inovator/pemenang/administrasi/advanced/remove','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiRemove')->name('inovator.pemenang.administrasi.advanced.remove');
Route::get('/admin/inovator/pemenang/administrasi/video','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasi')->name('inovator.pemenang.administrasi.video');
Route::get('/admin/inovator/pemenang/administrasi/video/edit/{id_proposal}/{id}','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiEdit')->name('inovator.pemenang.administrasi.video.edit');
Route::post('/admin/inovator/pemenang/administrasi/video/edit','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiUpdate')->name('inovator.pemenang.administrasi.video.update');
Route::post('/admin/inovator/pemenang/administrasi/video/remove','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiRemove')->name('inovator.pemenang.administrasi.video.remove');
Route::get('/admin/inovator/inreview/administrasi/file','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiInreview')->name('inovator.inreview.administrasi.file');
Route::get('/admin/inovator/inreview/administrasi/file/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiInreviewEdit')->name('inovator.inreview.administrasi.file.edit');
Route::post('/admin/inovator/inreview/administrasi/file/edit','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiInreviewUpdate')->name('inovator.inreview.administrasi.file.update');
Route::post('/admin/inovator/inreview/administrasi/file/remove','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiInreviewRemove')->name('inovator.inreview.administrasi.file.remove');
Route::get('/admin/inovator/inreview/administrasi/file/download/{id}','jayakari\bic\admin\Controllers\InovatorsController@fileAdministrasiInreviewDownload')->name('inovator.inreview.administrasi.file.download');
Route::get('/admin/inovator/inreview/administrasi/advanced','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiInreview')->name('inovator.inreview.administrasi.advanced');
Route::get('/admin/inovator/inreview/administrasi/advanced/edit/{id_proposal}/{id}','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiInreviewEdit')->name('inovator.inreview.administrasi.advanced.edit');
Route::post('/admin/inovator/inreview/administrasi/advanced/edit','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiInreviewUpdate')->name('inovator.inreview.administrasi.advanced.update');
Route::post('/admin/inovator/inreview/administrasi/advanced/remove','jayakari\bic\admin\Controllers\InovatorsController@advancedAdministrasiInreviewRemove')->name('inovator.inreview.administrasi.advanced.remove');
Route::get('/admin/inovator/inreview/administrasi/video','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiInreview')->name('inovator.inreview.administrasi.video');
Route::get('/admin/inovator/inreview/administrasi/video/edit/{id_proposal}/{id}','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiInreviewEdit')->name('inovator.inreview.administrasi.video.edit');
Route::post('/admin/inovator/inreview/administrasi/video/edit','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiInreviewUpdate')->name('inovator.inreview.administrasi.video.update');
Route::post('/admin/inovator/inreview/administrasi/video/remove','jayakari\bic\admin\Controllers\InovatorsController@videoAdministrasiInreviewRemove')->name('inovator.inreview.administrasi.video.remove');

Route::get('/admin/inovator/proposal/explanation','jayakari\bic\admin\Controllers\InovatorsController@explanation')->name('inovator.proposal.explanation');
Route::get('/admin/inovator/proposal/type/{name}','jayakari\bic\admin\Controllers\InovatorsController@type')->name('inovator.proposal.type');
Route::get('/admin/inovator/proposal/explanation/manage','jayakari\bic\admin\Controllers\InovatorsController@manage')->name('inovator.proposal.explanation.manage');
Route::get('/admin/inovator/proposal/explanation/manage/add','jayakari\bic\admin\Controllers\InovatorsController@manageAdd')->name('inovator.proposal.explanation.manage.add');
Route::post('/admin/inovator/proposal/explanation/manage/save','jayakari\bic\admin\Controllers\InovatorsController@manageSave')->name('inovator.proposal.explanation.manage.save');
Route::get('/admin/inovator/proposal/explanation/manage/edit/{id}','jayakari\bic\admin\Controllers\InovatorsController@manageEdit')->name('inovator.proposal.explanation.manage.edit');
Route::post('/admin/inovator/proposal/explanation/manage/update','jayakari\bic\admin\Controllers\InovatorsController@manageUpdate')->name('inovator.proposal.explanation.manage.update');
/*
 * End PROPOSAL
 */

/*
 * Penilai
 */
Route::get('/admin/penilai/download','jayakari\bic\admin\Controllers\PenilaiController@download');
Route::get('/admin/penilai/listpenilai','jayakari\bic\admin\Controllers\PenilaiController@listpenilai');
Route::get('/admin/penilai/addpenilai','jayakari\bic\admin\Controllers\PenilaiController@addpenilai');
/*
 * End penilai
 *
 */

/*
 * Reviewer
 */
Route::get('/admin/reviewer/message/inbox','jayakari\bic\admin\Controllers\EmailController@inboxReviewer');
Route::get('/admin/reviewer/message/inbox/{id}','jayakari\bic\admin\Controllers\EmailController@contentReviewer');
Route::get('/admin/reviewer/message/sent','jayakari\bic\admin\Controllers\EmailController@sentReviewer');
Route::get('/admin/reviewer/message/sent/{id}','jayakari\bic\admin\Controllers\EmailController@contentSentReviewer');
Route::get('/admin/reviewer/proposal/{id}/review','jayakari\bic\admin\Controllers\ProposalsController@review');
Route::post('/admin/reviewer/proposal/review','jayakari\bic\admin\Controllers\ProposalsController@saveReview');
Route::post('/admin/reviewer/proposal/cariProposal','jayakari\bic\admin\Controllers\ProposalsController@cariProposal');
Route::get('/admin/reviewer/proposal/masuk','jayakari\bic\admin\Controllers\ProposalsController@masuk');
Route::get('/admin/reviewer/proposal/belumreview','jayakari\bic\admin\Controllers\ProposalsController@belumreview');
Route::get('/admin/reviewer/proposal/sudahreview','jayakari\bic\admin\Controllers\ProposalsController@sudahreview');
Route::get('/admin/reviewer/proposal/revisi','jayakari\bic\admin\Controllers\ProposalsController@revisi');
Route::get('/admin/reviewer/proposal/seleksi','jayakari\bic\admin\Controllers\ProposalsController@seleksi');
Route::get('/admin/reviewer/proposal/disimpan','jayakari\bic\admin\Controllers\ProposalsController@disimpan');
Route::get('/admin/reviewer/proposal/diterima','jayakari\bic\admin\Controllers\ProposalsController@diterima');
Route::get('/admin/reviewer/proposal/ditolak','jayakari\bic\admin\Controllers\ProposalsController@ditolak');
Route::get('/admin/reviewer/proposal/{id}/{tahapan}/masuk','jayakari\bic\admin\Controllers\ProposalsController@detailMasuk');
Route::get('/admin/reviewer/profile','jayakari\bic\admin\Controllers\UsersController@profileReviewer');
Route::get('/admin/reviewer/proposal/{id}/sendEmail','jayakari\bic\admin\Controllers\ReviewersController@sendEmail');
Route::post('/admin/reviewer/proposal/sendEmail','jayakari\bic\admin\Controllers\ReviewersController@saveEmail');
Route::get('/admin/reviewer/proposal/{id}/sendNewEmail','jayakari\bic\admin\Controllers\ReviewersController@sendNewEmail');
Route::post('/admin/reviewer/proposal/sendNewEmail','jayakari\bic\admin\Controllers\ReviewersController@saveNewEmail');
Route::get('/admin/reviewer/proposal/{id}/sendDiscontinued','jayakari\bic\admin\Controllers\ReviewersController@sendDiscontinued');
Route::post('/admin/reviewer/proposal/sendDiscontinued','jayakari\bic\admin\Controllers\ReviewersController@saveDiscontinued');
Route::get('/admin/reviewer/proposal/cari','jayakari\bic\admin\Controllers\ReviewersController@cari');
/*
 * End Reviewer
 *
 */

/*
 * Admin Proses
 */
Route::get('/admin/adminproses/proposal/sudahreview','jayakari\bic\admin\Controllers\ProposalsController@sudahreviewProposal');
Route::get('/admin/adminproses/proposal/seleksi','jayakari\bic\admin\Controllers\ProposalsController@seleksiProposal');
Route::get('/admin/adminproses/proposal/disimpan','jayakari\bic\admin\Controllers\ProposalsController@disimpanProposal');
Route::get('/admin/adminproses/proposal/diterima','jayakari\bic\admin\Controllers\ProposalsController@diterimaProposal');
Route::get('/admin/adminproses/proposal/totalditerima','jayakari\bic\admin\Controllers\ProposalsController@totalDiterimaProposal');
Route::get('/admin/adminproses/proposal/ditolak','jayakari\bic\admin\Controllers\ProposalsController@ditolakProposal');
Route::get('/admin/adminproses/proposal/{id}/juri','jayakari\bic\admin\Controllers\ProposalsController@penjurian');
Route::get('/admin/adminproses/proposal/{id}/pilihjuri','jayakari\bic\admin\Controllers\ProposalsController@pilihJuri');
Route::post('/admin/adminproses/proposal/pilihjuri','jayakari\bic\admin\Controllers\ProposalsController@saveJuri');
Route::post('/admin/adminproses/proposal/deletejuri','jayakari\bic\admin\Controllers\ProposalsController@deleteJuri');
Route::get('/admin/adminproses/message/inbox','jayakari\bic\admin\Controllers\EmailController@inboxProposal');
Route::get('/admin/adminproses/message/inbox/{id}','jayakari\bic\admin\Controllers\EmailController@contentProposal');
//Route::get('/admin/adminproses/juri/','jayakari\bic\admin\Controllers\UsersController@juri');
Route::get('/admin/adminproses/juri/{id}/katakunci','jayakari\bic\admin\Controllers\UsersController@kataKunci');
Route::post('/admin/adminproses/juri/katakunci','jayakari\bic\admin\Controllers\UsersController@saveKataKunci');
Route::get('/admin/adminproses/proposal/{id}/{juriid}/masukanteknis','jayakari\bic\admin\Controllers\AdminProsesController@masukanTeknis');
Route::post('/admin/adminproses/proposal/masukanteknis','jayakari\bic\admin\Controllers\AdminProsesController@saveMasukanTeknis');
Route::get('/admin/adminproses/message/sent','jayakari\bic\admin\Controllers\AdminProsesController@sent');
Route::get('/admin/adminproses/message/content/{id}','jayakari\bic\admin\Controllers\AdminProsesController@content');
Route::get('/admin/adminproses/juri','jayakari\bic\admin\Controllers\AdminProsesController@juri');
Route::get('/admin/adminproses/juri/create','jayakari\bic\admin\Controllers\AdminProsesController@juriCreate');
Route::post('/admin/adminproses/juri/create','jayakari\bic\admin\Controllers\AdminProsesController@juriSave');
Route::get('/admin/adminproses/juri/{id}/edit','jayakari\bic\admin\Controllers\AdminProsesController@juriEdit');
Route::post('/admin/adminproses/juri/{id}/edit','jayakari\bic\admin\Controllers\AdminProsesController@juriUpdate');
Route::get('/admin/adminproses/juri/{id}/delete','jayakari\bic\admin\Controllers\AdminProsesController@juriDelete');
Route::post('/admin/adminproses/juri/{id}/delete','jayakari\bic\admin\Controllers\AdminProsesController@juriDataDelete');
Route::get('/admin/adminproses/juri/penilaian','jayakari\bic\admin\Controllers\AdminProsesController@juriPenilaian');
Route::post('/admin/adminproses/juri/penilaian','jayakari\bic\admin\Controllers\AdminProsesController@showPenilaian');
Route::get('/admin/adminproses/proposal','jayakari\bic\admin\Controllers\AdminProsesController@proposal');
Route::get('/admin/adminproses/proposal/create','jayakari\bic\admin\Controllers\AdminProsesController@proposalCreate');
Route::post('/admin/adminproses/proposal/create','jayakari\bic\admin\Controllers\AdminProsesController@proposalSave');
Route::get('/admin/adminproses/proposal/{id}/edit','jayakari\bic\admin\Controllers\AdminProsesController@proposalEdit');
Route::post('/admin/adminproses/proposal/edit','jayakari\bic\admin\Controllers\AdminProsesController@proposalUpdate');
Route::get('/admin/adminproses/proposal/{id}/delete','jayakari\bic\admin\Controllers\AdminProsesController@proposalDelete');
Route::post('/admin/adminproses/proposal/{id}/delete','jayakari\bic\admin\Controllers\AdminProsesController@proposalDataDelete');
Route::post('/admin/adminproses/findTopik','jayakari\bic\admin\Controllers\AdminProsesController@findTopik');
Route::post('/admin/adminproses/findProposal','jayakari\bic\admin\Controllers\AdminProsesController@findProposal');
Route::post('/admin/adminproses/proposal/show','jayakari\bic\admin\Controllers\AdminProsesController@proposalShow');
Route::get('/admin/adminproses/profile','jayakari\bic\admin\Controllers\UsersController@profileAdminProses');
Route::get('/admin/adminproses/proposal/pemenang','jayakari\bic\admin\Controllers\AdminProsesController@proposalPemenang');
Route::post('/admin/adminproses/proposal/update','jayakari\bic\admin\Controllers\AdminProsesController@updateProposal');
Route::post('/admin/adminproses/proposal/detail','jayakari\bic\admin\Controllers\AdminProsesController@detailProposal');
Route::get('/admin/adminproses/proposal/{id}/ubah','jayakari\bic\admin\Controllers\AdminProsesController@ubahProposal');
Route::get('/admin/adminproses/proposal/{id}/terima','jayakari\bic\admin\Controllers\AdminProsesController@terimaProposal');
Route::get('/admin/adminproses/proposal/expert/review','jayakari\bic\admin\Controllers\AdminProsesController@expert');
Route::get('/admin/adminproses/proposal/{id}/review','jayakari\bic\admin\Controllers\AdminProsesController@review');
Route::post('/admin/adminproses/proposal/review','jayakari\bic\admin\Controllers\AdminProsesController@saveReview');
Route::get('/admin/adminproses/proposal/cari','jayakari\bic\admin\Controllers\AdminProsesController@cari');

/*
 * End Admin Proses
 */

/*
* Juri
*/
Route::get('/admin/juri/proposal/belumnilai','jayakari\bic\admin\Controllers\JuriController@belumnilai');
Route::get('/admin/juri/proposal/sudahnilai','jayakari\bic\admin\Controllers\JuriController@sudahnilai');
Route::get('/admin/juri/proposal/review','jayakari\bic\admin\Controllers\JuriController@review');
Route::get('/admin/juri/historynilai','jayakari\bic\admin\Controllers\JuriController@historynilai');
Route::get('/admin/juri/activenilai','jayakari\bic\admin\Controllers\JuriController@activenilai');
Route::get('/admin/juri/{id}/topiknilai','jayakari\bic\admin\Controllers\JuriController@topiknilai');
Route::get('/admin/juri/proposal/{id}/nilai','jayakari\bic\admin\Controllers\JuriController@nilai');
Route::post('/admin/juri/proposal/{id}/nilai','jayakari\bic\admin\Controllers\JuriController@saveNilai');
Route::get('/admin/juri/proposal/{id}/revisinilai','jayakari\bic\admin\Controllers\JuriController@revisinilai');
Route::post('/admin/juri/proposal/{id}/revisinilai','jayakari\bic\admin\Controllers\JuriController@updateNilai');
Route::get('/admin/juri/proposal/{id}/lihatnilai','jayakari\bic\admin\Controllers\JuriController@lihatNilai');
Route::get('/admin/juri/teknis/belumrespon','jayakari\bic\admin\Controllers\JuriController@belumrespon');
Route::get('/admin/juri/teknis/sudahrespon','jayakari\bic\admin\Controllers\JuriController@sudahrespon');
Route::get('/admin/juri/teknis/{id}/respon','jayakari\bic\admin\Controllers\JuriController@respon');
Route::post('/admin/juri/teknis/{id}/respon','jayakari\bic\admin\Controllers\JuriController@saveRespon');
Route::get('/admin/juri/profile','jayakari\bic\admin\Controllers\UsersController@profileJuri');

/*
 * End Administrasi
 */

Route::get('/admin/administrasi/profile','jayakari\bic\admin\Controllers\UsersController@profile');
Route::get('/admin/berita','jayakari\bic\admin\Controllers\NewsController@index')->name('admin.news');
Route::get('/admin/berita/create','jayakari\bic\admin\Controllers\NewsController@add');
Route::post('/admin/berita/create','jayakari\bic\admin\Controllers\NewsController@store');
Route::get('/admin/berita/{id}/edit','jayakari\bic\admin\Controllers\NewsController@edit');
Route::post('/admin/berita/{id}/edit','jayakari\bic\admin\Controllers\NewsController@update');
Route::get('/admin/berita/{id}/delete','jayakari\bic\admin\Controllers\NewsController@delete');
Route::post('/admin/berita/{id}/delete','jayakari\bic\admin\Controllers\NewsController@deleteData');

/*
 * End Administrasi
 */

/*
 * Berita
 */

Route::get('/admin/berita','jayakari\bic\admin\Controllers\NewsController@index')->name('admin.news');
Route::get('/admin/berita/create','jayakari\bic\admin\Controllers\NewsController@add');
Route::post('/admin/berita/create','jayakari\bic\admin\Controllers\NewsController@store');
Route::get('/admin/berita/{id}/edit','jayakari\bic\admin\Controllers\NewsController@edit');
Route::post('/admin/berita/edit','jayakari\bic\admin\Controllers\NewsController@update');
Route::get('/admin/berita/{id}/delete','jayakari\bic\admin\Controllers\NewsController@delete');
Route::post('/admin/berita/{id}/delete','jayakari\bic\admin\Controllers\NewsController@deleteData');
Route::get('/admin/berita/{id}/gambar','jayakari\bic\admin\Controllers\NewsController@gambar');
Route::post('/admin/berita/gambar','jayakari\bic\admin\Controllers\NewsController@saveGambar');
Route::get('/admin/berita/{id}/file','jayakari\bic\admin\Controllers\NewsController@file');
Route::post('/admin/berita/file','jayakari\bic\admin\Controllers\NewsController@saveFile');
Route::post('/admin/berita/removeFile','jayakari\bic\admin\Controllers\NewsController@removeFile');
Route::post('/admin/berita/removeAttachment','jayakari\bic\admin\Controllers\NewsController@removeAttachment');

/*
 * End Berita
 */

/*
 * Banner
 */

Route::get('/admin/banner','jayakari\bic\admin\Controllers\BannerController@index');
Route::post('/admin/banner/gambar','jayakari\bic\admin\Controllers\BannerController@saveGambar');
Route::post('/admin/banner/removeFile','jayakari\bic\admin\Controllers\BannerController@removeFile');
Route::get('/admin/banner/{id}/edit','jayakari\bic\admin\Controllers\BannerController@edit');
Route::post('/admin/banner/edit','jayakari\bic\admin\Controllers\BannerController@update');

/*
 * End Banner
 */


/*
 * Email
 */

Route::get('/admin/email/listemails','jayakari\bic\admin\Controllers\EmailController@listemails');
Route::get('/admin/email/isiEmail','jayakari\bic\admin\Controllers\EmailController@isiEmail');
Route::get('/admin/email/isiEmailReviewer','jayakari\bic\admin\Controllers\EmailController@isiEmailReviewer');
Route::get('/admin/email/isiSentEmailReviewer','jayakari\bic\admin\Controllers\EmailController@isiSentEmailReviewer');
Route::get('/admin/email/listemailsInovator','jayakari\bic\admin\Controllers\EmailController@listemailsInovator');
Route::get('/admin/email/listSentEmailsInovator','jayakari\bic\admin\Controllers\EmailController@listSentEmailsInovator');
Route::get('/admin/email/newemail','jayakari\bic\admin\Controllers\EmailController@newemail');
Route::get('/admin/email/newemailInovator','jayakari\bic\admin\Controllers\EmailController@newemailInovator');
Route::get('/admin/email/kirimEmailDiterima','jayakari\bic\admin\Controllers\EmailController@kirimEmailDiterima');
Route::get('/admin/email/kirimEmailDitolak','jayakari\bic\admin\Controllers\EmailController@kirimEmailDitolak');
Route::get('/admin/email/newemailReviewer','jayakari\bic\admin\Controllers\EmailController@newemailReviewer');
Route::get('/admin/email/listEmailsReviewer','jayakari\bic\admin\Controllers\EmailController@listEmailsReviewer');
Route::get('/admin/email/listSentEmailsReviewer','jayakari\bic\admin\Controllers\EmailController@listSentEmailsReviewer');
/*
 * End Email
 */

/*
 * Events
 */
Route::get('/admin/events/listevents','jayakari\bic\admin\Controllers\EventsController@listevents');
Route::get('/admin/events/addevent','jayakari\bic\admin\Controllers\EventsController@addevent');
Route::get('/admin/events/editEvent','jayakari\bic\admin\Controllers\EventsController@editEvent');
Route::get('/admin/events/deleteEvent','jayakari\bic\admin\Controllers\EventsController@deleteEvent');
Route::get('/admin/events/findEvent','jayakari\bic\admin\Controllers\EventsController@findEvent');
Route::get('/admin/events/eventImage','jayakari\bic\admin\Controllers\EventsController@eventImage');
Route::get('/admin/events/selectedEventImage','jayakari\bic\admin\Controllers\EventsController@selectedEventImage');
/*
 * End Of Events
 */

/*
 * ARN
 */
Route::get('/admin/arn','jayakari\bic\admin\Controllers\ARNController@index');
Route::get('/admin/arn/create','jayakari\bic\admin\Controllers\ARNController@add');
Route::post('/admin/arn/create','jayakari\bic\admin\Controllers\ARNController@store');
Route::get('/admin/arn/{id}/edit','jayakari\bic\admin\Controllers\ARNController@edit');
Route::post('/admin/arn/{id}/edit','jayakari\bic\admin\Controllers\ARNController@update');
Route::get('/admin/arn/{id}/delete','jayakari\bic\admin\Controllers\ARNController@delete');
Route::post('/admin/arn/{id}/delete','jayakari\bic\admin\Controllers\ARNController@deleteData');
/*
 * End Of ARN
 */

/*
 * Employee
 */
Route::get('/admin/employee','jayakari\bic\admin\Controllers\EmployeeController@index');
Route::get('/admin/employee/create','jayakari\bic\admin\Controllers\EmployeeController@add');
Route::post('/admin/employee/create','jayakari\bic\admin\Controllers\EmployeeController@store');
Route::get('/admin/employee/{id}/edit','jayakari\bic\admin\Controllers\EmployeeController@edit');
Route::post('/admin/employee/{id}/edit','jayakari\bic\admin\Controllers\EmployeeController@update');
Route::get('/admin/employee/{id}/delete','jayakari\bic\admin\Controllers\EmployeeController@delete');
Route::post('/admin/employee/{id}/delete','jayakari\bic\admin\Controllers\EmployeeController@deleteData');
/*
 * End Of Employee
 */

/*
 * Instansi
 */
Route::get('/admin/instansi','jayakari\bic\admin\Controllers\InstansiController@index');
Route::get('/admin/instansi/create','jayakari\bic\admin\Controllers\InstansiController@add');
Route::post('/admin/instansi/create','jayakari\bic\admin\Controllers\InstansiController@store');
Route::get('/admin/instansi/{id}/edit','jayakari\bic\admin\Controllers\InstansiController@edit');
Route::post('/admin/instansi/{id}/edit','jayakari\bic\admin\Controllers\InstansiController@update');
Route::get('/admin/instansi/{id}/delete','jayakari\bic\admin\Controllers\InstansiController@delete');
Route::post('/admin/instansi/{id}/delete','jayakari\bic\admin\Controllers\InstansiController@deleteData');
/*
 * End Of Instansi
 */

/*
 * IPR
 */
Route::get('/admin/ipr','jayakari\bic\admin\Controllers\IPRController@index');
Route::get('/admin/ipr/create','jayakari\bic\admin\Controllers\IPRController@add');
Route::post('/admin/ipr/create','jayakari\bic\admin\Controllers\IPRController@store');
Route::get('/admin/ipr/{id}/edit','jayakari\bic\admin\Controllers\IPRController@edit');
Route::post('/admin/ipr/{id}/edit','jayakari\bic\admin\Controllers\IPRController@update');
Route::get('/admin/ipr/{id}/delete','jayakari\bic\admin\Controllers\IPRController@delete');
Route::post('/admin/ipr/{id}/delete','jayakari\bic\admin\Controllers\IPRController@deleteData');
/*
 * End Of IPR
 */

/*
 * RSC
 */
Route::get('/admin/rsc','jayakari\bic\admin\Controllers\RSCController@index');
Route::get('/admin/rsc/create','jayakari\bic\admin\Controllers\RSCController@add');
Route::post('/admin/rsc/create','jayakari\bic\admin\Controllers\RSCController@store');
Route::get('/admin/rsc/{id}/edit','jayakari\bic\admin\Controllers\RSCController@edit');
Route::post('/admin/rsc/{id}/edit','jayakari\bic\admin\Controllers\RSCController@update');
Route::get('/admin/rsc/{id}/delete','jayakari\bic\admin\Controllers\RSCController@delete');
Route::post('/admin/rsc/{id}/delete','jayakari\bic\admin\Controllers\RSCController@deleteData');
/*
 * End Of RSC
 */

/*
 * Status Proposal
 */
Route::get('/admin/statusproposal','jayakari\bic\admin\Controllers\StatusProposalController@index');
Route::get('/admin/statusproposal/create','jayakari\bic\admin\Controllers\StatusProposalController@add');
Route::post('/admin/statusproposal/create','jayakari\bic\admin\Controllers\StatusProposalController@store');
Route::get('/admin/statusproposal/{id}/edit','jayakari\bic\admin\Controllers\StatusProposalController@edit');
Route::post('/admin/statusproposal/{id}/edit','jayakari\bic\admin\Controllers\StatusProposalController@update');
Route::get('/admin/statusproposal/{id}/delete','jayakari\bic\admin\Controllers\StatusProposalController@delete');
Route::post('/admin/statusproposal/{id}/delete','jayakari\bic\admin\Controllers\StatusProposalController@deleteData');
/*
 * End Of Status Proposal
 */

/*
 * Kata Kunci Teknologi
 */
Route::get('/admin/katakunci','jayakari\bic\admin\Controllers\KataKunciTeknologiController@index');
Route::get('/admin/katakunci/create','jayakari\bic\admin\Controllers\KataKunciTeknologiController@add');
Route::post('/admin/katakunci/create','jayakari\bic\admin\Controllers\KataKunciTeknologiController@store');
Route::get('/admin/katakunci/{id}/edit','jayakari\bic\admin\Controllers\KataKunciTeknologiController@edit');
Route::post('/admin/katakunci/{id}/edit','jayakari\bic\admin\Controllers\KataKunciTeknologiController@update');
Route::get('/admin/katakunci/{id}/delete','jayakari\bic\admin\Controllers\KataKunciTeknologiController@delete');
Route::post('/admin/katakunci/{id}/delete','jayakari\bic\admin\Controllers\KataKunciTeknologiController@deleteData');
Route::post('/admin/katakunci/findKataKunci','jayakari\bic\admin\Controllers\KataKunciTeknologiController@findKataKunci');
/*
 * End Of Kata Kunci Teknologi
 */

/*
* Status Kata Development
*/
Route::get('/admin/development','jayakari\bic\admin\Controllers\DevelopmentController@index');
Route::get('/admin/development/create','jayakari\bic\admin\Controllers\DevelopmentController@add');
Route::post('/admin/development/create','jayakari\bic\admin\Controllers\DevelopmentController@store');
Route::get('/admin/development/{id}/edit','jayakari\bic\admin\Controllers\DevelopmentController@edit');
Route::post('/admin/development/{id}/edit','jayakari\bic\admin\Controllers\DevelopmentController@update');
Route::get('/admin/development/{id}/delete','jayakari\bic\admin\Controllers\DevelopmentController@delete');
Route::post('/admin/development/{id}/delete','jayakari\bic\admin\Controllers\DevelopmentController@deleteData');
/*
 * End Of Development
 */

/*
* Status Kata Tipe Teknologi
*/
Route::get('/admin/tipeteknologi','jayakari\bic\admin\Controllers\TipeTeknologiController@index');
Route::get('/admin/tipeteknologi/create','jayakari\bic\admin\Controllers\TipeTeknologiController@add');
Route::post('/admin/tipeteknologi/create','jayakari\bic\admin\Controllers\TipeTeknologiController@store');
Route::get('/admin/tipeteknologi/{id}/edit','jayakari\bic\admin\Controllers\TipeTeknologiController@edit');
Route::post('/admin/tipeteknologi/{id}/edit','jayakari\bic\admin\Controllers\TipeTeknologiController@update');
Route::get('/admin/tipeteknologi/{id}/delete','jayakari\bic\admin\Controllers\TipeTeknologiController@delete');
Route::post('/admin/tipeteknologi/{id}/delete','jayakari\bic\admin\Controllers\TipeTeknologiController@deleteData');
/*
 * End Of Tipe Teknologi
 */

/*
* Status Kategori Dictionary
*/
Route::get('/admin/kategoridictionary','jayakari\bic\admin\Controllers\KategoriDictionaryController@index');
Route::get('/admin/kategoridictionary/create','jayakari\bic\admin\Controllers\KategoriDictionaryController@add');
Route::post('/admin/kategoridictionary/create','jayakari\bic\admin\Controllers\KategoriDictionaryController@store');
Route::get('/admin/kategoridictionary/{id}/edit','jayakari\bic\admin\Controllers\KategoriDictionaryController@edit');
Route::post('/admin/kategoridictionary/{id}/edit','jayakari\bic\admin\Controllers\KategoriDictionaryController@update');
Route::get('/admin/kategoridictionary/{id}/delete','jayakari\bic\admin\Controllers\KategoriDictionaryController@delete');
Route::post('/admin/kategoridictionary/{id}/delete','jayakari\bic\admin\Controllers\KategoriDictionaryController@deleteData');
/*
 * End Of Tipe Teknologi
 */

/*
* Status Dictionary
*/
Route::get('/admin/dictionary','jayakari\bic\admin\Controllers\DictionaryController@index');
Route::get('/admin/dictionary/create','jayakari\bic\admin\Controllers\DictionaryController@add');
Route::post('/admin/dictionary/create','jayakari\bic\admin\Controllers\DictionaryController@store');
Route::post('/admin/dictionary/uploadFile','jayakari\bic\admin\Controllers\DictionaryController@uploadFile');
Route::get('/admin/dictionary/{id}/edit','jayakari\bic\admin\Controllers\DictionaryController@edit');
Route::post('/admin/dictionary/{id}/edit','jayakari\bic\admin\Controllers\DictionaryController@update');
Route::get('/admin/dictionary/{id}/delete','jayakari\bic\admin\Controllers\DictionaryController@delete');
Route::post('/admin/dictionary/{id}/delete','jayakari\bic\admin\Controllers\DictionaryController@deleteData');
Route::get('/admin/dictionary/{id}/download','jayakari\bic\admin\Controllers\DictionaryController@download');
/*
 * End Of Tipe Teknologi
 */

/*
* Batch
*/
Route::get('/admin/batch','jayakari\bic\admin\Controllers\BatchController@index');
Route::get('/admin/batch/status','jayakari\bic\admin\Controllers\BatchController@status');
Route::get('/admin/batch/status/{id}/edit','jayakari\bic\admin\Controllers\BatchController@editStatus');
Route::post('/admin/batch/status/{id}/edit','jayakari\bic\admin\Controllers\BatchController@updateStatus');
Route::get('/admin/batch/create','jayakari\bic\admin\Controllers\BatchController@add');
Route::post('/admin/batch/create','jayakari\bic\admin\Controllers\BatchController@store');
Route::get('/admin/batch/{id}/edit','jayakari\bic\admin\Controllers\BatchController@edit');
Route::post('/admin/batch/{id}/edit','jayakari\bic\admin\Controllers\BatchController@update');
Route::get('/admin/batch/{id}/delete','jayakari\bic\admin\Controllers\BatchController@delete');
Route::post('/admin/batch/{id}/delete','jayakari\bic\admin\Controllers\BatchController@deleteData');
/*
 * End Of Batch
 */

/*
* Topik
*/
Route::get('/admin/topik','jayakari\bic\admin\Controllers\TopikController@index');
Route::get('/admin/topik/create','jayakari\bic\admin\Controllers\TopikController@add');
Route::post('/admin/topik/create','jayakari\bic\admin\Controllers\TopikController@store');
Route::get('/admin/topik/{id}/edit','jayakari\bic\admin\Controllers\TopikController@edit');
Route::post('/admin/topik/{id}/edit','jayakari\bic\admin\Controllers\TopikController@update');
Route::get('/admin/topik/{id}/delete','jayakari\bic\admin\Controllers\TopikController@delete');
Route::post('/admin/topik/{id}/delete','jayakari\bic\admin\Controllers\TopikController@deleteData');
/*
 * End Of Topik
 */

/*
* Technical Reviewer
*/
Route::get('/admin/technical/belumrespon','jayakari\bic\admin\Controllers\TechnicalReviewerController@belumrespon');
Route::get('/admin/technical/sudahrespon','jayakari\bic\admin\Controllers\TechnicalReviewerController@sudahrespon');
Route::get('/admin/technical/{id}/jawaban','jayakari\bic\admin\Controllers\TechnicalReviewerController@jawaban');
Route::post('/admin/technical/jawaban','jayakari\bic\admin\Controllers\TechnicalReviewerController@saveJawaban');
Route::get('/admin/technical/profile','jayakari\bic\admin\Controllers\UsersController@profileTechnicalReviewer');
/*
 * End Of Technical Reviewer
 */

/*
* Testimonial
*/
Route::get('/admin/testimonial','jayakari\bic\admin\Controllers\TestimonialController@index');
Route::get('/admin/testimonial/create','jayakari\bic\admin\Controllers\TestimonialController@add');
Route::post('/admin/testimonial/create','jayakari\bic\admin\Controllers\TestimonialController@store');
Route::get('/admin/testimonial/{id}/edit','jayakari\bic\admin\Controllers\TestimonialController@edit');
Route::post('/admin/testimonial/edit','jayakari\bic\admin\Controllers\TestimonialController@update');
/*
 * End Of Testimonial
 */

/*
* Videos
*/
Route::get('/admin/videos','jayakari\bic\admin\Controllers\VideosController@index');
Route::get('/admin/videos/create','jayakari\bic\admin\Controllers\VideosController@add');
Route::post('/admin/videos/create','jayakari\bic\admin\Controllers\VideosController@store');
Route::get('/admin/videos/{id}/edit','jayakari\bic\admin\Controllers\VideosController@edit');
Route::post('/admin/videos/edit','jayakari\bic\admin\Controllers\VideosController@update');
Route::get('/admin/videos/{id}/delete','jayakari\bic\admin\Controllers\VideosController@delete');
Route::post('/admin/videos/{id}/delete','jayakari\bic\admin\Controllers\VideosController@deleteData');
Route::get('/videos/view','jayakari\bic\admin\Controllers\VideosController@view');
/*
 * End Of Videos
 */

/*
* Buku
*/
Route::get('/admin/buku','jayakari\bic\admin\Controllers\BukuController@index');
Route::get('/admin/buku/create','jayakari\bic\admin\Controllers\BukuController@add');
Route::post('/admin/buku/create','jayakari\bic\admin\Controllers\BukuController@store');
Route::get('/admin/buku/{id}/edit','jayakari\bic\admin\Controllers\BukuController@edit');
Route::post('/admin/buku/{id}/edit','jayakari\bic\admin\Controllers\BukuController@update');
Route::get('/admin/buku/{id}/delete','jayakari\bic\admin\Controllers\BukuController@delete');
Route::post('/admin/buku/{id}/delete','jayakari\bic\admin\Controllers\BukuController@deleteData');
Route::get('/admin/buku/{id}/isi','jayakari\bic\admin\Controllers\BukuController@isi')->name('admin.buku.isi');
Route::get('/admin/buku/{id_buku}/{id_proposal}/buatisibuku','jayakari\bic\admin\Controllers\BukuController@buatIsiBuku')->name('admin.buku.buatisibuku');
Route::post('/admin/buku/buatisibuku','jayakari\bic\admin\Controllers\BukuController@saveIsiBuku')->name('admin.buku.saveisibuku');
Route::get('/admin/buku/{id_isi_buku}/editisibuku','jayakari\bic\admin\Controllers\BukuController@editIsiBuku')->name('admin.buku.editisibuku');
Route::post('/admin/buku/editisibuku','jayakari\bic\admin\Controllers\BukuController@updateIsiBuku')->name('admin.buku.updateisibuku');
Route::get('/admin/buku/{id}/file','jayakari\bic\admin\Controllers\BukuController@file')->name('admin.buku.file');
Route::get('/admin/buku/{id}/download','jayakari\bic\admin\Controllers\BukuController@download')->name('admin.buku.download');
Route::post('/admin/buku/file','jayakari\bic\admin\Controllers\BukuController@saveFile')->name('admin.buku.savefile');
Route::post('/admin/buku/deleteFile','jayakari\bic\admin\Controllers\BukuController@deleteFile')->name('admin.buku.deletefile');
Route::get('/admin/buku/{id}/video','jayakari\bic\admin\Controllers\BukuController@video')->name('admin.buku.video');
Route::post('/admin/buku/video','jayakari\bic\admin\Controllers\BukuController@saveVideo')->name('admin.buku.savevideo');
Route::get('/admin/buku/listbatch','jayakari\bic\admin\Controllers\BukuController@listBatch');
Route::get('/admin/buku/{id}/daftarpemenang','jayakari\bic\admin\Controllers\BukuController@daftarPemenang');
Route::get('/admin/blast/daftarinovator','jayakari\bic\admin\Controllers\BukuController@daftarInovator')->name('admin.blast.daftar.inovator');
Route::post('/admin/blast/daftarinovator/download','jayakari\bic\admin\Controllers\BukuController@daftarInovatorDownload')->name('admin.blast.daftar.inovator.download');
Route::get('/admin/blast/daftarinovator/edit/{type}/{id}','jayakari\bic\admin\Controllers\BukuController@daftarInovatorEdit')->name('admin.blast.daftar.inovator.edit');
Route::post('/admin/blast/daftarinovator/update','jayakari\bic\admin\Controllers\BukuController@daftarInovatorUpdate')->name('admin.blast.daftar.inovator.update');
Route::get('/admin/buku/{id}/draft','jayakari\bic\admin\Controllers\BukuController@draft');
Route::get('/admin/buku/inreview','jayakari\bic\admin\Controllers\BukuController@inreview')->name('admin.buku.inreview');
Route::get('/admin/buku/inreview/{id}/isi','jayakari\bic\admin\Controllers\BukuController@isireview')->name('admin.buku.inreview.isi');
Route::get('/admin/buku/inreview/{id}/cover','jayakari\bic\admin\Controllers\BukuController@coverinreview')->name('admin.buku.inreview.cover');
Route::post('/admin/buku/inreview/cover/save','jayakari\bic\admin\Controllers\BukuController@savecoverinreview')->name('admin.buku.inreview.cover.save');
Route::get('/admin/buku/inreview/{id}/folder','jayakari\bic\admin\Controllers\BukuController@folderinreview')->name('admin.buku.inreview.folder');
Route::post('/admin/buku/inreview/folder/save','jayakari\bic\admin\Controllers\BukuController@savefolderinreview')->name('admin.buku.inreview.folder.save');
Route::get('/admin/buku/final/{id}/cover','jayakari\bic\admin\Controllers\BukuController@coverfinal')->name('admin.buku.final.cover');
Route::post('/admin/buku/final/cover/save','jayakari\bic\admin\Controllers\BukuController@savecoverfinal')->name('admin.buku.final.cover.save');
Route::get('/admin/buku/final/{id}/folder','jayakari\bic\admin\Controllers\BukuController@folderfinal')->name('admin.buku.final.folder');
Route::post('/admin/buku/final/folder/save','jayakari\bic\admin\Controllers\BukuController@savefolderfinal')->name('admin.buku.final.folder.save');
Route::get('/admin/buku/final/{id}/book','jayakari\bic\admin\Controllers\BukuController@bookfinal')->name('admin.buku.final.book');
Route::post('/admin/buku/final/book/save','jayakari\bic\admin\Controllers\BukuController@savebookfinal')->name('admin.buku.final.book.save');
Route::get('/admin/buku/inreview/create','jayakari\bic\admin\Controllers\BukuController@addinreview')->name('admin.buku.inreview.create');
Route::post('/admin/buku/inreview/store','jayakari\bic\admin\Controllers\BukuController@store')->name('admin.buku.inreview.store');
Route::get('/admin/buku/inreview/{id}/edit','jayakari\bic\admin\Controllers\BukuController@editinreview')->name('admin.buku.inreview.edit');
Route::post('/admin/buku/inreview/edit','jayakari\bic\admin\Controllers\BukuController@update')->name('admin.buku.inreview.update');
Route::get('/admin/buku/inreview/{id_buku}/{id_proposal}/buatisibuku','jayakari\bic\admin\Controllers\BukuController@buatIsiBukuInReview')->name('admin.buku.inreview.buatisibuku');
Route::post('/admin/buku/inreview/buatisibuku','jayakari\bic\admin\Controllers\BukuController@saveIsiBuku')->name('admin.buku.inreview.saveisibuku');
Route::get('/admin/buku/inreview/{id_isi_buku}/editisibukuinreview','jayakari\bic\admin\Controllers\BukuController@editIsiBukuInReview')->name('admin.buku.inreview.editisibuku');
Route::post('/admin/buku/inreview/editisibuku','jayakari\bic\admin\Controllers\BukuController@updateIsiBuku')->name('admin.buku.inreview.updateisibuku');
Route::get('/admin/buku/inreview/{id}/file','jayakari\bic\admin\Controllers\BukuController@fileinreview')->name('admin.buku.inreview.file');
Route::get('/admin/buku/inreview/{id}/download','jayakari\bic\admin\Controllers\BukuController@download')->name('admin.buku.inreview.download');
Route::post('/admin/buku/inreview/file','jayakari\bic\admin\Controllers\BukuController@saveFile')->name('admin.buku.inreview.savefile');
Route::post('/admin/buku/inreview/deleteFile','jayakari\bic\admin\Controllers\BukuController@deleteFile')->name('admin.buku.inreview.deletefile');
Route::get('/admin/buku/inreview/{id}/video','jayakari\bic\admin\Controllers\BukuController@videoinreview')->name('admin.buku.inreview.video');
Route::post('/admin/buku/inreview/video','jayakari\bic\admin\Controllers\BukuController@saveVideo')->name('admin.buku.inreview.savevideo');
Route::post('/admin/buku/inreview/deleteVideo','jayakari\bic\admin\Controllers\BukuController@deleteVideo')->name('admin.buku.inreview.deletevideo');
Route::get('/admin/system','jayakari\bic\admin\Controllers\AdminController@index')->name('admin.system');
Route::post('/admin/system/find','jayakari\bic\admin\Controllers\AdminController@find')->name('admin.system.find');
Route::post('/admin/system/delete','jayakari\bic\admin\Controllers\AdminController@delete')->name('admin.system.delete');
Route::get('/admin/buku/inreview/page','jayakari\bic\admin\Controllers\BukuController@pageinreview')->name('admin.buku.inreview.page');
Route::get('/admin/buku/inreview/page/edit/{id}','jayakari\bic\admin\Controllers\BukuController@pageInreviewEdit')->name('admin.buku.inreview.page.edit');
Route::post('/admin/buku/inreview/page/update','jayakari\bic\admin\Controllers\BukuController@pageInreviewUpdate')->name('admin.buku.inreview.page.update');

Route::get('/admin/blog','jayakari\bic\admin\Controllers\BlogController@index')->name('admin.blog');
/*
 * End Of Buku
 */

/*
* Inovasi Unggulan
*/
Route::get('/admin/inovasi/unggulan','jayakari\bic\admin\Controllers\InovasiUnggulanController@index');
Route::get('/admin/inovasi/unggulan/create','jayakari\bic\admin\Controllers\InovasiUnggulanController@add');
Route::post('/admin/inovasi/unggulan/create','jayakari\bic\admin\Controllers\InovasiUnggulanController@store');
Route::get('/admin/inovasi/unggulan/{id}/edit','jayakari\bic\admin\Controllers\InovasiUnggulanController@edit');
Route::post('/admin/inovasi/unggulan/edit','jayakari\bic\admin\Controllers\InovasiUnggulanController@update');
Route::get('/admin/inovasi/unggulan/{id}/delete','jayakari\bic\admin\Controllers\InovasiUnggulanController@delete');
Route::post('/admin/inovasi/unggulan/{id}/delete','jayakari\bic\admin\Controllers\InovasiUnggulanController@deleteData');
Route::get('/admin/inovasi/unggulan/{id}/isi','jayakari\bic\admin\Controllers\InovasiUnggulanController@isi');
Route::post('/admin/inovasi/unggulan/cari','jayakari\bic\admin\Controllers\InovasiUnggulanController@cari');
Route::post('/admin/inovasi/unggulan/simpan','jayakari\bic\admin\Controllers\InovasiUnggulanController@simpan');
/*
 * End Of Inovasi Unggulan
 */

/*
 * FAQ
 */
Route::get('/admin/faq','jayakari\bic\admin\Controllers\FAQController@index')->name('admin.faq');
Route::get('/admin/faq/create','jayakari\bic\admin\Controllers\FAQController@add')->name('admin.faq.add');
Route::post('/admin/faq/create','jayakari\bic\admin\Controllers\FAQController@store')->name('admin.faq.store');
Route::get('/admin/faq/{id}/edit','jayakari\bic\admin\Controllers\FAQController@edit')->name('admin.faq.edit');
Route::post('/admin/faq/edit','jayakari\bic\admin\Controllers\FAQController@update')->name('admin.faq.update');
Route::post('/admin/faq/delete','jayakari\bic\admin\Controllers\FAQController@delete')->name('admin.faq.delete');

/*
 * News
 */
Route::get('/admin/blog','jayakari\bic\admin\Controllers\BlogController@index')->name('admin.blog');
Route::get('/admin/blog/create','jayakari\bic\admin\Controllers\BlogController@add')->name('admin.blog.add');
Route::post('/admin/blog/create','jayakari\bic\admin\Controllers\BlogController@store')->name('admin.blog.store');
Route::get('/admin/blog/{id}/edit','jayakari\bic\admin\Controllers\BlogController@edit')->name('admin.blog.edit');
Route::post('/admin/blog/edit','jayakari\bic\admin\Controllers\BlogController@update')->name('admin.blog.update');
Route::post('/admin/blog/delete','jayakari\bic\admin\Controllers\BlogController@delete')->name('admin.blog.delete');
Route::get('/admin/news/findnews','jayakari\bic\admin\Controllers\NewsController@findnews');
Route::get('/admin/blog/{id}/gambar','jayakari\bic\admin\Controllers\BlogController@gambar');
Route::post('/admin/blog/gambar','jayakari\bic\admin\Controllers\BlogController@saveGambar');
Route::post('/admin/blog/removeFile','jayakari\bic\admin\Controllers\BlogController@removeFile');
Route::get('/admin/blog/detail/{id}','jayakari\bic\admin\Controllers\BlogController@detail')->name('admin.blog.detail');
Route::post('/admin/news/deaktivasi','jayakari\bic\admin\Controllers\NewsController@deaktivasi')->name('admin.news.deaktivasi');
Route::post('/admin/news/delete','jayakari\bic\admin\Controllers\NewsController@delete')->name('admin.news.delete');
/*
 * End News
 */
/*
 * End of FAQ
 */

/*
 * Untuk kepentingan registrasi Inovator
 */
Route::post('/general/registrasi','jayakari\bic\admin\Controllers\UsersController@registrasi');
