@extends('skeleton')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="card-header">
                <h3 class="card-title">Edit Event</h3>
            </div>
            <div class="pt-6 card-body">
            @section('forms')
                <form action="{{ url('admin/' . Request::segment(2) . '/' . $event->id) }}" method="POST" id="editform"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Step Header -->
                    <div class="stepper-header d-flex justify-content-between mb-8">
                        <div class="stepper-item active" data-step="1">
                            <span class="stepper-number">1</span>
                            <span class="stepper-label">Event Information</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-item" data-step="2">
                            <span class="stepper-number">2</span>
                            <span class="stepper-label">Invitations Content</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-item" data-step="3">
                            <span class="stepper-number">3</span>
                            <span class="stepper-label">Event Schedules</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-item" data-step="4">
                            <span class="stepper-number">4</span>
                            <span class="stepper-label">Our Moment</span>
                        </div>
                        <div class="stepper-line"></div>
                        <div class="stepper-item" data-step="5">
                            <span class="stepper-number">5</span>
                            <span class="stepper-label">E-Gift</span>
                        </div>
                    </div>

                    <!-- Step Content -->
                    <div class="stepper-content">
                        <!-- STEP 1 -->
                        <div class="step-pane active" data-step="1">
                            @component('_components.event.event', [
                                'data' => $formData['event'] ?? [],
                            ])
                            @endcomponent
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                        <!-- STEP 2 -->
                        <div class="step-pane d-none" data-step="2">
                            @component('_components.event.content', [
                                'data' => $data['templates'],
                                'existingData' => $formData['content_invitations'] ?? [],
                            ])
                            @endcomponent
                            <button type="button" class="btn btn-light prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- STEP 3 -->
                        <div class="step-pane d-none" data-step="3">
                            @component('_components.event.event_schedules', [
                                'eventSchedules' => $formData['schedules'] ?? [],
                            ])
                            @endcomponent
                            <button type="button" class="btn btn-light prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- STEP 4 -->
                        <div class="step-pane d-none" data-step="4">
                            @component('_components.event.our_memories', [
                                'data' => [
                                    'name' => 'image_content',
                                    'label' => 'Our Moment',
                                    'value' => $formData['image_contents'] ?? [],
                                ],
                            ])
                            @endcomponent
                            <button type="button" class="btn btn-light prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- STEP 5 -->
                        <div class="step-pane d-none" data-step="5">
                            @component('_components.event.gift', [
                                'bankAccounts' => $data['bankAccounts'],
                                'existingData' => $formData['gift'] ?? [],
                            ])
                            @endcomponent
                            <button type="button" class="btn btn-light prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            @show
        </div>
    </div>
</div>
@endsection

@section('customjs')
{{-- <script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/custom/components/globalValidation.js') }}"></script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const steps = document.querySelectorAll(".stepper-item");
        const panes = document.querySelectorAll(".step-pane");

        function showStep(step) {
            // update header step
            steps.forEach(el => {
                el.classList.remove("active", "completed");
                let stepNum = parseInt(el.dataset.step);

                if (stepNum < step) {
                    el.classList.add("completed"); // step sebelumnya jadi completed
                } else if (stepNum === step) {
                    el.classList.add("active");
                }
            });

            // update konten step
            panes.forEach(el => {
                el.classList.add("d-none");
                if (parseInt(el.dataset.step) === step) el.classList.remove("d-none");
            });
        }

        // tombol next
        document.querySelectorAll(".next-step").forEach(btn => {
            btn.addEventListener("click", () => {
                let current = parseInt(document.querySelector(".stepper-item.active").dataset
                    .step);
                if (current < steps.length) showStep(current + 1);
            });
        });

        // tombol previous
        document.querySelectorAll(".prev-step").forEach(btn => {
            btn.addEventListener("click", () => {
                let current = parseInt(document.querySelector(".stepper-item.active").dataset
                    .step);
                if (current > 1) showStep(current - 1);
            });
        });

        // klik langsung header stepper
        steps.forEach(el => {
            el.addEventListener("click", () => {
                let targetStep = parseInt(el.dataset.step);
                showStep(targetStep);
            });
        });

        // inisialisasi di step 1
        showStep(1);
    });
</script>

<style>
    /* Stepper Header */
    .stepper-header {
        position: relative;
        align-items: center;
    }

    .stepper-item {
        text-align: center;
        flex: 1;
        position: relative;
        cursor: pointer;
        /* biar kelihatan bisa diklik */
    }

    .stepper-number {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background: #e4e6ef;
        color: #5e6278;
        font-weight: bold;
        transition: 0.3s;
    }

    .stepper-item.active .stepper-number {
        background: #0d6efd;
        color: #fff;
    }

    .stepper-item.completed .stepper-number {
        background: #198754;
        color: #fff;
    }

    .stepper-label {
        display: block;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 500;
    }

    .stepper-line {
        flex: none;
        width: 100%;
        max-width: 80px;
        height: 2px;
        background: #e4e6ef;
        margin: 0 10px;
        align-self: center;
        transition: 0.3s;
    }

    .stepper-item.completed~.stepper-line {
        background: #198754;
    }
</style>
@endsection
