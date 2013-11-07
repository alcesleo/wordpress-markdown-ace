(function ($) {
    $(document).ready(function() {

        // insert #wp_ace_editor div after textarea
        $('textarea.wp-editor-area').after('<div id="wp_ace_editor"></div>');

        var styles_textarea = $('textarea.wp-editor-area').hide();
        var styles_editor = ace.edit("wp_ace_editor");

        styles_editor.setTheme("ace/theme/chrome");
        styles_editor.setShowPrintMargin(false);

        var MarkdownMode = require("ace/mode/markdown").Mode;
        styles_editor.getSession().setMode(new MarkdownMode());

        // connect editors with textareas
        // http://stackoverflow.com/questions/6440439/how-do-i-make-a-textarea-an-ace-editor
        styles_editor.getSession().setValue(styles_textarea.val());

        // connect the Ace instance to the hidden textarea
        styles_editor.getSession().on('change', function() {
            styles_textarea.val(styles_editor.getSession().getValue());
        });

    });
}(jQuery));

