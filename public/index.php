<?php

///////////////////////////////////////////////////////////////////////
// --------------------------- VARIABLES --------------------------- //
///////////////////////////////////////////////////////////////////////

if($_SERVER['SERVER_NAME'] == 'carnia.local')
{
    $_ENV['SLIM_MODE'] = 'development';
}
else
{
    $_ENV['SLIM_MODE'] = 'production';
}

define('TEMPLATEPATH','../templates');

require '../config.php';

///////////////////////////////////////////////////////////////////////////////////////
// --------------------------- INITIATE SLIM APPLICATION --------------------------- //
///////////////////////////////////////////////////////////////////////////////////////

require '../lib/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

// Instantiate and configure Slim
$app = new \Slim\Slim(array(
    'templates.path' => TEMPLATEPATH
    //'log.enabled'    => true,
    //'log.level'    => \Slim\Log::WARN,
    //'view'         => new \Slim\Extras\Views\Twig()
));

////////////////////////////////////////////////////////////////////////////////
// --------------------------- APPLICATION ROUTES --------------------------- //
////////////////////////////////////////////////////////////////////////////////

$app->get('/(:lang)(/)(:page)', function ($lang = 'en', $page = 'home') use ($app, $config) {

    $data['title'] = (isset($config['siteTitles'][$lang][$page])) ? $config['siteTitles'][$lang][$page] : '';

    $view = (!isset($config['pageMaps'][$lang][$page])) ? $page : $config['pageMaps'][$lang][$page];

    $data['content'] = (loadView($view, $lang)) ?: $app->notFound();

    $data['lang'] = $lang;

    $app->render('template.php', $data);

})->conditions(array('lang'=>'en|mk'));

/**
 * Contact Form Post
 */
$app->post('/submitContactForm', function() use ($app,  $config) {

    $req = $app->request();

    $clientName    = $req->post('name');
    $clientEmail   = $req->post('email');
    $clientMessage = $req->post('message');

    $subject = "[CarniaDesign] - {$clientName} has requested information.";

    $validation = validate($clientName, $clientEmail, $clientMessage);

    if($validation['success'] == '1')
    {
        sendEmail($config['emailTo'], $clientName, $clientEmail, $subject, $clientMessage);
    }

    echo json_encode($validation);

    die();
});

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

function sendEmail($to, $name, $email, $subject, $message)
{
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";

    $message = "<strong>Name: </strong>" . $name . "<br>";
    $message .= "<strong>Message:</strong>" . "<br>" . $message . "<br>";

    @mail($to, $subject, $message,$headers);

    return true;
}

function validate($name,$email,$message)
{
    $return_array                = array();
    $return_array['success']     = '1';
    $return_array['errors']      = array();

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