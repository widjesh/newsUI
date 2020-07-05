/**
 * Created by Miko on 7/20/2017.
 */
$(document).ready(function () {
    $(".sidebar-wrapper ul.nav").find($('a[href="' + window.location.toString() + '"]')).parent().addClass("active");

    $(".del").click(function () {
        if (confirm("Do you like delete this item?")) {
            window.location.href = $(this).attr("data-url");
        }
    });

    $(".switch input").on("change", function () {
        if ($(this).attr("id") !== undefined) {
            var element = $(this);
            $.post(window.location.href, {id: $(this).attr("id"), active: $(this).is(":checked") ? 1 : 0},
                function (result) {
                    if (result !== "1") {
                        element.prop('checked', !element.is(":checked"));
                        $.notify(
                            {message: 'Error on status change. Please try again.'},
                            {type: 'danger'}
                            );
                    }else{
                        $.notify(
                            {message: 'News status changed successful.'},
                            {type: 'success'}
                        );
                    }
                });
        }
    });

    if ($(".featured").length) {
        $(".featured").click(function () {
            if ($(this).data("id") !== undefined) {
                var element = $(this);
                var text = $(this).find("i").text()==='star' ? 'star_outline':'star';
                $.post(window.location.href, {news_id: $(this).data("id"), featured: $(this).find("i").text()==='star' ? 0 : 1},
                    function (result) {
                        if (result !== "1") {
                            $.notify(
                                {message: 'Error. Please try again.'},
                                {type: 'danger'}
                            );
                        }else{
                            element.find("i").text(text);
                            $.notify(
                                {message: 'News featured status changed successful.'},
                                {type: 'success'}
                            );
                        }
                    });
            }
        });
    }

    $(".filter .select").change(function (event) {
        window.location = event.target.value;
    });

    if (typeof(CKEDITOR)!=='undefined' && $('#newscontent').length){
        CKEDITOR.replace('newscontent', {
            removePlugins: 'flash,language',
            removeButtons: 'Subscript,Superscript,Table,PageBreak,Font,Anchor',
            height: '25em',
            toolbarGroups:[
                { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph',   groups: [ 'list', 'indent', 'align', 'bidi' ] }, '/',
                { name: 'links' },
                { name: 'insert' },
                { name: 'styles' },
                { name: 'colors' },
                { name: 'tools' },
            ],
        });
    }

    if ($("table#table").length && $("table .handle").length) {
        tableDragger(document.getElementById('table'), {
            mode: 'row',
            dragHandler: '.handle',
            onlyBody: true
        }).on('drop', function () {
            var sort_list = [];
            $("table#table tbody tr").each(function () {
                sort_list.push({id: $(this).data("id"), sort: $(this).index()})
            });
            $.post($('#table').data("url"), {sort: JSON.stringify(sort_list)}, function (data) {
                if (data === '0') {
                    $.notify(
                        {message: 'Error on save sort.'},
                        {type: 'success'}
                    );
                } else {
                    $.notify(
                        {message: 'Saved.'},
                        {type: 'success'}
                    );
                }
            });
        });
    }
});