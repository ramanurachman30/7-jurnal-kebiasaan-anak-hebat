@extends('skeleton')

@section('content')
<style>
    body {
        background-color: #fef9e7;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background-color: #fff8dc;
        border-radius: 20px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }

    .card-header{
        padding: 19px 2.25rem !important;
    }

    .card-header h3 {
        color: #ff7f50;
        font-weight: bold;
        text-align: center;
        font-size: 1.8rem;
    }

    .form-label {
        font-size: 1.1rem;
        color: #444;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #ffd700;
        font-size: 1rem;
        padding: 10px;
    }

    .table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: #ffcc5c;
        color: #333;
        text-align: center;
        font-size: 1.1rem;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #fff6d5;
    }

    .table tbody tr:hover {
        background-color: #fff2a8;
        transition: 0.3s;
    }

    td {
        font-size: 1rem;
        vertical-align: middle !important;
    }

    input[type="checkbox"] {
        width: 25px;
        height: 25px;
        accent-color: #ff7f50;
        cursor: pointer;
        transform: scale(1.2);
    }

    .btn-primary {
        background-color: #ff7f50;
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-size: 1.2rem;
        font-weight: bold;
        color: white;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #ff9966;
        transform: scale(1.05);
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card {
            padding: 1rem;
        }

        .card-header h3 {
            font-size: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
        }

        td, th {
            font-size: 0.95rem;
        }

        input[type="checkbox"] {
            width: 22px;
            height: 22px;
        }

        .btn-primary {
            font-size: 1.1rem;
            padding: 10px 20px;
        }

        .table thead {
            font-size: 1rem;
        }

        /* Table responsive wrap */
        .table-responsive {
            overflow-x: auto;
            border-radius: 10px;
        }
    }

    @media (max-width: 480px) {
        .card-header h3 {
            font-size: 1.3rem;
        }

        td, th {
            font-size: 0.9rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }
</style>

<div class="container p-4">
    <div class="card card-flush h-auto p-4">
        <div class="card-header">
            <h3>📝 Isi Checklist Kebiasaan Hari Ini</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('p_k_m_student_habits.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">👧 Nama Siswa</label>
                    <input type="text" class="form-control" value="{{ $data['student']->student_name }}" readonly>
                    <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">📅 Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>Kebiasaan 😊</th>
                                <th>Ceklis ✅</th>
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
                </div>

                <button class="btn btn-primary mt-3">💾 Simpan Checklist</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/components/globalValidation.js') }}"></script>