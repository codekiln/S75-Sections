<?php
include("../permissions.php");

// we're going to store all our output in this array. 
$paragraphs = array();

$paragraphs[] = 
"<h2>Intro to MVC</h2>";

$paragraphs[] = "Web Developers call dynamic websites <strong>web
applications</strong> because from the coder's perspective,
<strong>dynamic websites are applications that run on a web
server</strong>.";

$paragraphs[] = "Modern applications follow <strong>design
patterns</strong>. One very common design pattern is Model, View,
Controller, or MVC.";

$paragraphs[] = 
"To follow MVC when writing an application, you 
<em>separate your code</em> according to the function of the code:
<ul>
  <li><strong>Model</strong> code stores the application data and
    <em>models</em> your application's domain. For example, if
    you were writing a blogging application, the Model
    code would determine what data needs to
    be stored about a Blog Post, and take responsibility for storing
    and retrieving Blog Post data.</li>
  <li><strong>View</strong> code produces anything 
    <em>viewable</em> by the site visitor. For example, in a blogging
    application, the View code would turn a Blog Post's data
    into HTML and CSS, which would then be rendered in the site viewer's
    web browser and determine how the site appears to the visitor.</li>
  <li><strong>Controller</strong> code receives all of site
    visitor's clicks and other input, and uses them to help the user
    <em>control</em> your application. For example, in a blogging
    site, if a user clicks on 'next post', the controller will
    receive that click, fetch the appropriate Model from the
    model code, send and send it to the View to turn it into the HTML
    that the site viewer's browser will render for the Site
    Viewer's viewing pleasure.</li>
</ul>
";

$paragraphs[] = "Posted By: <strong>P. Myer Nore</strong>";

$paragraphs[] = "Posted On: <strong>7/2/2012</strong>";

echo 
"<!DOCTYPE html>
<html lang='en'>
  <head><title>MVC Blog</title>
    <link rel='stylesheet' type='text/css'
      href='../bootstrap/css/bootstrap.min.css'/>
    <style type='text/css'>
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      h2 {
        font-style:italic;
      }
    </style>
    <link rel='stylesheet' type='text/css'
      href='../bootstrap/css/bootstrap-responsive.css'/>
  </head>
  <body>
  
      <div class='navbar navbar-fixed-top'>
        <div class='navbar-inner'>
          <div class='container'>
            <a class='brand' href='#'>
              MVC Blog
            </a>
            <div class='pull-right'>
              <a class='brand'>Exploring 
              <abbr title='Model, View, Controller'>MVC</abbr> 
              since 2002</a>
            </div><!-- pull-right -->
          </div><!-- container -->
        </div><!-- navbar-inner -->
      </div><!-- navbar -->

      <div class='container'>
";

// we're going to fill up the area with some sample blog posts
for( $i = 0; $i < 3; $i++ ) {
    echo 
    "
            <div class='well'>
    ";
    foreach($paragraphs as $paragraph) {
      echo "<p>$paragraph</p>";
    }
    echo 
    "
          </div><!-- well -->
    ";

}

echo 
"
    </div><!-- container -->
  </body>
</html>";
