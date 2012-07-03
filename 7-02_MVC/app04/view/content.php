        <div class='container'>
        <?php
        // NEW app03: include pagination links
        include(V . "pagination.php");

        // NEW: changed the variable name to posts_to_display
          foreach( $data['posts_to_display'] as $post ) {
            // data will be available in $post var
            include( 'post.php' );
          }
        ?>

        </div><!--container-->

