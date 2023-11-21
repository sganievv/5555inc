<div>
    <select name="{{ $atrName }}" class="form-control">
        @foreach ($users as $user)
            <option value="{{ $user->getId() }}" {{ $selectedId == $user->getId() ? 'selected' : '' }}>
                {{ sprintf('%s / %s', $user->getName(), $user->getPhoneNumber()) }}
            </option>
        @endforeach
    </select>
</div>
