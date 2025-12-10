jQuery(document).ready(function($) {
    const container = $('#job-results-wrapper');
    const resultsList = $('#job-results-list');
    const paginationArea = $('#job-pagination');
    const loadingOverlay = $('#job-loading-overlay');
    const filterForm = $('#job-filters-form');
    const resetButtonAll = $('#reset-all-filters');
    const filterSelects = $('.job-filter-select');

    function performAjaxFilter(paged = 1) {
        loadingOverlay.show();
        resultsList.css('opacity', 0.5);

        const regionVal = $('#region-filter').val();
        const departmentVal = $('#department-filter').val();
        const sectorVal = $('#sector-filter').val();

        $.ajax({
            url: jobAjax.ajaxurl,
            type: 'POST',
            data: {
                action: jobAjax.action,
                security: jobAjax.security,
                paged: paged,
                region: regionVal,
                department: departmentVal,
                sector: sectorVal
            },
            success: function(response) {
                if (response.success) {
                    resultsList.html(response.data.posts_html);
                    paginationArea.html(response.data.pagination_html);
                } else {
                    resultsList.html('<p class="no-results">Sorry, no jobs match your criteria.</p>');
                    paginationArea.empty();
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                resultsList.html('<p class="no-results">Failed to load jobs due to a network error.</p>');
                paginationArea.empty();
            },
            complete: function() {
                loadingOverlay.hide();
                resultsList.css('opacity', 1);
                $('html, body').animate({
                    scrollTop: container.offset().top - 50
                }, 500);
            }
        });
    }
    
    // --- NEW LOGIC: RESET BUTTONS ---
    
    function updateResetButtons() {
        let hasFilterSelected = false;

        filterSelects.each(function() {
            const selectElement = $(this);
            const resetBtn = selectElement.closest('.filter-dropdown-wrapper').find('.reset-single-filter');
            
            if (selectElement.val() !== '') {
                resetBtn.show();
                hasFilterSelected = true;
            } else {
                resetBtn.hide();
            }
        });

        if (hasFilterSelected) {
            resetButtonAll.show();
        } else {
            resetButtonAll.hide();
        }
    }

    filterForm.on('change', '.job-filter-select', function() {
        updateResetButtons(); 
        performAjaxFilter(1); 
    });
    
    filterForm.on('click', '.reset-single-filter', function() {
        const filterName = $(this).data('filter'); 
        const selectElement = $(`#${filterName}-filter`);
        
        selectElement.val(''); 
        selectElement.trigger('change'); 
    });

    resetButtonAll.on('click', function() {
        filterSelects.val(''); 
        
        updateResetButtons(); 
        performAjaxFilter(1); 
    });

    paginationArea.on('click', '.ajax-page-link', function(e) {
        e.preventDefault();
        
        const url = $(this).attr('href');
        const match = url.match(/paged=(\d+)/);
        const newPage = match ? parseInt(match[1]) : 1;
        
        if (newPage) {
            performAjaxFilter(newPage);
        }
    });
    
    updateResetButtons();

});