@extends('layouts.app')

@section('full-content')
    <div class="row">
        <button id="showSearchForm" class="btn btn-sm btn-group-sm btn-primary">
            <i class="glyphicon glyphicon-search"></i>
            Поиск
        </button>

        <form action="{{ route('storehouse.loads.index') }}" class="row panel-body" method="get" id="searchForm" style="display: none;">
            <div class="col-md-2">
                <label>{{ __('attributes.id') }}</label>
                <input type="text" name="id" class="form-control" value="{{ request()->input('id') }}">
            </div>

            <div class="col-md-2 col-xs-6">
                <label >&nbsp;</label>
                <button type="submit" class="form-control btn btn-sm btn-group-sm btn-primary">
                    <i class="glyphicon glyphicon-filter"></i>
                    {{ __('base.filter') }}
                </button>
            </div>

            <div class="mt-5 col-md-2 col-xs-6">
                <a href="{{ route('storehouse.loads.index') }}" class="btn btn-default form-control">
                    <i class="glyphicon glyphicon-remove"></i>
                    {{ __('base.reset') }}
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#showSearchForm").click(function () {
                $("#searchForm").toggle();
            });
        });
    </script>

    <div class="row panel-body">
        <div class="row panel panel-default">
            <div class="col-md-12 mt-4">
                {{ $loads->appends(request()->all())->links() }}
            </div>
            <div class="table-responsive col-md-12">
                <table class="table table-hover">
                    <tr>
                        <th>{{ __('attributes.car') }}</th>
                        <th>{{ __('attributes.from_storehouse') }}</th>
                        <th>{{ __('attributes.to_storehouse') }}</th>
                        <th>{{ __('attributes.date') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    @foreach($loads as $load)
                        @if(auth()->check() && in_array(auth()->user()->storehouse_id, [1, 2]) && $load->relationStorehouseFrom && $load->relationStorehouseFrom->getId() == 2)
                            @continue
                        @endif

                        <tr>
                            <td>
                                @if(auth()->check() && auth()->user()->storehouse_id == 1)
                                    <a href="{{ route('storehouse.loads.edit', $load->getId()) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        {{ $load->getCar() }}
                                    </a>
                                @else
                                    <a href="{{ route('storehouse.loads.show', $load->getId()) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                        {{ $load->getCar() }}
                                    </a>
                                @endif
                            </td>

                            <td>{{ optional($load->relationStorehouseFrom)->getName() }}</td>
                            <td>{{ optional($load->relationStorehouseTo)->getName() }}</td>

                            <td>{{ $load->getCreatedAt() }}</td>

                            <td>
                                <form action="{{ route('storehouse.loads.release', $load->getId()) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    @if(auth()->check() && auth()->user()->storehouse_id !=1)
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Отпустить?')">
                                            {{ __('Отпустить') }}
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-md-12 mt-4">
                {{ $loads->appends(request()->all())->links() }}
            </div>
        </div>
    </div>

    <div class="col-md-12 row">
        <div class="col-md-2 mt-3">
            <a href="{{ route('home') }}" class="btn btn-warning form-control">
                {{ __('nav.back') }}
            </a>
        </div>
    </div>
    </div>
@endsection
