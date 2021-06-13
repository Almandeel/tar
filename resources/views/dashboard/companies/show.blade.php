@extends('admin.master', ['datatable' => true, 'modals' => ['payment', 'user_company']])

@section('title')
    الشركات  | كشف حساب
@endsection

@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ['الشركات', 'كشف حساب'])
        @slot('url', [route('companies.index'), '#'])
        @slot('icon', ['list', 'eye'])
    @endcomponent --}}
    <div class="card">
        <div class="card-header card-header-danger">
            <h4>البيانات</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <td>{{ $company->name }}</td>
                        <th>رقم الهاتف</th>
                        <td>{{ $company->phone }}</td>
                    </tr>
                    <tr>
                        <th>مدين</th>
                        <td>{{ number_format($debt) }}</td>
                        <th>دائن</th>
                        <td>{{ number_format($cridet) }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">الصافي</th>
                        <td colspan="2">{{ number_format($cridet - $debt) }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-danger">
            <h4>
                قائمة الدفعات
                @permission('payments-create')
                    <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-white text-dark btn-sm float-left payment" data-company="{{ $company->id }}" data-toggle="modal" data-target="#paymentModal">
                        <i class="fa fa-plus"> اضافة دفعة</i>
                    </button>
                @endpermission
            </h4>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>القيمة</th>
                        <th>التفاصيل</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enteries as $index=>$entry)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $entry->amount }}</td>
                            <td>{{ $entry->details }}</td>
                            <td>{{ $entry->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-danger">
            <h4>
                قائمة المستخدمين
                <button 
                    data-company="{{ $company->id }}" 
                    data-fcm="{{ $company->users->first()->fcm_token }}" 
                    data-toggle="modal" data-target="#companyUserModal" 
                    class="btn btn-white text-dark btn-sm float-left company-user"><i class="fa fa-user-plus"></i> اضافة مستخدم</button>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @permission('companies-update')
                                    <form style="display:inline-block" action="{{ route('users.update', $user->id) }}?type=status" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-{{ $user->status ? 'danger' : 'success' }} btn-xs" type="submit"><i class="fa fa-{{ $user->status ? 'times' : 'check' }}"></i> {{$user->status ? 'الغاء التفعيل' : 'تفعيل' }} </a>
                                    </form>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
