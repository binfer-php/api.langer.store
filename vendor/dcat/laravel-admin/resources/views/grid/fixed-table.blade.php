<div class="dcat-box custom-data-table dt-bootstrap4">
    @if ($grid->allowToolbar())
        <div class="custom-data-table-header">
            <div class="table-responsive">
                <div class="top d-block clearfix p-0">
                    @if(!empty($title))
                        <h4 class="pull-left" style="margin:5px 10px 0;">
                            {!! $title !!}&nbsp;
                            @if(!empty($description))
                                <small>{!! $description!!}</small>
                            @endif
                        </h4>
                        <div class="pull-right" data-responsive-table-toolbar="{{$tableId}}">
                            {!! $grid->renderTools() !!} {!! $grid->renderCreateButton() !!} {!! $grid->renderExportButton() !!}  {!! $grid->renderQuickSearch() !!}
                        </div>
                    @else
                        {!! $grid->renderTools() !!}  {!! $grid->renderQuickSearch() !!}

                        <div class="pull-right" data-responsive-table-toolbar="{{$tableId}}">
                            {!! $grid->renderCreateButton() !!} {!! $grid->renderExportButton() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {!! $grid->renderFilter() !!}

    {!! $grid->renderHeader() !!}

    <div class="table-responsive table-wrapper">
        <div class="tables-container">
            <div class="table-wrap table-main" data-height="{{ $tableHeight }}">
                <table class="custom-data-table dataTable {{ $grid->formatTableClass() }}" id="{{ $tableId }}">
                    <thead>
                    @if ($headers = $grid->getComplexHeaders())
                        <tr>
                            @foreach($headers as $header)
                                {!! $header->render() !!}
                            @endforeach
                        </tr>
                    @endif
                    <tr>
                        @foreach($grid->columns() as $column)
                            <th {!! $column->formatTitleAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                        @endforeach
                    </tr>
                    </thead>

                    @if ($grid->hasQuickCreate())
                        {!! $grid->renderQuickCreate() !!}
                    @endif

                    <tbody>
                    @foreach($grid->rows() as $row)
                        <tr {!! $row->rowAttributes() !!}>
                            @foreach($grid->getColumnNames() as $name)
                                <td {!! $row->columnAttributes($name) !!}>
                                    {!! $row->column($name) !!}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    @if ($grid->rows()->isEmpty())
                        <tr>
                            <td colspan="{!! count($grid->getColumnNames()) !!}">
                                <div style="margin:5px 0 0 10px;"><span class="help-block" style="margin-bottom:0"><i class="feather icon-alert-circle"></i>&nbsp;{{ trans('admin.no_data') }}</span></div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            @if ($grid->leftVisibleColumns()->isNotEmpty() || $grid->leftVisibleComplexColumns()->isNotEmpty())
                <div class="table-wrap table-fixed table-fixed-left" data-height="{{ $tableHeight }}">
                    <table class="custom-data-table dataTable {{ $grid->formatTableClass() }} ">
                        <thead>

                        @if ($grid->getComplexHeaders())
                            <tr>
                                @foreach($grid->leftVisibleComplexColumns() as $header)
                                    {!! $header->render() !!}
                                @endforeach
                            </tr>
                            <tr>
                            @foreach($grid->leftVisibleComplexColumns() as $header)
                                @if ($header->getColumnNames()->count() > 1)
                                    @foreach($header->columns() as $column)
                                        <th {!! $column->formatTitleAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                                    @endforeach
                                @endif
                            @endforeach
                            </tr>
                        @else
                            <tr>
                                @foreach($grid->leftVisibleColumns() as $column)
                                    <th {!! $column->formatTitleAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                                @endforeach
                            </tr>
                        @endif
                        </thead>
                        <tbody>

                        @foreach($grid->rows() as $row)
                            <tr {!! $row->rowAttributes() !!}>
                                @foreach($grid->leftVisibleColumns() as $column)
                                    <td {!! $row->columnAttributes($column->getName()) !!}>
                                        {!! $row->column($column->getName()) !!}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($grid->rightVisibleColumns()->isNotEmpty() || $grid->rightVisibleComplexColumns()->isNotEmpty())
                <div class="table-wrap table-fixed table-fixed-right" data-height="{{ $tableHeight }}">
                    <table class="custom-data-table dataTable {{ $grid->formatTableClass() }} ">
                        <thead>
                        @if ($grid->getComplexHeaders())
                            <tr>
                                @foreach($grid->rightVisibleComplexColumns() as $header)
                                    {!! $header->render() !!}
                                @endforeach
                            </tr>
                            <tr>
                            @foreach($grid->rightVisibleComplexColumns() as $header)
                                @if ($header->getColumnNames()->count() > 1)
                                    @foreach($header->columns() as $column)
                                        <th {!! $column->formatTitleAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                                    @endforeach
                                @endif
                            @endforeach
                            </tr>
                        @else
                            <tr>
                                @foreach($grid->rightVisibleColumns() as $column)
                                    <th {!! $column->formatTitleAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                                @endforeach
                            </tr>
                        @endif

                        </thead>

                        <tbody>

                        @foreach($grid->rows() as $row)
                            <tr {!! $row->rowAttributes() !!}>
                                @foreach($grid->rightVisibleColumns() as $column)
                                    <td {!! $row->columnAttributes($column->getName()) !!}>
                                        {!! $row->column($column->getName()) !!}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {!! $grid->renderFooter() !!}

    @if ($paginator = $grid->paginator())
        <div class="box-footer clearfix " style="padding-bottom:5px;">
            {!! $paginator->render() !!}
        </div>
    @else
        <div class="box-footer clearfix text-80 " style="height:48px;line-height:25px;">
            @if ($grid->rows()->isEmpty())
                {!! trans('admin.pagination.range', ['first' => '<b>0</b>', 'last' => '<b>'.$grid->rows()->count().'</b>', 'total' => '<b>'.$grid->rows()->count().'</b>',]) !!}
            @else
                {!! trans('admin.pagination.range', ['first' => '<b>1</b>', 'last' => '<b>'.$grid->rows()->count().'</b>', 'total' => '<b>'.$grid->rows()->count().'</b>',]) !!}
            @endif
        </div>
    @endif
</div>
