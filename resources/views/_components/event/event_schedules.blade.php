@php
    $eventSchedules = old('event_schedules', $eventSchedules ?? [
        ['title' => '', 'description' => '', 'event_time' => '']
    ]);
@endphp

<div class="d-flex flex-column">
  <div class="mx-4 p-3">
    <div id="event-schedule-repeater">
      @foreach ($eventSchedules as $index => $schedule)
        <div class="event-schedule-item mb-4 border-bottom pb-3">
          <div class="row">
            
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold fs-6">Judul Acara</label>
              <input type="text"
                     name="event_schedules[{{ $index }}][title]"
                     class="form-control"
                     placeholder="Masukkan judul acara"
                     value="{{ old("event_schedules.$index.title", $schedule['title'] ?? '') }}">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold fs-6">Waktu</label>
              <input type="time"
                     name="event_schedules[{{ $index }}][event_time]"
                     class="form-control"
                     value="{{ old("event_schedules.$index.event_time", $schedule['event_time'] ?? '') }}">
            </div>

            <div class="col-12 mb-3">
              <label class="form-label fw-semibold fs-6">Deskripsi Acara</label>
              <textarea name="event_schedules[{{ $index }}][description]"
                        class="form-control"
                        rows="2"
                        placeholder="Masukkan deskripsi acara">{{ old("event_schedules.$index.description", $schedule['description'] ?? '') }}</textarea>
            </div>

            <div class="col-12 text-end">
              <button type="button" class="btn btn-danger btn-sm" onclick="removeScheduleItem(this)">Hapus</button>
            </div>

          </div>
        </div>
      @endforeach
    </div>

    <div class="text-start mt-2">
      <button type="button" class="btn btn-primary btn-sm" onclick="addScheduleItem()">+ Tambah Acara</button>
    </div>
  </div>
</div>

<script>
  function addScheduleItem() {
    const container = document.getElementById('event-schedule-repeater');
    const index = container.children.length;
    const item = `
      <div class="event-schedule-item mb-4 border-bottom pb-3">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold fs-6">Judul Acara</label>
            <input type="text" name="event_schedules[${index}][title]" class="form-control" placeholder="Masukkan judul acara">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold fs-6">Waktu</label>
            <input type="time" name="event_schedules[${index}][event_time]" class="form-control">
          </div>
          <div class="col-12 mb-3">
            <label class="form-label fw-semibold fs-6">Deskripsi Acara</label>
            <textarea name="event_schedules[${index}][description]" class="form-control" rows="2" placeholder="Masukkan deskripsi acara"></textarea>
          </div>
          <div class="col-12 text-end">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeScheduleItem(this)">Hapus</button>
          </div>
        </div>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', item);
  }

  function removeScheduleItem(button) {
    button.closest('.event-schedule-item').remove();
  }
</script>
