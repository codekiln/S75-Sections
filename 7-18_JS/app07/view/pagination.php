<?php
// pagination styling comes from
// http://twitter.github.com/bootstrap/components.html#pagination

// below, we will add this class to the pagination element to
// make it look "disabled" if there is no previous or next post
$disabled_class = 'class="disabled"'; 

$disabled_previous =
  // if there is a previous post url
  $data['url_previous_post']
  // then we will not disable the element
  ? ''
  // if not, then we will disable it.
  : $disabled_class;

$disabled_next = 
  $data['url_next_post'] 
  ? ''
  : $disabled_class;

?>
<ul class="pager">
  <li <?php echo $disabled_previous ?> > 
    <a href='<?php echo $data['url_previous_post'] ?>'> Previous </a> 
  </li> 
  <li <?php echo $disabled_next ?> > 
    <a href='<?php echo $data['url_next_post'] ?>'> Next </a>
  </li>
</ul>
