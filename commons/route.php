<?php

use App\Controllers\AnswerController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\QuestionController;
use App\Controllers\QuizController;
use App\Controllers\SubjectController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url){
    $router = new RouteCollector();

    // filter check login
    $router->filter('auth', function(){
        if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
            header('location: ' . BASE_URL . 'login');
            die;
        }
    });

    $router->get('/', [LoginController::class, 'index']);
    $router->post('/', [LoginController::class, 'login']);


    // định nghĩa ra url mới
    $router->group(['prefix' => 'mon-hoc', 'before' => 'auth'], function($router){
    // $router->group(['prefix' => 'mon-hoc'], function($router){
        $router->get('/', [SubjectController::class, 'index']);
        $router->get('tao-moi', [SubjectController::class, 'addForm']);
        $router->post('tao-moi', [SubjectController::class, 'saveAdd']);
        $router->get('cap-nhat/{id}', [SubjectController::class, 'editForm']);
        $router->post('cap-nhat/{id}', [SubjectController::class, 'saveEdit']);
        $router->get('xoa/{id}', [SubjectController::class, 'remove']);
        
        $router->get(['/{id}?', 'subject.index'], [SubjectController::class, 'index']);
    });

    $router->group(['prefix'=>'quiz', 'before'=>'auth'],function($router){
        $router->get('add', [QuizController::class, 'addForm']);
        $router->post('add', [QuizController::class, 'saveAdd']);
        $router->get('cap-nhat/{id}', [QuizController::class, 'editForm']);
        $router->post('cap-nhat/{id}', [QuizController::class, 'saveEdit']);
        $router->get('xoa/{id}', [QuizController::class, 'remove']);
        $router->get('lam_quiz/{id}', [QuizController::class, 'lam_quiz']);
        $router->post('lam_quiz/{id}', [QuizController::class, 'ketQua']);
        $router->get('addQuestion/{id}', [QuestionController::class, 'index']);
        $router->post('addQuestion/{id}', [QuestionController::class, 'saveAdd']);
        $router->get('/{id}?', [QuizController::class, 'index']);
    });

    $router->group(['prefix'=>'question', 'before'=>'auth'],function($router){
        
        $router->get('/', [QuestionController::class, 'showAllQuestion']);
        $router->get('remove/{id}', [QuestionController::class, 'remove']);
      
    });

    $router->group(['prefix'=>'answer', 'before'=>'auth'],function($router){
        
        $router->get('/', [AnswerController::class, 'index']);
        $router->get('remove/{id}', [AnswerController::class, 'remove']);
      
    });

    $router->group(['prefix'=>'login'],function($router){
        $router->get('/', [LoginController::class, 'index']);
        $router->post('/', [LoginController::class, 'login']);
        $router->get('tao-moi', [LoginController::class, 'addForm']);
        $router->post('tao-moi', [LoginController::class, 'saveAdd']);
        
    });
   
    $router->get('logout', function(){
        unset($_SESSION['auth']);
        header('location: '.BASE_URL .'login');
        die;
    });


    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    echo $response;
}


?>