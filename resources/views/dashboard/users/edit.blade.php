@extends('admin.master', ['datatable' => true])

@section('title')
  تعديل
@endsection


@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">
@endpush



@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ['المستخدمين', $user->username ,'تعديل'])
        @slot('url', [route('users.index'), route('users.show', $user->id), '#'])
        @slot('icon', ['users', 'user', 'edit'])
    @endcomponent --}}
<form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        تعديل
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              
                              <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="الاسم" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="رقم الهاتف" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              
                              <input type="email" class="form-control" name="email" value="{{ $user->email }}" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              
                              <input id="password" type="password" class="form-control" name="password" placeholder="@lang('users.password')">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                  
                                  <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('users.password_confirmation')" data-parsley-equalto="#password">
                          </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="form-group">
                              <label>الحالة</label>
                              <select name="status" class="form-control">
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>@lang('users.deactive')</option>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>@lang('users.active')</option>
                              </select>
                          </div> --}}
                        </div>

                      </div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="row">
                      {{-- <div class="col-md-6">
                          <label>
                              <input type="radio" name="next" value="back" checked="true">
                              <span>@lang('users.save_and_add_new')</span>
                          </label>
                          <label>
                              <input type="radio" name="next" value="list">
                              <span>@lang('users.save_and_back')</span>
                          </label>
                      </div> --}}
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary btn-submit"> حفظ</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>


            <div class="col-md-12">

              <div class="accordion " id="accordionExample">
                <div class="card text-right">
                  <div class="card-header text-right" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @lang('users.roles')
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <div class="row">
                        @foreach ($roles as $role)
                          <div class="col-md-3">
                            <div class="form-check" dir="ltr">
                              <label class="form-check-label">
                                {{ $role->name }}
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                <span class="form-check-sign">
                                  <span class="check"></span>
                                </span>
                              </label>
                            </div>
                        </div>
                      @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion" id="permissions">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#permission" aria-expanded="true" aria-controls="permission">
                        @lang('users.permissions')
                      </button>
                    </h2>
                  </div>
              
                  <div id="permission" class="collapse show" aria-labelledby="headingOne" data-parent="#permissions">
                    <div class="card-body">
                      <table id="users-table" class="table table-bordered table-hover text-left" dir="rtl">
                        <thead>
                          <tr>
                            <th>@lang('users.permission') </th>
                            <th>@lang('users.permission')</th>
                            <th>@lang('users.permission')</th>
                            <th>@lang('users.permission')</th>
                          </tr>
                        </thead>
                        @php $missing_col = count($permissions) % 4 @endphp
                        @php $col = 4 - $missing_col @endphp
                        @foreach ($permissions as $index=>$permission)
                          @if($index % 4 == 0 )
                            <tr>
                          @endif
                          @if( ( count($permissions) - ($index) ) > $missing_col  )
                            <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    {{ $permission->display_name}}
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" >
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                  </label>
                                </div>
                                {{-- <label>
                                  {{ $permission->display_name  }}
                                  <input type="checkbox" id="{{ $permission->id }}" class="icheckbox_square-green {{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                </label> --}}
                            </td>
                          @else
                          @if($missing_col == 1)
                            @for ($i = 0; $i < $col; $i++)
                                <td>
                                  <label>-</label>
                                </td>
                            @endfor
                          @endif
                          @if($missing_col > 0)
                            <td>
                              <label>
                                {{ $permission->display_name  }}
                                <input type="checkbox" id="{{ $permission->id }}" class="icheckbox_square-green {{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                              </label>
                            </td>
                            @php $missing_col-- @endphp
                          @endif

                          @endif
                            @if($index + 1 % 4 == 0)
                              </tr>
                            @endif
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add </button> --}}


              {{-- <div class="card card-solid">
                <div class="card-header with-border">
                  <h3 class="card-title">@lang('users.roles_and_permissions')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="card-group" id="accordion">
                    <div class="panel card card-primary">
                      <div class="card-header with-border">
                        <h4 class="card-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body text-left">
                          
                        </div>
                      </div>
                    </div>
                    <div class="panel card card-danger">
                      <div class="card-header with-border">
                        <h4 class="card-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="card-body">
                          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <!-- /.card-body -->
              </div> --}}
              <!-- /.card -->
          </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
            </div>
        </div>
    </form>
@endsection
{{-- @include('partials._select2') --}}




@include('partials._select2')
