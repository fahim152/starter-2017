@extends('layouts.master')

@section('title', $page_title)

@section('style_main')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>@lang('dashboard.dashboard_title.'.$titles)
                    <small></small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <div class="pull-right">
              @if(isset($bulk) and $bulk)
              <a href="{{ url($base_url . '/bulk-create') }}" class="btn green-meadow" style="margin-right: 10px"> <?= $icons ?> Bulk Creation </a>
              @endif
              @if(isset($create) and $create)
              <a href="{{ url($base_url . '/create') }}" class="btn green pull-right"> <?= $icon ?> </i>  @lang('dashboard.dashboard_title.'.$title) @lang('table.add')</a>
              @endif
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">@lang('dashboard.dashboard_title.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            @if(isset($middlePage))
            <li>
                <a href="{{ url($middlePage['url'])}}">{{$middlePage['title']}}</a>
                <i class="fa fa-circle"></i>
            </li>
            @endif
            <li>
                <span class="active">@lang('dashboard.dashboard_title.'.$title) </span>
            </li>
        </ul>

        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <?= $icons ?>
                    <span class="caption-subject sbold uppercase"> @lang('dashboard.dashboard_title.'.$title) </span>
                    <!-- For add word table beside title, add this line after title @lang('dashboard.dashboard_title.table') -->
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn default" href="javascript:;" data-toggle="dropdown">
                            <span class="hidden-xs"> @lang('dashboard.dashboard_title.saving_option') </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                            <li>
                                <a href="javascript:;" data-action="0" class="tool-action">
                                    <i class="icon-printer"></i> @lang('dashboard.dashboard_title.print')
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="1" class="tool-action">
                                    <i class="icon-check"></i> @lang('dashboard.dashboard_title.copy')
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="3" class="tool-action">
                                    <i class="icon-paper-clip"></i> @lang('dashboard.dashboard_title.excel')
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="4" class="tool-action">
                                    <i class="icon-cloud-upload"></i> @lang('dashboard.dashboard_title.csv')
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" data-action="5" class="tool-action">
                                    <i class="icon-refresh"></i>  @lang('dashboard.dashboard_title.reload')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                @if(isset($message) and !empty($message))
                    <div class="custom-alerts alert {{ $messageType }} fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <i class="fa-lg fa fa-success"></i> {{ $message }}
                    </div>
                @endif
                <div class="table-container">
                    <input type="hidden" name="table_ajax_url" id="table_ajax_url" value="{{ url($dataload_url)}}">
                    <input type="hidden" name="table_ajax_unsortable" id="table_ajax_unsortable" value="{{ isset($unsortable) ? $unsortable : 0 }}">
                    <table class="table table-striped table-bordered table-hover table-checkable" id="table_ajax_datatable">
                        <thead>
                            <tr role="row" class="heading">
                                @foreach ($columns as $key => $column)
                                @if(isset($column['width']))
                                    <th width='<?= $column['width'] ?>'> @lang('table.table_header.'.$column['title']) </th>
                                @else
                                    <th> <span class='title'> @lang('table.table_header.'.$column['title']) <?= isset($column['custom_html']) ? $column['custom_html'] : ''; ?></span> </th>
                                @endif
                                @endforeach
                            </tr>
                            @if(isset($filter) and $filter)
                            <tr role="row" class="filter">
                                @foreach ($columns as $key => $column)
                                <td><?= $column['filter'] ?></td>
                                @endforeach
                            </tr>
                            @endif
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>

@endsection

@section('script')
    <script src="{{ asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/datatable.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/table.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/form.js') }}" type="text/javascript"></script>
@endsection
