@extends('layouts.app')

@section('full-content')
    <div class="row ">
        <h2>Добовление товара</h2>
        <div class="col-md-12 panel panel-default">
            <form class="row panel-body" action="{{ route('storehouse.orders.store') }}" method="POST" >
                @csrf

                <div class="col-md-12 row">
                    <div class="col-md-12 panel panel-primary">
                        <div class="row panel-body">
                            <div class="col-md-12">
                                <h4>{{ __('attributes.client') }}</h4>
                            </div>
                            <div class="col-md-12">
                                <label>{{ __('attributes.fio') }}</label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label>{{ __('attributes.city') }}</label>
                                <select name="client_city" class="form-control" required>
                                    <option value="Худжанд">Худжанд</option>
                                    <option value="Душанбе">Душанбе</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label>{{ __('attributes.phone_number') }}</label>
                                <input type="text" name="client_number" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}" onkeydown="if(event.key === 'Enter') { event.preventDefault(); this.blur(); }">
                    </div>
                    <div class="col-md-12">
                        <livewire:price-calculator />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>{{ __('attributes.comments') }}</label>
                        <textarea class="form-control" name="comments" rows="3">{{ old('comments') }}</textarea>
                    </div>
                </div>

                <div class="col-md-12 row">
                    <div class="col-md-2 mt-3">
                        <button type="submit" class="btn btn-success form-control">
                            {{ __('base.create') }}
                        </button>
                        @if(session('success'))
                        @endif
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
            document.getElementById('loadForm').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Предотвращаем действие по умолчанию (отправку формы)
                }
            });

            document.getElementById('submitButton').addEventListener('click', function () {
                document.getElementById('loadForm').submit(); // Запускаем отправку формы при клике на кнопку
            });
        });
    </script>
@endsection
