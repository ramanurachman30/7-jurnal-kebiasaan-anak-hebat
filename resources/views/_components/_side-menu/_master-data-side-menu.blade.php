@if (Auth::allowedUri('organizations.list') ||
        Auth::allowedUri('provinces.list') ||
        Auth::allowedUri('p_k_m_grades.list') ||
        Auth::allowedUri('p_k_m_habits.list') ||
        Auth::allowedUri('p_k_m_students.list') ||
        Auth::allowedUri('p_k_m_student_habits.list') ||
        Auth::allowedUri('p_k_m_student_habits.list'))
    <div class="pt-5 menu-item">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">{{ __('Master Data') }}</span>
        </div>
    </div>

    @if (Auth::allowedUri('p_k_m_grades.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/p_k_m_grades') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Master Kelas') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif

    @if (Auth::allowedUri('p_k_m_habits.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/p_k_m_habits') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Master 7 Kebiasaan Anak Hebat') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    @if (Auth::allowedUri('p_k_m_students.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/p_k_m_students') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Master Siswa') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    {{-- @if (Auth::allowedUri('p_k_m_student_habits.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/p_k_m_student_habits') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Rekap Jurnal Harian Siswa') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif --}}
@endif
