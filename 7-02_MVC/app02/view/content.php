        <div class='container'>
        <?php
          foreach( $data['query'] as $post ) {
            // data will be available in $post var
            include( 'post.php' );
          }
        ?>

        </div><!--container-->

