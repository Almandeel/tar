    <!-- Modal -->
    <div class="modal fade" id="showOrder" tabindex="-1" role="dialog" aria-labelledby="showOrderLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="showOrderLabel"> طلب رقم <span class="id"></span></h4>
                </div>
                <div id="model-body" class="model-body">
                    <table style="margin-bottom:3%" class="table table-bordered table-hover text-center bm-4">
                        <thead>
                            <tr>
                                <th colspan="4">بيانات الطلب</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>اسم العميل</th>
                                <td class="name"></td>
                            </tr>
                            <tr>
                                <th>رقم الهاتف</th>
                                <td class="phone"></td>
                            </tr>
                            <tr>
                                <th>نوع الشحن</th>
                                <td class="type"></td>
                            </tr>
                            <tr>
                                <th>منطقة الشحن</th>
                                <td class="from"></td>
                            </tr>
                            <tr>
                                <th>منطقة التفريغ</th>
                                <td class="to"></td>
                            </tr>
                        </tbody>
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr><th colspan="4">تفاصيل الطلب</th></tr>
                                <tr>
                                    <th>النوع</th>
                                    <th>العدد</th>
                                </tr>
                            </thead>
                            <tbody id="items-container"></tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </div>


<script>

$('.show-order').click(function() {
    $('#items-container').html('')
    //set data to inputs
    $('#model-body  .id').text($(this).data('id'))
    $('#model-body  .name').text($(this).data('name'))
    $('#model-body  .phone').text($(this).data('phone'))
    $('#model-body  .type').text($(this).data('type'))
    $('#model-body  .from').text($(this).data('from'))
    $('#model-body  .to').text($(this).data('to'))

    let items = $(this).data('items')

    items.forEach(item => {
        let row = `
            <tr>
                <td>`+ item.type +`</td>
                <td>` + item.quantity + `</td>
            </tr>
        `
        $('#items-container').append(row)
    });
})
</script>