( function( api, $ ) {
	api.controlConstructor['typography'] = api.Control.extend( {
		ready: function() {
			var control = this;
			// trigger popup
            control.container.on( 'click', '.popup-trigger', function() {
                $(this).toggleClass('dashicons-no-alt dashicons-edit close open');
                control.container.find('.content-wrap').toggle('slow', function() {
					$(this).toggleClass('open close')
				});
            })

			control.container.on( 'click', '.typography-inherit-tab .tab-item',
				function() {
					$(this).addClass('isActive').siblings('.tab-item').removeClass('isActive')
					$(this).siblings('input').val($(this).data( "value" ))
					control.settings['inherit'].set( $(this).data( "value" ) );
			})

			control.container.find( ".typography-font-family select" ).select2({
				dropdownCssClass: 'typo-select-increaseZindex',
				placeholder : 'Type to search'
			}); // bind select2 js
			
			control.container.on( 'change', '.typography-font-family select',
				function() {
					var _this = $(this)
					$.ajax({
						url: ajaxurl,
						data: ({
							'action': 'bloginwp_get_google_font_weight_html',
							'font_family': _this.val(),
						}),
						success: function(response) {
							_this.parents( '.typography-font-family' ).next( '.typography-font-weight' ).children('select').html(response);
						},
						complete: function() {
							var newValue = _this.parents( '.typography-font-family' ).next( '.typography-font-weight' ).children('select').val();
							control.settings['weight'].set( newValue );
						}
					})
					control.settings['family'].set( $( this ).val() );
				}
			);
			control.container.on( 'change', '.typography-font-weight select',
				function() {
					control.settings['weight'].set( $( this ).val() );
				}
			);
			control.container.on( 'change', '.typography-font-color input',
				function() {
					control.settings['color'].set( $( this ).val() );
				}
			);
			control.container.find( '.typography-font-color .bloginwp-color-field').wpColorPicker({
				change: function(event, ui) {
					control.settings['color'].set( ui.color.toString() );
				}
			});
			control.container.on( 'change', '.typography-font-style select',
				function() {
					control.settings['style'].set( $( this ).val() );
				}
			);
			control.container.on( 'change', '.typography-font-size input',
				function() {
					control.settings['size'].set( $( this ).val() );
				}
			);
			control.container.on( 'change', '.typography-line-height input',
				function() {
					control.settings['line_height'].set( $( this ).val() );
				}
			);
		}
	} );

} )( wp.customize, jQuery );