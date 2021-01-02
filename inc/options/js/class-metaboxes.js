jQuery( document ).ready( function( $ ) {

  window.CMB2 = ( function( window, document, $, undefined ) {

    'use strict';

    // Class Button
    $( '.btn-item' ).click( function() {
      var parent = $( this ).parents( '.dierreweb-btns' );
      $( '.btn-item', parent ).removeClass( 'btn-active' );
      $( this ).addClass( 'btn-active' );
    } );

    // Class Slider
    var sliders = $( '.cmb-type-slider' );
    sliders.each( function() {
      var $this = $( this );
      var $value = $this.find( '.cmb2-slider-value' );
      var $slider = $this.find( '.cmb2-slider' );
      var $text = $this.find( '.cmb2-slider-value-text' );
      var slider_data = $value.data();

      $slider.slider( {
        range: 'min',
        value: slider_data.start,
        min: slider_data.min,
        step: slider_data.step,
        max: slider_data.max,
        slide: function( event, ui ) {
          $value.val( ui.value ).trigger( 'change' );
          $text.text( ui.value );
        }
      } );

      $value.val( $slider.slider( 'value' ) ).trigger( 'change' );
      $text.text( $slider.slider( 'value' ) );

    } );

  } )( window, document, jQuery );
} );
