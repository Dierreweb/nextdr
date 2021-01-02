<div class="row <?php block_field( 'className' ); ?>">

  <?php

  if( block_value( 'name-member-1' ) !== '' || block_value( 'name-member-2' ) !== '' || block_value( 'name-member-3' ) !== '' || block_value( 'name-member-4' ) ) : ?>

  <?php

    $count = 0;

    if( block_value( 'name-member-1' ) ) : $count++; endif;

    if( block_value( 'name-member-2' ) ) : $count++; endif;

    if( block_value( 'name-member-3' ) ) : $count++; endif;

    if( block_value( 'name-member-4' ) ) : $count++; endif;

    $row = 'col-lg-' . 12 / $count . ' col-md-' . 12 / $count . ' col-sm-12';

    endif
  ?>

  <?php if( block_value( 'name-member-1' ) ) : ?>

    <div class="<?php echo esc_attr( $row ); ?>">
      <div class="team-member text-center team-member-hover">
        <div class="member-image-wrapper">
          <div class="member-image">
            <img src="<?php block_field( 'image-member-1' ); ?>" class="img-fluid" />
          </div>
        </div>
        <div class="member-details">
          <h4 class="member-name">

            <?php esc_html( block_field( 'name-member-1' ) ); ?>

          </h4>
          <span class="member-position">

            <?php esc_html( block_field( 'position-member-1' ) ); ?>

          </span>
          <div class="member-social">
            <div class="dierreweb-social-icons text-center icons-design-colored icons-size-small social-form-circle">
              <a rel="nofollow" href="<?php esc_url( block_field( 'facebook-link-member-1' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-facebook">
                <i class="fa fa-facebook"></i>
                <span class="dierreweb-social-icon-name">Facebook</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-1' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-twitter">
                <i class="fa fa-twitter"></i>
                <span class="dierreweb-social-icon-name">Twitter</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-1' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-linkedin">
                <i class="fa fa-linkedin"></i>
                <span class="dierreweb-social-icon-name">Linkedin</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'instagram-link-member-1' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-instagram">
                <i class="fa fa-instagram"></i>
                <span class="dierreweb-social-icon-name">Instagram</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif ?>

  <?php if( block_value( 'name-member-2' ) ) : ?>

    <div class="<?php echo esc_attr( $row ); ?>">
      <div class="team-member text-center team-member-hover">
        <div class="member-image-wrapper">
          <div class="member-image">
            <img src="<?php block_field( 'image-member-2' ); ?>" class="img-fluid" />
          </div>
        </div>
        <div class="member-details">
          <h4 class="member-name">

            <?php esc_html( block_field( 'name-member-2' ) ); ?>

          </h4>
          <span class="member-position">

            <?php esc_html( block_field( 'position-member-2' ) ); ?>

          </span>
          <div class="member-social">
            <div class="dierreweb-social-icons text-center icons-design-colored icons-size-small social-form-circle">
              <a rel="nofollow" href="<?php esc_url( block_field( 'facebook-link-member-2' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-facebook">
                <i class="fa fa-facebook"></i>
                <span class="dierreweb-social-icon-name">Facebook</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-2' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-twitter">
                <i class="fa fa-twitter"></i>
                <span class="dierreweb-social-icon-name">Twitter</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-2' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-linkedin">
                <i class="fa fa-linkedin"></i>
                <span class="dierreweb-social-icon-name">Linkedin</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'instagram-link-member-2' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-instagram">
                <i class="fa fa-instagram"></i>
                <span class="dierreweb-social-icon-name">Instagram</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif ?>

  <?php if( block_value( 'name-member-3' ) ) : ?>

    <div class="<?php echo esc_attr( $row ); ?>">
      <div class="team-member text-center team-member-hover">
        <div class="member-image-wrapper">
          <div class="member-image">
            <img src="<?php block_field( 'image-member-3' ); ?>" class="img-fluid" />
          </div>
        </div>
        <div class="member-details">
          <h4 class="member-name">

            <?php esc_html( block_field( 'name-member-3' ) ); ?>

          </h4>
          <span class="member-position">

            <?php esc_html( block_field( 'position-member-3' ) ); ?>

          </span>
          <div class="member-social">
            <div class="dierreweb-social-icons text-center icons-design-colored icons-size-small social-form-circle">
              <a rel="nofollow" href="<?php esc_url( block_field( 'facebook-link-member-3' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-facebook">
                <i class="fa fa-facebook"></i>
                <span class="dierreweb-social-icon-name">Facebook</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-3' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-twitter">
                <i class="fa fa-twitter"></i>
                <span class="dierreweb-social-icon-name">Twitter</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-3' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-linkedin">
                <i class="fa fa-linkedin"></i>
                <span class="dierreweb-social-icon-name">Linkedin</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'instagram-link-member-3' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-instagram">
                <i class="fa fa-instagram"></i>
                <span class="dierreweb-social-icon-name">Instagram</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif ?>

  <?php if( block_value( 'name-member-4' ) ) : ?>

    <div class="<?php echo esc_attr( $row ); ?>">
      <div class="team-member text-center team-member-hover">
        <div class="member-image-wrapper">
          <div class="member-image">
            <img src="<?php block_field( 'image-member-4' ); ?>" class="img-fluid" />
          </div>
        </div>
        <div class="member-details">
          <h4 class="member-name">

            <?php esc_html( block_field( 'name-member-4' ) ); ?>

          </h4>
          <span class="member-position">

            <?php esc_html( block_field( 'position-member-4' ) ); ?>

          </span>
          <div class="member-social">
            <div class="dierreweb-social-icons text-center icons-design-colored icons-size-small social-form-circle">
              <a rel="nofollow" href="<?php esc_url( block_field( 'facebook-link-member-4' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-facebook">
                <i class="fa fa-facebook"></i>
                <span class="dierreweb-social-icon-name">Facebook</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-4' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-twitter">
                <i class="fa fa-twitter"></i>
                <span class="dierreweb-social-icon-name">Twitter</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'twitter-link-member-4' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-linkedin">
                <i class="fa fa-linkedin"></i>
                <span class="dierreweb-social-icon-name">Linkedin</span>
              </a>
              <a rel="nofollow" href="<?php esc_url( block_field( 'instagram-link-member-4' ) ); ?>" target="_blank" class=" dierreweb-social-icon social-instagram">
                <i class="fa fa-instagram"></i>
                <span class="dierreweb-social-icon-name">Instagram</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif ?>

</div>
