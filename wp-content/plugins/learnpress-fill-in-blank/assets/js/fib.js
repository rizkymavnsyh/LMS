;(function ($) {
    "use strict";

    function _ready() {
        (typeof LearnPress !== 'undefined') && LearnPress.Hook.addAction('learn_press_check_question', function (response, that) {
            if (!response || response.result !== 'success') {
                return;
            }
            var $current = that.model.current(),
                $content = $($current.get('content'));
            $content.find('.question-passage').replaceWith(response.checked);
            $content.addClass('checked').find('input, select, textarea').prop('disabled', true);
            $current.set('content', $content);
        });
    }

    $(document).ready(_ready);
})(jQuery);