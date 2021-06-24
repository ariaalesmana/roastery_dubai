<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/pace-progress/pace.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/@coreui/coreui-pro/dist/js/coreui.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('assets/node_modules/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/ample/plugins/bower_components/moment/moment.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/jquery-wizard-master/jquery.steps.min.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('assets/ample/plugins/bower_components/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@toastr_js
@toastr_render
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }

    function showAlertSubmit(title, message, form, condition) {
        var html = `<div style="z-index:9999999;padding:0;margin:0;">
                        <div class="modal-dialog modal-xl modal-primary" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">`+title+`</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            `+message+`
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="tutupSwal" class="btn btn-danger float-right">Tutup</button>`;
                                if(condition) {
        html +=                     `<button id="submitSwal" class="btn btn-success float-right">Ya</button>`;
                                }
        html +=                 `</div>
                            </div>
                        </div>
                    </div>`;
        Swal.fire({
            customClass: 'swal-wide-small',
            html: html,
            onOpen: function() {
                $('#tutupSwal').click(function() {
                    swal.close(); return false;
                });
                $('#submitSwal').click(function() {
                    form.submit();
                });
            },
            showCancelButton: false,
            showConfirmButton: false
        })
    }
</script>