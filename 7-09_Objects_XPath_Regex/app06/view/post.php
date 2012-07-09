
            <div class='well'>
<?php 
/*
Data is available here in the $post variable
*/
$permalink = 
  $data['url']['base'] 
  . '?title='
  . urlencode($post->title);

echo
"
<h2><a href='$permalink'>$post->title</a></h2>
$post->description
<p>$post->author</p>
<p>$post->pubDate</p>
";
?> 
            </div><!--well-->
