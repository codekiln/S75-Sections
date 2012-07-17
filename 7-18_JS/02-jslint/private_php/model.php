<?php // model.php

/**
 * Generates a valid XHTML list of all directories, 
 * sub-directories, and files in a $directory
 * 
 * @author http://goo.gl/Ft7m5 
 * @param $directory string Name of the directory to print
 * @param $return_link string Javascript to insert inside 
 *                            anchor element using '[link]' 
 *                            to substitute for current file.
 **/
function php_file_tree
(
  $directory
  , $return_link = "javascript:alert('You clicked on [link]');"
) 
{
  $code = '';
  // Remove trailing slash
  if( substr($directory, -1) == "/" ) 
  {
    $directory = substr(
      $directory
      , 0
      , strlen($directory) - 1
    );
  }
  $code .= php_file_tree_dir($directory, $return_link );
  return $code;
}

/**
 * Recursive funciton to map a directory structure to 
 * an unordered list
 * 
 * @author http://goo.gl/Ft7m5 
 **/
function php_file_tree_dir
(
    $directory // directory to search
    , $return_link // current node 
    , $first_call = true // true IFF this first call of function
) 
{
  // Recursive function called by php_file_tree() to list directories/files

  $php_file_tree = '';

  // Get and sort directories/files
  $file = scandir($directory);
  natcasesort($file);

  // Make directories first
  $files = $dirs = array();
  foreach($file as $this_file) 
  {
    if( is_dir("$directory/$this_file" ) )
    {
        $dirs[] = $this_file; 
    } else
    {
      $files[] = $this_file;
    }
  }
  $file = array_merge($dirs, $files);

  // Use 2 instead of 0 to account for . and .. "directories"
  if( count($file) > 2 ) 
  { 
    $php_file_tree = "<ul";
    if( $first_call ) 
    { 
      $php_file_tree .= " class=\"php-file-tree\""; 
      $first_call = false; 
    }
    $php_file_tree .= ">";
    foreach( $file as $this_file ) 
    {
      if( $this_file != "." && $this_file != ".." ) 
      {
        if( is_dir("$directory/$this_file") ) 
        {
          // Directory
          $php_file_tree .= 
            "<li class=\"pft-directory\"><a href=\"#\">" 
            . htmlspecialchars($this_file) 
            . "</a>";
          $php_file_tree .= 
            php_file_tree_dir
            (
              "$directory/$this_file"
              , $return_link 
              , false
            );
          $php_file_tree .= "</li>";
        } else // File
        {
          // Get extension 
          // (prepend 'ext-' to prevent invalid classes from
          // extensions that begin with numbers)
          $ext = "ext-" 
            . substr(
                $this_file
                , strrpos($this_file, ".") + 1
              ); 
          $link = 
            str_replace(
              "[link]"
              , "$directory/" . urlencode($this_file)
              , $return_link
            );
          $php_file_tree .= 
            "<li class=\"pft-file " 
            . strtolower($ext) 
            . "\"><a href=\"$link\">" 
            . htmlspecialchars($this_file) 
            . "</a></li>";
        }
      }
    }
    $php_file_tree .= "</ul>";
  }
  return $php_file_tree;
}

