
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/colorgraf.css" rel="stylesheet" media="screen">

    <title>Interestship <?php if(isset($PageTitle)) { echo $PageTitle; } ?></title>
    <!-- Additional tags here -->
    <?php if (function_exists('customPageHeader')){
      customPageHeader();
    }?>
  </head>
  <body>