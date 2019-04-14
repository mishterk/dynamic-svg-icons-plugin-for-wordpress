(function ($, window, document, undefined) {

    $(function () {

        var $icons = $('#dsvgi-icons');
        if (!$icons.length) {
            return;
        }

        $icons = $($icons.html());

        $icons.each(function () {
            var $this = $(this),
                id = $this.attr('id'),
                $svg = $this.find('svg');

            // find DOM elements with matching class to insert into
            var $wrap = $('.' + id + '-wrap');
            if ($wrap.length) {
                $wrap.html($svg.clone());
            }

            // find DOM elements with matching class to replace
            var $replace = $('.' + id);
            if ($replace.length) {
                $replace.replaceWith($svg.clone());
            }
        });

    });

})(jQuery, window, document);