@extends('admin.master')

@section('title')
    الطلبات | تعديل
@endsection

@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ['الطلبات' , 'تعديل'])
        @slot('url', [route('orders.index'),'#'])
        @slot('icon', ['list', 'edit'])
    @endcomponent --}}
    <div class="card">
        <div class="card-header card-header-danger">
            <h3 class="card-title">تعديل طلب</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="order_type">نوع الشحن</label>
                    </div>
                    <select class="custom-select" name="order_type"  id="order_type">
                        <option id="none" value="">نوع الشحن</option>
                        <option id="container" value="حاويات" {{ $order->type == 'حاويات' ? 'selected' : '' }}> حاويات</option>
                        <option id="goods" value="بضائع" {{ $order->type == 'بضائع' ? 'selected' : '' }}> بضائع</option>
                        <option id="cars" value="مركبات" {{ $order->type == 'مركبات' ? 'selected' : '' }}> مركبات</option>
                        <option id="cars" value="وقود" {{ $order->type == 'وقود' ? 'selected' : '' }}> وقود</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input type="text" name="name" class="form-control"  value="{{ $order->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="number" name="phone" class="form-control"  value="{{ $order->phone }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>منطقة الشحن</label>
                            <input type="text" name="from" class="form-control" value="{{ $order->from }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>منطقة التفريغ</label>
                            <input type="text" name="to" class="form-control" value="{{ $order->to }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>تاريخ الشحن</label>
                            <input type="date" name="shipping_date" class="form-control" value="{{ $order->shipping_date }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم المخلص</label>
                            <input type="text" name="savior_name" value="{{ $order->savior_name }}" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="savior_phone"> رقم هاتف المخلص</label>
                            <input type="number" id="savior_phone" name="savior_phone" value="{{ $order->savior_phone }}" class="form-control" >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <table id="table-items" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>العدد</th>
                                <th>الوزن</th>
                                <th>الوحدة</th>
                                <th>نوع العربة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index=>$item)
                                <tr>
                                    <td>
                                        <select class="custom-select form-control"  name="item_type[]">
                                            <option value="حاوية 20 قدم" {{ $item->type == 'حاوية 20 قدم' ? 'selected' : '' }}>حاوية 20 قدم</option>
                                            <option value="حاوية 40 قدم" {{ $item->type == 'حاوية 40 قدم' ? 'selected' : '' }}>حاوية 40 قدم</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control" placeholder="العدد" value="{{ $item->quantity }}">
                                    </td>
                                    <td>
                                        <input type="number" name="weight[]" class="form-control" placeholder="الوزن" value="{{ $item->weight }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    <button id="add-items" class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus"></i>اضافة</button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>حفظ التعديلات</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="application/javascript">
        let container = 
        `
        <tr>
            <td>
                <select class="custom-select form-control"  name="item_type[]">
                    <option value="حاوية 20 قدم">حاوية 20 قدم</option>
                    <option value="حاوية 40 قدم">حاوية 40 قدم</option>
                </select>
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        `

        let goods = 
        `
        <tr>
            <td>
                <input type="text" name="item_type[]" class="form-control" placeholder="البضاعة">
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
            <td>
                <input type="text" name="unit[]" class="form-control" placeholder="الوحدة">
            </td>
            <td>
                <select class="custom-select form-control"  name="car_type[]">
                    <option value="شبك">شبك</option>
                    <option value="سطحة">سطحة</option>
                </select>
            </td>
        </tr>
        `

        let cars = 
        `
        <tr>
            <td>
                <input type="text" name="item_type[]" class="form-control" placeholder="المركبة">
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        `

        let oil = 
        `
        <tr>
            <td>
                <select class="custom-select form-control"  name="item_type[]">
                    <option value="بنزين">
                        بنزين
                    </option>
                    <option value="جازولين">
                        جازولين
                    </option>
                </select>
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        `

        $('#add-items').click(function () {
            let order_type = $('#order_type').val()

            switch (order_type) {
                case 'حاويات':
                    $('#table-items tbody').append(container)
                    break;
                case 'بضائع':
                    $('#table-items tbody').append(goods)
                    break;
                case 'مركبات':
                    $('#table-items tbody').append(cars)
                    break;

                case 'وقود':
                    $('#table-items tbody').append(oil)
                    break;
                default:
                    alert('اختار نوع الشحن')
                    break;
            }
        })
    </script>
@endpush
