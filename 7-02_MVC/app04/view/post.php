
            <div class='well'>
<?php 
/*
Data is available here in the $post variable
*/
echo
"
<h2><a href='{$post->link}'>{$post->title}</a></h2>
{$post->description}
<p>$post->author</p>
<p>$post->pubDate</p>
";
?> 
            </div><!--well-->
