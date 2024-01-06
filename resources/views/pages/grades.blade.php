@extends('layout.interface')
@section('title')
    View Grades
@endsection
@section('content')
    <div class="max-w-md mx-auto p-8 rounded-md ">
        @if(isset($studentResult))
            <p class="text-xl font-bold mb-4" style="color: #20474c">Name: {{ $studentResult['name'] }}</p>
            <p class="text-xl font-bold mb-4" style="color: #20474c">Sitting Number: {{ $studentResult['sitting_number'] }}</p>
            @if(isset($studentResult['grades']) && is_array($studentResult['grades']))
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-white" style="background-color:#20474c;">Subject</th>
                            <th class="px-4 py-2 text-white" style="background-color:#20474c;">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentResult['grades'] as $subject => $grade)
                            <tr>
                                <td class="border px-4 py-2 text-white bold" style="background-color: #b09f95;">{{ $subject }}</td>
                                <td class="border px-4 py-2 text-white bold" style="background-color: #b09f95;">{{ $grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-red-500">Grades not available.</p>
            @endif
        @else
            <p class="text-red-500">Student not found or grades not available.</p>
        @endif
    </div>
@endsection
