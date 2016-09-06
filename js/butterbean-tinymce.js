( function() {

    butterbean.views.register_control( 'tinymce', {
        ready : function() {
            if (typeof tinyMCE !== "undefined") {
                tinyMCE.execCommand('mceAddEditor', true, this.model.get('field_name'));
            }
        }
    } );

}() );
