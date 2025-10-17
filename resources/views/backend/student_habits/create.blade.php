@extends('skeleton')

@section('content')
<div class="container p-4">
    <div class="card card-flush h-md-100 p-4">
        <div class="card-header">
            <h3>📝 Isi Checklist Kebiasaan Hari Ini</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('pkm_student_habits.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Student</label>
                <input type="text" class="form-control" value="{{ $data['students']->student_name }}" readonly>
                <input type="hidden" name="student_id" value="{{ $data['students']->id }}">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kebiasaan</th>
                        <th>Ceklis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['habits'] as $habit)
                    <tr>
                        <td>{{ $habit->habit_name }}</td>
                        <td>
                            <input type="checkbox" name="habits[]" value="{{ $habit->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            <button class="btn btn-primary mt-3">Simpan Checklist</button>
        </form>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/components/globalValidation.js') }}"></script>