@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['company']])

@section('title')
    الشركات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الشركات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('companies-create')
                <div class="row">
                    <div class="col-md-6">
                        <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left company" data-toggle="modal" data-target="#CompanyModal">
                            <i class="fa fa-user-plus"> اضافة</i>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <form style="display:inline-block" action="#" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="بحث" aria-label="بحث" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endpermission
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>العنوان</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->address }}</td>
                            <td>
                                @permission('enteries-read')
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> كشف حساب</a>
                                @endpermission
                                @permission('companies-update')
                                    <button class="btn btn-warning btn-xs company update " data-toggle="modal" data-target="#CompanyModal" data-action="{{ route('companies.update', $company->id) }}" data-name="{{ $company->name }}" data-phone="{{ $company->phone }}" data-address="{{ $company->address }}"><i class="fa fa-edit"></i> تعديل </button>
                                    <form style="display:inline-block" action="{{ route('users.update', $company->users->first()->id) }}?type=status" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-{{ $company->users->first()->status ? 'danger' : 'success' }} btn-xs" type="submit"><i class="fa fa-{{ $company->users->first()->status ? 'times' : 'check' }}"></i> {{$company->users->first()->status ? 'الغاء التفعيل' : 'تفعيل' }} </a>
                                    </form>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $companies->links() }}
        </div>
    </div>
@endsection
