<select name="union" id="union">
    <option disabled selected>Select Union</option>
    @if (!empty($unions))
        @foreach ($unions as $union)
            <option value="{{ $union['id'] }}">{{ $union['name'] }}</option>
        @endforeach
    @endif
    @if (!empty($userUpazila))
        @foreach ($userUpazila->unions as $union)
            <option value="{{ $union->id }}" {{ !empty($userInfo['unions']) && $userInfo->unions == $union->id ? 'selected' : '' }}>{{ $union->name }}</option>
        @endforeach
    @endif
 </select>
