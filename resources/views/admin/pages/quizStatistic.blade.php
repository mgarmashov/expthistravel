@extends('vendor.backpack.base.layout')

@push('after_styles')
    <-- DATA TABLES -->
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
@endpush

@section('content')

    <div class="box">
        <div class="box-body overflow-hidden">
            <table id="table1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Session Id</th>
                    <th>User</th>
                    <th>Likes</th>
                    <th>Dislikes</th>
                    <th>Missed</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $sessionId => $actions)
                        <tr>
                            <td>{{ $sessionId }}</td>
                            <td></td>
                            <td>
                                @if(isset($actions['missed']))
                                    @foreach($actions['like'] as $activityId)
                                        @php($activity = $activities->firstWhere('id', $activityId))
                                        <img src="{{ asset(cropImage($activity->image, 50, 50)) }}" alt="{{ $activity->name }}" title="{{ $activity->name }}">
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if(isset($actions['missed']))
                                    @foreach($actions['dislike'] as $activityId)
                                        @php($activity = $activities->firstWhere('id', $activityId))
                                        <img src="{{ asset(cropImage($activity->image, 50, 50)) }}" alt="{{ $activity->name }}" title="{{ $activity->name }}">
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if(isset($actions['missed']))
                                    @foreach($actions['missed'] as $activityId)
                                        @php($activity = $activities->firstWhere('id', $activityId))
                                        <img src="{{ asset(cropImage($activity->image, 50, 50)) }}" alt="{{ $activity->name }}" title="{{ $activity->name }}">
                                    @endforeach
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Session Id</th>
                        <th>User</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                        <th>Missed</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@push('after_scripts')
    <!-- DATA TABLES SCRIPT -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#table1').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endpush