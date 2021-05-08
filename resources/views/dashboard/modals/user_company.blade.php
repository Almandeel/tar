    <!-- Modal -->
    <div class="modal fade" id="companyUserModal" tabindex="-1" role="dialog" aria-labelledby="companyUserModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="companyUserModalLabel">اضافة مستخدم</h4>
                </div>
                <form id="form_user_company" action="{{ route('companies.user') }}" method="post">
                    @csrf 
                    <div class="modal-body">

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="الاسم" required>
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="number" class="form-control" name="phone" placeholder="رقم الهاتف" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>

$('.company-user').click(function() {

    $('#form_user_company input[name="fcm_token"]').remove()
    $('#form_user_company input[name="company_id"]').remove()

    $('#form_user_company').append(`<input type="hidden" name="company_id" value="`+ $(this).data('company') +`">`)
    $('#form_user_company').append(`<input type="hidden" name="fcm_token" value="`+ $(this).data('fcm') +`">`)            
})
</script>