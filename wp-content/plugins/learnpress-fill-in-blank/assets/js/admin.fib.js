;(function ($) {

    window.FIB = {
        //i18n = <?php echo json_encode( $i18n );?>;

        getSelectedText: function getSelectedText() {
            var html = "";
            if (typeof window.getSelection !== "undefined") {
                var sel = window.getSelection();
                if (sel.rangeCount) {
                    var container = document.createElement("div");
                    for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                        container.appendChild(sel.getRangeAt(i).cloneContents());
                    }
                    html = container.innerHTML;
                }
            } else if (typeof document.selection !== "undefined") {
                if (document.selection.type === "Text") {
                    html = document.selection.createRange().htmlText;
                }
            }
            return html;
        },

        createTextNode: function (content) {
            return document.createTextNode(content);
        },

        isContainHtml: function isContainHtml(content) {
            var $el = $(content), sel = 'b.fib-blank';
            return $el.is(sel) || $el.find(sel).length || $el.parent().is(sel);
        },

        getSelectionRange: function getSelectionRange() {
            var t = '';
            if (window.getSelection) {
                t = window.getSelection();
            } else if (document.getSelection) {
                t = document.getSelection();
            } else if (document.selection) {
                t = document.selection.createRange().text;
            }
            return t;
        },

        outerHTML: function ($dom) {
            return $('<div>').append($($dom).clone()).html();
        },

        doUpgrade: function (callback) {
            $.ajax({
                url: '',
                data: {
                    'lp-ajax': 'fib-upgrade'
                },
                success: function (res) {
                    console.log(res)
                    callback && callback.call(res);
                }
            });
        }
    }

    $(document).ready(function () {
        $('#do-upgrade-fib').on('click', function () {
            var $button = $(this).prop('disabled', true).addClass('ajaxloading');
            FIB.doUpgrade(function () {
                $button.prop('disabled', false).removeClass('ajaxloading');
            });
        })
    })

})(jQuery);