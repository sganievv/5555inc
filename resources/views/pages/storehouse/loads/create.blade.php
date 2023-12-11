@extends('layouts.app')

@section('full-content')
    <div class="row">
        <h3>Отгрузка</h3>
        <div class="col-md-12 panel panel-default">

            <form class="row panel-body" id="loadForm" action="{{ route('storehouse.loads.store') }}" method="POST" >
                @csrf

                <div class="col-md-6 row mb-3">
                    <div class="col-md-12">
                        <label>{{ __('attributes.car') }}</label>
                        <input type="text" name="car" class="form-control" required onkeydown="if(event.key === 'Enter') { event.preventDefault(); this.blur(); }">
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="storehouse_from_id" value="{{ request()->user()->getStorehouseId() }}">
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="storehouse_to_id" value="{{ request()->user()->getStorehouseId() + 1}}">
                    </div>
                </div>
                <div class="col-md-6 row">

                    <livewire:load-orders />
                </div>

                <div class="col-md-12 row">
                    <div class="col-md-2 mt-3">
                        <button type="button" class="btn btn-success form-control" id="submitButton">
                            {{ __('attributes.load') }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('submitButton').addEventListener('click', function () {
                if (confirm('Уверены, что хотите отгрузить эти товары?')) {
                    document.getElementById('loadForm').submit();
                }
            });
        });
    </script>
@endsection
