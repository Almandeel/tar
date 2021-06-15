@extends('admin.master')
@section('title')
الرئيسية
@endsection
@section('content')


@role('superadmin')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">pending_actions</i>
                        
                    </div>
                    <p class="card-category"> الجديدة</p>
                    <h3 class="card-title">{{ $new }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{ route('orders.index') }}?status=new"><i class="material-icons">update</i> عرض</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">store</i>
                    </div>
                    <p class="card-category"> الموافق عليها</p>
                    <h3 class="card-title">{{ $accepted }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{ route('orders.index') }}?status=accepted"><i class="material-icons">update</i> عرض</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <p class="card-category"> الجارية</p>
                    <h3 class="card-title">{{ $run }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{ route('orders.index') }}?status=run"><i class="material-icons">update</i> عرض</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <p class="card-category"> المكتملة</p>
                    <h3 class="card-title">{{ $done }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{ route('orders.index') }}?status=done"><i class="material-icons">update</i> عرض</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="">

    <h5 class="mt-4 mb-2"></h5>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">الطلبات الجديدة</span>
                    <span class="info-box-number">{{ $order_default }}</span>

    </div>
    <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-bookmark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">الطلبات الجارية</span>
                <span class="info-box-number">{{ $order_in_road }}</span>

            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="far far fa-thumbs-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">الطلبات المكتملة</span>
                <span class="info-box-number">{{ $order_done }}</span>

            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    </div>

    <h5 class="mt-4 mb-2"></h5>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">كل الشركات </span>
                    <span class="info-box-number">{{ $companies }}</span>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">كل المستخدمين </span>
                    <span class="info-box-number">{{ $users }}</span>

                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    </div> --}}
@endrole

@endsection
