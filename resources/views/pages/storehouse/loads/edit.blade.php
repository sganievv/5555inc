@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" action="{{ route('storehouse.loads.update', $load->getId()) }}" method="POST" >
                @csrf
                @method('put')

                <div class="col-md-6 row mb-5">
                    <div class="col-md-12">
                        <label>{{ __('attributes.car') }}</label>
                        <input type="text" name="car" class="form-control" required value="{{ $load->getCar() }}">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.from_storehouse') }}</label>
                        <livewire:storehouses-select :atrName="'storehouse_from_id'" :selectedId="$load->getStorehouseFromId()"/>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.to_storehouse') }}</label>
                        <livewire:storehouses-select :atrName="'storehouse_to_id'" :selectedId="$load->getStorehouseToId()"/>
                    </div>
                </div>

                <div class="col-md-6 row">
                    <div class="col-md-12">
                        <livewire:load-orders :items="$items"/>
                    </div>
                </div>

                <div class="col-md-12 row">
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-primary form-control">
                            {{ __('base.save') }}
                        </button>
                    </div>

                    <div class="col-md-2 mt-3">
                        <a href="{{ route('storehouse.loads.index') }}" class="btn btn-warning form-control">
                            {{ __('nav.back') }}
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
