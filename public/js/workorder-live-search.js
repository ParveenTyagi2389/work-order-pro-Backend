(function ($) {
    'use strict';
    function norm(v) { return $.trim(String(v || '').replace(/\s+/g, ' ')).toLocaleLowerCase(); }
    function filter($input, $table) {
        if (!$table.length) return;
        var q = norm($input.val()), $tbody = $table.find('tbody').first();
        var $rows = $tbody.children('tr').not('.live-search-no-results'), count = 0;
        var cols = $table.find('thead tr').last().children('th').length || 1;
        $rows.each(function () {
            var $r = $(this);
            if ($r.is('[data-live-search-ignore]')) { $r.show(); return; }
            var match = !q || norm($r.find('td').not('[data-live-search-ignore]').text()).indexOf(q) !== -1;
            $r.toggle(match); if (match) count++;
        });
        var $empty = $tbody.children('tr.live-search-no-results');
        if (q && count === 0) {
            if (!$empty.length) {
                $empty = $('<tr class="live-search-no-results"><td></td></tr>');
                $empty.find('td').text('No matching records found.');
                $tbody.append($empty);
            }
            $empty.find('td').attr('colspan', cols); $empty.show();
        } else { $empty.hide(); }
    }
    function tableFor($input) {
        var sel = $input.attr('data-live-search-for') || $input.attr('data-live-search');
        if (sel && sel !== 'true') return $(sel).first();
        var id = $input.attr('aria-controls');
        if (id) return $('#' + id).first();
        return $input.closest('.panel, .content-area, .table-responsive-custom, .table-responsive').find('table').first();
    }
    $(document).on('input keyup search', 'input[data-live-search-for], input[data-live-search]', function () {
        filter($(this), tableFor($(this)));
    });
    $(function () {
        $('input[data-live-search-for], input[data-live-search]').each(function () {
            if ($.trim($(this).val() || '') !== '') filter($(this), tableFor($(this)));
        });
    });
})(jQuery);
