<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if( post_password_required() ) return; ?>

<div class="comments">
  <div id="comments" class="comments-area">

    <?php if( have_comments() ) : ?>

        <h3 class="comments-title">
          <?php
    				printf( wp_kses( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'dr' ), array() ),
    					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
    			?>
        </h3>

        <ol class="comment-list">

          <?php
            $args = array(
              'style'       => 'ol',
              'short_ping'  => true,
              'avatar_size' => 74
            );

            wp_list_comments( $args );

            ?>

        </ol><!-- .comment-list -->

        <?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

          <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading">

              <?php esc_html_e( 'Comment navigation' , 'dr' ); ?>

            </h1>
            <div class="nav-previous">

              <?php previous_comments_link( esc_html__( '&larr; Older Comments', 'dr' ) ); ?>

            </div>
            <div class="nav-next">

              <?php next_comments_link( esc_html_e( 'Newer Comments &rarr;', 'dr' ) ); ?>

            </div>
          </nav><!-- .navigation -->

        <?php endif ?>

        <?php if( !comments_open() && get_comments_number() ) : ?>

          <p class="no-comments">

            <?php esc_html_e( 'Comments are closed.' , 'dr' ); ?>

          </p>

        <?php endif;

    endif;

    comment_form( array( 'comment_notes_after' => '') ); ?>

  </div><!-- #comments -->
</div><!-- .comments -->
