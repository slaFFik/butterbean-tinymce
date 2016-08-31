( function() {

    butterbean.views.register_control( 'tinymce', {

        // Calls the core WP color picker for the control's input.
        ready : function() {

            var options = this.model;

            tinyMCE.execCommand( 'mceAddEditor', true, this.model.get('field_name') );
        }
    } );
}() );
