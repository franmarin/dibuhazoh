(function(window, document, undefined) {

	'use strict';

    var init = function () {

        $(document).ready(function() {

            // Set up Masonry grid
            var $grid = $('#grid');
            $grid.masonry({
                itemSelector: '.grid-item',
                columnWidth: '#grid-sizer',
                percentPosition: true
            });

            // Load first batch of dibuhazoh
            loadMoreDibuhazoh();

            // Set scroll event handler
            $(window).scroll(loadMoreDibuhazohIfScrollReachesBottom);

            // Set click event handler for link to load more dibuhazoh manually
            $('.next').click(function() {
                loadMoreDibuhazoh();
            });

            // Set click event handler for dibuhazoh search filter
            $('ul.filter li').click(function() {

                // Scroll up
                window.scrollTo(0, 0);

                // Reset filters from the same group
                $(this).siblings().removeClass('selected');

                // Set selected filter
                var $this = $(this);
                $this.addClass('selected');

                // Clean grid
                $grid.masonry('remove', $grid.find('.grid-item')).masonry();

                // Reset dibuhazoh's counter
                $('.next').attr('id', '0');

                // Hide end text just in case it was displayed in a previous load
                $('#end').hide();

                // Reload grid
                loadMoreDibuhazoh(0);

            });

        });
    },

    timeout,

    getSearchFiltersAsUrlParameters = function() {
        var filters = '';
        $('.selected').each(function() {
            var $this = $(this),
                filterValue = $this.text();
            filterValue = sanitizeFilterValue(filterValue);
            if (filterIsSet(filterValue)) {
                filters += $this.parent().attr('id') + '=' + filterValue + '&';
            }
        });
        return filters;
    },

    sanitizeFilterValue = function(filterValue) {
        if (filterValue.indexOf('Tod') !== -1) {
            return null;
        } else if (filterValue === 'Sí') {
            return 1;
        } else if (filterValue === 'No') {
            return 0;
        }
        return filterValue;
    },

    filterIsSet = function(filterValue) {
        return filterValue !== null;
    },

    loadMoreDibuhazohIfScrollReachesBottom = function(){
        if (isLoading()) {
            return;
        }
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            var heightMargin = 100,
                $window = $(window);
            if ($window.scrollTop() + $window.height() >= $(document).height() - heightMargin) {
                loadMoreDibuhazoh();
            }
        }, 50);
    },

    isLoading = function() {
        return $('#spinner-container').is(':visible');
    },

    loadMoreDibuhazoh = function() {

        if (noMoreDibuhazohToLoad()) {
            $('#spinner-container').hide();
            $('#end').show();
            return;
        }

        $('#spinner-container').show();

        var url = getDibuhazohUrl();
        $.get(url, function(jsonData, status) {
            var data = JSON.parse(jsonData);
            updatePageContent(data);
        });
    },

    updatePageContent = function(data) {
        var $spinner = $('#spinner-container'),
            $nextLink = $('div.next'),
            $grid = $('#grid');

        // No dibuhazoh returned
        if ($.isEmptyObject(data.dibuhazoh)) {
            $spinner.hide();
            $nextLink.hide();
            $nextLink.attr('id', '-1');
            $('#end').show();
            return;
        }

        // Server-side exception
        if ('exception' in data) {
            return;
        }

        // Set total dibuhazoh
        $('#total-dibuhazoh').text(data.total  + ' dibuhazoh');

        var html = '';
        for (var i in data.dibuhazoh) {
            html += getGridItemHTML(data.dibuhazoh[i]);
        }

        // Append new dibuhazoh (grid-items)
        var $html = $(html);
        $grid.append($html).imagesLoaded(function() {
            var from = $('.next').attr('id'),
                maxBatchItems = $('#max-batch-items').val();

            $grid.masonry('appended', $html);
            $html.css('visibility', 'visible');

            // Set next index to get dibuhazoh from
            $nextLink.attr('id', parseInt(from) + parseInt(maxBatchItems));

            // Hide spinner and show link to load more dibuhazoh manually
            $spinner.fadeOut('slow');
            $('.next').show();
        });
    },

    getGridItemHTML = function(dataItem) {
        var html = '<div class="grid-item">';
        if (dataItem.image !== '') {
            html += '<img src="' + dataItem.image + '"/>';
        }
        html += '<p>' + dataItem.name + '</p>';
        html += '<p class="year">' + dataItem.year + '</p>';
        html += '<p class="producer">' + dataItem.producer + '</p>';
        if (dataItem.youtube !== '') {
            html += '<p class="youtube"><a href="' + dataItem.youtube + '">Ver en YouTube</a></p>';
        }
        html += '</div>';
        return html;
    },

    noMoreDibuhazohToLoad = function() {
        return $('.next').attr('id') === '-1';
    },

    getDibuhazohUrl = function() {
        var from = $('.next').attr('id'),
            filters = getSearchFiltersAsUrlParameters(),
            url = './src/dibuhazoh_provider.php?from=' + from + '&' + filters;
        return encodeURI(url);
    };
    
    init();

})(window, document);