(function () {
    const ext_triggers = document.querySelectorAll('.external-trigger');
    ext_triggers.forEach(a => {
        a.addEventListener('click', function () {
            const target_panel = this.getAttribute('data-target-panel');
            document.getElementById(target_panel).click();
        })
    });

    const file_upload_btn = document.getElementById('file-upload-btn');

    if (file_upload_btn) {
        file_upload_btn.onclick = function () {
            const file_input = document.getElementById('file-upload-input');
            file_input.click();
            file_input.addEventListener('change', function () {
                const selected_file = document.getElementById('selected-file-name');
                selected_file.textContent = truncate(this.files[0].name, 60);
                selected_file.closest('div').classList.remove('d-none');
            });
        };
    }

    function truncate(str, maxlength) {
        return (str.length > maxlength) ?
            str.slice(0, maxlength - 1) + '…' : str;
    }

    const select_destination_modal = document.getElementById('select_destination_modal');
    const select_origin_modal = document.getElementById('select_origin_modal');

    document.querySelectorAll('.open-sel-dest-modal').forEach(function (e) {
        e.addEventListener('click', function () {
            select_destination_modal.addEventListener('shown.bs.modal', event => {
                const form = document.getElementById('select_destination_form');
                const url = form.getAttribute('data-submit-url');
                form.action = url + '/reserve/' + e.getAttribute('data-schedule-id');
            })
        });
    })

    document.querySelectorAll('.open-sel-origin-modal').forEach(function (e) {
        e.addEventListener('click', function () {
            select_origin_modal.addEventListener('shown.bs.modal', event => {
                const form = document.getElementById('select_origin_form');
                const url = form.getAttribute('data-submit-url');
                form.action = url + '/reserve/' + e.getAttribute('data-schedule-id');
            })
        });
    })
})();