@extends('admin.public.layout')
@section('content')
    <div>
        <img src="{{ URL::asset('images/admin/no-view.png') }}" style="margin: 0 auto;">
    </div>
@endsection
@push('footscripts')
    <script type="text/javascript">
        $(function () {
            layer.alert('暂无权限');
        });
    </script>
@endpush