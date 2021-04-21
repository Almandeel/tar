@extends('layouts.dashboard.app', ['datatable' => true , 'modals' => ['show_order']])

@section('title')
    الطلبات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-right">قائمة الطلبات</h3>
            @if(!auth()->user()->hasRole('company'))
            @permission('orders-create')
                <a  href="{{ route('orders.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm float-left">
                    <i class="fa fa-plus"> اضافة</i>
                </a>
            @endpermission
            @endif
        </div>
        <div id="app" class="card-body table-responsive">
            <table style="width:100%" id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الطلب</th>
                        @role(['superadmin', 'services'])
                        {{-- <th>الاسم</th> --}}
                        <th>رقم الهاتف</th>
                        @endrole
                        <th>نوع الشحن</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index=>$order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            @role(['superadmin', 'services'])
                            {{-- <td>{{ $order->name }}</td> --}}
                            <td>{{ $order->phone }}</td>
                            @endrole
                            <td>{{ $order->type }}</td>
                            <td>
                                @if($order->status == \App\Order::ORDER_DEFAULT)
                                    في الانتظار
                                @endif
                                @if($order->status == \App\Order::ORDER_ACCEPTED)
                                    تمت الموافقة
                                @endif
                                @if($order->status == \App\Order::ORDER_IN_SHIPPING)
                                    في الشحن
                                @endif
                                @if($order->status == \App\Order::ORDER_IN_ROAD)
                                    في الطريف
                                @endif
                                @if($order->status == \App\Order::ORDER_DONE)
                                    تم التسليم
                                @endif
                                @if($order->status == \App\Order::ORDER_CANCEL)
                                    تم الالغاء
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:I') }}</td>
                            <td>
                                @permission(['orders-read', 'orders-update'])
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        المزيد
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        @permission('orders-read')
                                            <li>
                                                <a
                                                    href="#" 
                                                    style="display:inline-block; margin-left:1%"
                                                    class="dropdown-item show-order" 
                                                    data-toggle="modal" 
                                                    data-target="#showOrder"
                                                    data-id="{{ $order->id }}"
                                                    data-name="{{ $order->name }}"
                                                    data-phone="{{ $order->phone }}"
                                                    data-type="{{ $order->type }}"
                                                    data-from="{{ $order->from }}"
                                                    data-to="{{ $order->to }}"
                                                    data-items="{{ $order->items }}"
                                                    >
                                                    <i class="fa fa-eye"> نظرة سريعة</i>
                                                </a>
                                            </li>
                                        @endpermission
                                        @permission('orders-read')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('orders.show', $order->id) }}">
                                                    <i class="fa fa-eye"> عرض</i>
                                                </a>
                                            </li>
                                        @endpermission
                                        @permission('orders-update')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('orders.edit', $order->id) }}">
                                                    <i class="fa fa-edit"> تعديل</i>
                                                </a>
                                            </li>
                                        @endpermission
                                    </ul>
                                </div>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->appends(request()->all())->links() }}
            {{-- <order-component></order-component> --}}
        </div>
    </div>
@endsection

{{-- @push('js')
<script  src="{{ asset('js/app.js') }}"></script>
@endpush --}}
