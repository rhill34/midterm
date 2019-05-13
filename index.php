<?php

//Start a session
session_start();

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required file
require_once('vendor/autoload.php');
require_once('model/validate.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define arrays
$f3->set('meals', array('breakfast', 'lunch', 'dinner'));
$f3->set('apply', array('This is an easy midterm','I like Midterms','Today is Monday'));

//Define a default route
$f3->route('GET /', function() {

    echo "<h1>Midterm Survey</h1>";
    echo "<a href='survey'>Take My Midterm Survey</a>";
});

//Define an order route
$f3->route('GET|POST /survey', function($f3) {

    //If form has been submitted, validate
    if(!empty($_POST)) {

        //Get data from form
        $food = $_POST['food'];
        $meal = $_POST['meal'];
        $qty = $_POST['qty'];

        //Add data to hive
        $f3->set('food', $food);
        $f3->set('meal', $meal);
        $f3->set('qty',$qty);

        //If data is valid
        if (validForm()) {

            //Write data to Session
            $_SESSION['food'] = $food;
            $_SESSION['meal'] = $meal;
            $_SESSION['qty'] = $qty;

            //Redirect to Summary
            $f3->reroute('/summary');
        }
    }

    //Display order form
    $view = new Template();
    echo $view->render('views/midterm-form.html');
});

//Define a summary route
$f3->route('GET /summary', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();