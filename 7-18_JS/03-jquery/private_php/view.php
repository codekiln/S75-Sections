<html>
  <head>
    
    <title><?php echo $data['title'] ?></title>
    <meta charset='utf-8'>

    <!-- google hosted jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <script src="<?php echo JS_URL_DIR ?>/main.js"></script>   

  </head>
  <body>
    <h1><?php echo $data['title'] ?></h1>
    <?php echo $data['directory_html']; ?>
  </body>
</html>
