(function ($) {
    $(document).ready(function() {

        // insert #wp_ace_editor div after textarea
        $('textarea.wp-editor-area').after('<div id="wp_ace_editor"></div>');

        // hide textarea and get elements
        var $textarea = $('textarea.wp-editor-area').hide();
        var $aceEditor = ace.edit("wp_ace_editor");

        $textarea.hide();

        // ace settings
        $aceEditor.setTheme("ace/theme/chrome");
        $aceEditor.setShowPrintMargin(false);

        var MarkdownMode = require("ace/mode/markdown").Mode;
        $aceEditor.getSession().setMode(new MarkdownMode());

        // connect editors with textareas
        // http://stackoverflow.com/questions/6440439/how-do-i-make-a-textarea-an-ace-editor
        $aceEditor.getSession().setValue($textarea.val());

        $aceEditor.getSession().on('change', function() {
            $textarea.val($aceEditor.getSession().getValue());
        });

    });
}(jQuery));

