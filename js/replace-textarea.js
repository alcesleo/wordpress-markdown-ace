(function ($) {
    $(document).ready(function() {

        // original editor
        var $textarea = $('textarea.wp-editor-area');

        // insert element for Ace and hide original editor
        $textarea.after('<div id="wp_ace_editor"></div>');
        $textarea.hide();
        var $aceEditor = ace.edit("wp_ace_editor");

        // TODO: Hide unused controls

        // ace settings
        $aceEditor.setTheme("ace/theme/chrome"); // i think it fits with WP
        $aceEditor.setShowPrintMargin(false);

        // activate markdown mode
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

