@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {!! $title !!}
        <small>{{ isset($subtitle) ? $subtitle : '' }}</small>
    </h1>
@endsection

@section('content')

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>

                <div class="box-tools pull-right">
                    <div class="pull-right mb-10 hidden-sm hidden-xs">
                        @foreach ($box_link as $element)
                            {{$element}}
                        @endforeach
                    </div><!--pull right-->
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="col-xs-12">
                  @foreach ($data as $element)
                    {{$element}}
                  @endforeach
                </div>

            </div><!-- /.box-body -->
        </div><!--box-->
@stop

@section('after-scripts')
    @parent
@stop
