
<select name="upazila" id="upazila">
    <option disabled selected>Select Upazila</option>
    @if (!empty($upazilas))
        @foreach ($upazilas as $upazila)
            <option value="{{ $upazila['id'] }}">{{ $upazila['name'] }}</option>
        @endforeach
    @endif
    @if (!empty($userDistrict))
        @foreach ($userDistrict->upazilas as $upazila)
            <option value="{{ $upazila->id }}" {{ !empty($userInfo['upazila']) && $userInfo->upazila == $upazila->id ? 'selected' : '' }}>{{ $upazila->name }}</option>
        @endforeach
    @endif
 </select>
