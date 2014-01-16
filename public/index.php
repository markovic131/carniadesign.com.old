<?php

///////////////////////////////////////////////////////////////////////
// --------------------------- VARIABLES --------------------------- //
///////////////////////////////////////////////////////////////////////

if($_SERVER['SERVER_NAME'] == 'carnia.local') {

    $_ENV['SLIM_MODE'] = 'development';
    date_default_timezone_set('Europe/Skopje');

}
else{

    $_ENV['SLIM_MODE'] = 'production';
    date_default_timezone_set('Europe/Skopje');

}

define('TEMPLATEPATH','../templates');

require '../config.php';

///////////////////////////////////////////////////////////////////////////////////////
// -------------------------- INSTANTIATE SLIM APPLICATION ------------------------- //
///////////////////////////////////////////////////////////////////////////////////////

require '../lib/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('templates.path' => TEMPLATEPATH));

////////////////////////////////////////////////////////////////////////////////
// --------------------------- APPLICATION ROUTES --------------------------- //
////////////////////////////////////////////////////////////////////////////////

$app->get('/(:lang)(/)(:page)', function ($lang = 'en', $page = 'home') use ($app, $config) {

    if(!in_array($lang, array('en','mk'))) {

        $app->notFound();

    }

    if(!isset($config['pageMaps'][$lang][$page])) {

        $app->notFound();

    }

    $data['title'] = (isset($config['siteTitles'][$lang][$page])) ?
        $config['siteTitles'][$lang][$page] : '';

    $data['headerNavi'] = $config['siteTitles'][$lang];

    $data['content'] = (loadView((!isset($config['pageMaps'][$lang][$page])) ?
        $page : $config['pageMaps'][$lang][$page], $lang)) ?: $app->notFound();

    $data['lang'] = $lang;

    $app->render('template.php', $data);

})->conditions(array('lang'=>'en|mk'));

$app->post('/postContactForm', function() use ($app,  $config) {

    $req = $app->request();

    $clientName    = $req->post('name');
    $clientEmail   = $req->post('email');
    $clientMessage = $req->post('message');

    $subject = "[CarniaDesign] - {$clientName} has requested information.";

    $validation = validate($clientName, $clientEmail, $clientMessage);

    if($validation['success'] == '1') {

        sendEmail($config['emailTo'], $clientName, $clientEmail, $subject, $clientMessage);

    }

    echo json_encode($validation);
    exit;
});

// $app->notFound(function () use ($app) {

//     $data['title'] = '404';
//     $data['lang'] = 'en';
//     $data['content'] = loadView('404','en');

//     $app->render('template.php', $data);

//     //$app->halt(404, 'Custom 404 Not Found');

// });

/////////////////////////////////////////////////////////////////////////////
// --------------------------- RUN APPLICATION --------------------------- //
/////////////////////////////////////////////////////////////////////////////

$app->run();

///////////////////////////////////////////////////////////////////////////////
// --------------------------- PRIVATE FUNCTIONS --------------------------- //
///////////////////////////////////////////////////////////////////////////////

function loadView($view = '', $lang = '')
{
    if(!file_exists(TEMPLATEPATH."/{$lang}/{$view}.php"))
    {
        return false;
    }

    ob_start();

    include(TEMPLATEPATH."/{$lang}/{$view}.php");

    $buffer = ob_get_contents();

    @ob_end_clean();

    return $buffer;
}

function sendEmail($to, $clientName, $clientEmail, $emailSubject, $clientMessage)
{
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "From: {$clientName} <{$clientEmail}>" . "\r\n";

    $message  = "<strong>Name:</strong> {$clientName} <{$clientEmail}><br>";
    $message .= "<hr>";
    $message .= "{$clientMessage}<br>";
    $message .= "<hr><br>";
    $message .= '<strong>Request Time:</strong> ' . date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']) . "<br>";
    $message .= '<strong>Remote Address:</strong> ' . $_SERVER['REMOTE_ADDR'] . "<br>";

    @mail($to, $emailSubject, $message, $headers);

    return true;
}

function validate($name,$email,$message)
{
    $return_array                = array();
    $return_array['success']     = '1';
    $return_array['errors']      = array();

    if($name == '') {
        $return_array['success'] = '0';
        array_push($return_array['errors'],'Name is required');
    }
    else {
        $string_exp = "/^[A-Za-z .'-]+$/";

        if (!preg_match($string_exp, $name)) {
            $return_array['success'] = '0';
            array_push($return_array['errors'],'Enter valid name');
        }
    }

    if($email == '') {
        $return_array['success'] = '0';
        array_push($return_array['errors'],'Email is required');
    }
    else {
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if(!preg_match($email_exp,$email)) {
            $return_array['success'] = '0';
            array_push($return_array['errors'],'Enter valid email');
        }
    }

    if($message == '') {
        $return_array['success'] = '0';
        array_push($return_array['errors'],'Message is required');
    }
    else {
        if (strlen($message) < 2) {
            $return_array['success'] = '0';
            array_push($return_array['errors'],'Enter valid message');
        }
    }
    return $return_array;
}