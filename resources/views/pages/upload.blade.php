@extends('/layout.interface')
@section('title')
    Upload Grades
@endsection
@section('content')
    <div class="max-w-md mx-auto p-8 rounded-md ">
        <form action="{{route('store.file')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium " style="color: #20474c">department:</label>
                <select name="department" id="department" class="w-full p-2 rounded-full text-white" style="background-color: #20474c">
                    <option value="null" disabled selected>Select your department</option>
                    @foreach($departments as $department => $dep)
                        <option value="{{ $department }}">{{ $dep }}</option>
                    @endforeach
                </select>
                @error('department')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="csv_file" class="block text-sm font-medium " style="color: #20474c">Upload CSV File:</label>
                <input type="file" name="csv_file" id="csv_file" accept=".csv" required class=" p-2 w-full rounded-full text-white" style="background-color: #20474c">
                @error('csv_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full" style="background-color: #20474c">رفع الملف</button>
            </div>
        </form>
        @if(session('success'))
            <p class="text-green-500 mt-4">{{ session('success') }}</p>
        @endif
    </div>
@endsection
