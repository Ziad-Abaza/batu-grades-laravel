@extends('/layout.interface')
@section('title')
BATU grades
@endsection
@section('content')
<form action="{{ route('view.grades') }}" method="post" >
    @csrf
    <div class="mb-4">
        <label for="department" class="block text-sm font-bold mb-2" style="color: #1b4a4a">Choose your department</label>
        <select name="department" id="department" value="{{old('department')}}" class="w-full p-2 border rounded-full text-white @error('department') is-invalid @enderror" style="background-color: #1b4a4a">
            <option value="null" disabled selected>Select your department</option>
            @foreach($departments as $department => $dep)
            <option style="width:100px;" value="{{ $department }}" {{ old('department') == $department ? 'selected' : '' }}>
                {{ $dep }}
                </option>
            @endforeach
        </select>
        <div style="height: 20px">
            @error('department')
            <p class="text-red-500 text-sm font-bold ">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="sitting_num" class="block text-sm font-bold mb-2" style="color: #1b4a4a">Sitting number</label>
        <input type="text" name="sitting_num" id="sitting_num" placeholder="Enter your sitting number" class="w-full p-2 border rounded-full text-white @error('sitting_num') is-invalid @enderror" style="background-color: #1b4a4a">
        <div style="height: 20px">
            @error('sitting_num')
            <p class="text-red-500 text-sm font-bold ">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <button type="submit" class=" text-white p-2 rounded-full px-4" style="background-color: #1b4a4a">Continue</button>
    </div>
</form>
@endsection

