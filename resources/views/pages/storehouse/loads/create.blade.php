@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <h3>Отгрузка</h3>
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('storehouse.loads.store') }}" method="POST" >
                @csrf

                <div class="col-md-6 row mb-3">
                    <div class="col-md-12">
                        <label>{{ __('attributes.car') }}</label>
                        <input type="text" name="car" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="storehouse_from_id" value="{{ request()->user()->getStorehouseId() }}">
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="storehouse_to_id" value="{{ request()->user()->getStorehouseId() + 1}}">
                    </div>
                </div>

                <div class="col-md-6 row">
                    <div class="col-md-12">
                        <livewire:load-orders />
                    </div>
                </div>

                <div class="col-md-12 row">
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-success form-control">
                            {{ __('attributes.load') }}
                            @if(session('success'))
                            @endif
                        </button>
                    </div>
                    <div class="col-md-2 mt-3">
                        <a href="{{ route('home') }}" class="btn btn-warning form-control">
                            {{ __('nav.back') }}
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
