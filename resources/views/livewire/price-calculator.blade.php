<div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label>{{ __('attributes.quantity') }}</label>
            <input wire:model="quantity" step="any" type="number" name="quantity" class="form-control" required>
        </div>

        <div class="col-md-12 mt-3 row">
            <div class="col-md-8">
                <label>{{ __('attributes.weight') }}</label>
                <input wire:model.live.debounce.1000ms="weight" step="any" type="number" name="weight" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>{{ __('attributes.unit') }}</label>
                <select name="unit" class="form-control" wire:model="unit" wire:change="changeUnit">
                    @foreach(config('constants.units') as $unitItem)
                        <option value="{{ $unitItem }}" {{ $unitItem == $unit ? 'selected' : '' }}>
                            {{ $unitItem }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <label>{{ __('attributes.price') }}</label>
            <input wire:model.live.debounce.1000ms="price" step="any" type="number" name="price" class="form-control" required>
        </div>

        <div class="col-md-12 mt-3">
            <label>{{ __('attributes.total') }}</label>
            <input wire:model="totalAmount" type="number" step="any" name="total_amount" class="form-control" required>
        </div>
    </div>
</div>
