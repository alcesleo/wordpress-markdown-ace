 jQuery(document).ready(function() {

    // insert #wpl_ace_editor div after textarea
    jQuery('textarea.wp-editor-area').after('<div id="wpl_ace_editor">test</div>');

    var styles_textarea = jQuery('textarea.wp-editor-area').hide();
    var styles_editor = ace.edit("wpl_ace_editor");

    styles_editor.setTheme("ace/theme/chrome");
    styles_editor.setShowPrintMargin( false );

    var MarkdownMode = require("ace/mode/markdown").Mode;
    styles_editor.getSession().setMode(new MarkdownMode());

    // connect editors with textareas
    // http://stackoverflow.com/questions/6440439/how-do-i-make-a-textarea-an-ace-editor
    styles_editor.getSession().setValue(styles_textarea.val());

    styles_editor.getSession().on('change', function(){
        styles_textarea.val(styles_editor.getSession().getValue());
    });

});
