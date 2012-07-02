<?php
// pagination styling comes from 
// http://twitter.github.com/bootstrap/components.html#pagination
?>
        <ul class="pager">
<?php
$disabled = "class='disabled'";
$disabled_previous = (strlen($data['previous_post_url'])<1) ?
$disabled : "";
$disabled_next = strlen($data['next_post_url'])<1 ? 
$disabled : "";
echo 
"
                <li $disabled_previous >
                  <a href='{$data['previous_post_url']}'>
                    Previous
                  </a>
                </li>
                <li $disabled_next >
                  <a href='{$data['next_post_url']}'>
                    Next 
                  </a>
                </li>
";


?>
        </ul>
