<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?> &middot; Carnia Design Studio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/onepage.css" rel="stylesheet">
    <link href="/assets/css/cd_custom.css" rel="stylesheet">
    <link href="/assets/css/flexslider.css" rel="stylesheet">
    <link href="/assets/css/pricing_tables.css" rel="stylesheet">

    <style>body { padding-top: 70px; }</style>

    <!-- Google Fonts call. Font Used Open Sans & Open Sans Condensed -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

    <body>
        <div class="container">
            <?php include "incl/header_{$lang}.php"; ?>
        </div>

    <?php echo $content; ?>

    <?php include 'incl/twitter_widget.php'; ?>

    <?php include "incl/footer_{$lang}.php"; ?>

    <!-- Le javascript
    ================================================== -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.flexslider.js"></script>
    <script src="/assets/js/onepage/js/main.js"></script>
    </body>
</html>
