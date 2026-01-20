/* file: themes/your-theme-name/js/job-application.js */

jQuery(document).ready(function($) {
    const modal = $('#job-application-modal');
    const openBtn = $('#open-application-popup');
    const closeBtn = $('#close-application-popup');
    const form = $('#job-application-form');
    const messageContainer = $('#form-messages');
    const submitBtn = form.find('.btn-postuler-submit');
    const jobTitleElement = $('#modal-title');

    // 1. Mở Pop-up
    openBtn.on('click', function(e) {
        e.preventDefault();
        
        // Cập nhật tiêu đề cho Pop-up
        jobTitleElement.text('Candidature pour : ' + jobAppAjax.job_title);
        
        modal.fadeIn(300);
        $('body').addClass('modal-open');
    });

    // 2. Đóng Pop-up
    function closeModal() {
        modal.fadeOut(300);
        $('body').removeClass('modal-open');
        messageContainer.empty(); // Xóa thông báo cũ
        form[0].reset(); // Reset form
    }
    
    closeBtn.on('click', closeModal);
    $('.modal-overlay').on('click', closeModal);
    $(document).on('keyup', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // 3. Xử lý Submission Form (AJAX)
    form.on('submit', function(e) {
        e.preventDefault();
        messageContainer.html('<p style="color:#007bff;">Sending application...</p>');
        submitBtn.prop('disabled', true);

        // Sử dụng FormData để xử lý file upload
        const formData = new FormData(this);
        
        // Thêm Nonce và Action từ Localization
        formData.append('action', jobAppAjax.action);
        formData.append('security', jobAppAjax.security);

        $.ajax({
            url: jobAppAjax.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false, // BẮT BUỘC cho FormData (File Upload)
            contentType: false, // BẮT BUỘC cho FormData (File Upload)
            success: function(response) {
                if (response.success) {
                    messageContainer.html('<p style="color: green;">' + response.data.message + '</p>');
                    // Tùy chọn: Tự động đóng modal sau 3 giây
                    setTimeout(closeModal, 3000); 
                } else {
                    messageContainer.html('<p style="color: red;">Error: ' + response.data.message + '</p>');
                }
            },
            error: function() {
                messageContainer.html('<p style="color: red;">A server error occurred. Please try again.</p>');
            },
            complete: function() {
                submitBtn.prop('disabled', false);
            }
        });
    });
});
jQuery(document).ready(function ($) {
    $('.gdpr-title').on('click', function () {
        $(this).next('.gdpr-text').slideToggle(300);
        $(this).toggleClass('active');
    });
});
