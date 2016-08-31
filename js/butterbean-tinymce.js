( function() {

    butterbean.views.register_control( 'tinymce', {
        ready : function() {
            tinyMCE.execCommand( 'mceAddEditor', true, this.model.get('field_name') );
        }
    } );

}() );
