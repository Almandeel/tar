@extends('layouts.dashboard.app', ['datatable' => true])

@section('title')
    طلبات الوقود
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['طلبات الوقود'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title float-right">قائمة طلبات الوقود</h3>
            @if(!auth()->user()->hasRole('company'))
            @permission('oils-create')
                <a  href="{{ route('oils.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm float-left">
                    <i class="fa fa-plus"> اضافة</i>
                </a>
            @endpermission
            @endif
        </div> --}}
        <div id="app" class="card-body">
            <table style="width:100%" id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الطلب</th>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>نوع الوقود</th>
                        <th>العنوان</th>
                        <th>تاريخ الانشاء</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($oils as $index=>$oil)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $oil->id }}</td>
                            <td>{{ $oil->user->name }}</td>
                            <td>{{ $oil->user->phone }}</td>
                            <td>{{ $oil->type }}</td>
                            <td>{{ $oil->address }}</td>
                            <td>{{ $oil->created_at->format('Y-m-d H:I') }}</td>
                            <td>
                                @permission(['orders-read', 'orders-update'])
                                <div class="dropdown">
                                    <form style="display: inline-block" action="{{ route('oils.update', $oil->id) }}?type=accepted" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm" type="submit">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                    <form style="display: inline-block" action="{{ route('oils.update', $oil->id) }}?type=cancel" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $oils->appends(request()->all())->links() }}
            {{-- <order-component></order-component> --}}
        </div>
    </div>
@endsection

{{-- @push('js')
<script  src="{{ asset('js/app.js') }}"></script>
@endpush --}}
