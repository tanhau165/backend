<?php
Route::group([
    'middleware' => 'api',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
    Route::post('changepass', 'AuthController@changepass');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::post('refresh', 'AuthController@refresh');

    Route::group(['prefix' => 'admin'], function () {

        // Teams
        Route::post('team/add', 'TeamsController@Add');
        Route::post('team/edit', 'TeamsController@Update');
        Route::get('teams', 'TeamsController@Get');


        // Collections
        Route::post('collection/add', 'CollectionsController@Add');
        Route::post('collection/edit', 'CollectionsController@Update');
        Route::post('collection/hide/{code_collection}', 'CollectionsController@Hide');
        Route::post('collection/show/{code_collection}', 'CollectionsController@Show');


        // Examination
        Route::post('examination/add', 'ExaminationController@Add');
        Route::post('examination/edit', 'ExaminationController@Update');
        Route::post('examination/hide/{code_examination}', 'ExaminationController@Hide');
        Route::post('examination/show/{code_examination}', 'ExaminationController@Show');

        // Report Examination
        Route::post('rp-examination/add', 'ReportExaminationsController@Add');


        // Exercise
        Route::post('exercise/add', 'ExerciseController@Add');
        Route::post('exercise/edit', 'ExerciseController@Update');
        Route::post('exercises/me', 'ExerciseController@GetOfMe');

        // Submission
        Route::post('submission/add', 'SubmissionController@Add');
        Route::post('submissions/me', 'SubmissionController@GetOfMe');


        //ReportError
        Route::post('rp-error/add', 'ReportErrorController@Add');
        Route::post('rp-errors/me', 'ReportErrorController@GetOfMe');
    });

    Route::group(['prefix' => 'client'], function () {
        // Team
        Route::get('teams', 'TeamsController@All');
        Route::get('team/get/{code_team}', 'TeamsController@GetOne');

        // Collection
        Route::get('collection/get/{code_team}', 'CollectionsController@GetByTeam');
        Route::get('collection/one/{code_collection}', 'CollectionsController@GetOne');
        Route::get('collections', 'CollectionsController@GetAll');


        // Examination
        Route::get('examination/get/{code_collection}', 'ExaminationController@GetByCollection');
        Route::get('examination/one/{code_examination}', 'ExaminationController@GetOne');
        Route::get('examinations', 'ExaminationController@GetAll');


        // Report Examination
        Route::get('rp-examinations', 'ReportExaminationsController@GetAll');
        Route::get('rp-examination/get/{username}', 'ReportExaminationsController@GetByUsername');
        Route::post('rp-examination/me', 'ReportExaminationsController@RpExaminationOfMe');

        // Exercise
        Route::get('/exercises', 'ExerciseController@GetAll');
        Route::get('/exercise/get/one/{exercise_code}', 'ExerciseController@GetOne');
        Route::get('/exercises/get/team/{code_team}', 'ExerciseController@GetByTeam');
        Route::get('/exercises/get/username/{username}', 'ExerciseController@GetByUsername');

        // Submission
        Route::get('/submissions', 'SubmissionController@GetAll');
        Route::get('/submission/get/one/{code_submission}', 'SubmissionController@GetOne');
        Route::get('/submissions/get/username/{username}', 'SubmissionController@GetByUsername');

        //ReportError
        Route::get('/rp-errors', 'ReportErrorController@GetAll');
        Route::get('/rp-error/get/one/{code_error}', 'ReportErrorController@GetOne');
        Route::get('/rp-errors/get/username/{username}', 'ReportErrorController@GetByUsername');

    });
});

//php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan clear-compiled && php artisan config:cache && php artisan serve