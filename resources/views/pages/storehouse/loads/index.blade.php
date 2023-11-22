@extends('layouts.app')

@section('full-content')
    <div class="row">
        <div class="col-md-12 panel panel-primary">
            <form action="{{ route('storehouse.loads.index') }}" class="row panel-body" method="get">
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

        <div class="col-md-12">
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
                            <tr>
                                <td>
                                    <a href="{{ route('storehouse.loads.show', $load->getId()) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    {{ $load->getCar() }}
                                    </a>
                                </td>
                                <td>{{ $load->relationStorehouseFrom->getName() }}</td>
                                <td>{{ $load->relationStorehouseTo->getName() }}</td>
                                <td>{{ $load->getCreatedAt() }}</td>
                                <td>
                                    @if(auth()->check() && auth()->user()->storehouse_id !=2)
                                        <a href="{{ route('storehouse.loads.edit', $load->getId()) }}">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                            {{ __('base.edit') }}
                                        </a>
                                    @endif

                                </td>
                                <td>

                                    <form action="{{ route('storehouse.loads.release', $load->getId()) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Отпустить?')">
                                            {{ __('Отпустить') }}
                                        </button>
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
