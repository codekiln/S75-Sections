        <div class='container'>
        <?php
        include(V . "pagination.php");

          foreach( $data['posts_to_display'] as $post ) {
            // data will be available in $post var inside
            // post.php
            include( 'post.php' );
          }
        ?>

        </div><!--container-->

