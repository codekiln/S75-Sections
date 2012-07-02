        <div class='container'>
        <?php
          foreach( $data['result'] as $post ) {
            // data will be available in $post var
            include( 'post.php' );
          }
        ?>

        </div><!--container-->

