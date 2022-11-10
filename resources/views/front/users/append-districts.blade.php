<select name="district" id="district">
    <option  disabled selected>Select District</option>
    @if (!empty($districts))
        @foreach ($districts as $district)
            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
        @endforeach
    @endif
    @if (!empty($userDivision))
        @foreach ($userDivision->districts as $district)
            <option value="{{ $district->id }}" {{ !empty($userInfo['district']) && $userInfo->district == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
        @endforeach
    @endif
 </select>
