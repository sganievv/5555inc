<div>
    <select name="{{ $atrName }}" class="form-control">
        @if($isAdmin)
            <option value="">Выберите склад</option>
        @endif
        @foreach ($storehouses as $storehouse)
            <option value="{{ $storehouse->getId() }}" {{ $selectedId == $storehouse->getId() ? 'selected' : '' }}>
                {{ $storehouse->getName() }}
            </option>
        @endforeach
    </select>
</div>
