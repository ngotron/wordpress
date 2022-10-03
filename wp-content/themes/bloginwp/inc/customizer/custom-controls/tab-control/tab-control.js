( function( api, $ ) {
	api.controlConstructor['tab-control'] = api.Control.extend( {
		ready: function() {
			var control = this;
            // trigger click
            control.container.find( ".tab-item" ).each(function() {
                var singleContainer = $(this)
                singleContainer.on( "click", function(e) {
                    e.preventDefault();
                    $(this).siblings().removeClass( "isActive" )
                    $(this).toggleClass( "isActive" )
                    controls = $(this).data( "controls" )
                    if ( 'undefined' != typeof controls ) {
                        controls.forEach(function(item,index) {
                            wp.customize.control(item).activate({ duration: 0 })
                        })
                    }
                    
                    controls_hide = $(this).data( "hide" )
                    if ( 'undefined' != typeof controls_hide ) {
                        controls_hide.forEach(function(item,index) {
                            wp.customize.control(item).deactivate({ duration: 0 })
                        })
                    }
                })
            })
        }
    });
} )( wp.customize, jQuery );