@include('admin.header')

@include('admin.aside')

<div class="main-panel">
    @include('admin.navbar')

    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

@include('admin.footer')

@if(isset($modals))
    @for ($i = 0; $i < count($modals); $i++)
        @include('dashboard.modals.' . $modals[$i])
    @endfor
@endif