@php
    $data = $data ?? []; // pastikan $data selalu array, meskipun null
@endphp
<div class="row mb-3">
  <div class="col-lg-6 mb-3">
    <label class="form-label fw-semibold fs-6">Bride Name</label>
    <input type="text" name="event[bride_name]" class="form-control"
      placeholder="Masukkan nama mempelai wanita"
      value="{{ old('event.bride_name', $data['bride_name'] ?? '') }}">
  </div>

  <div class="col-lg-6 mb-3">
    <label class="form-label fw-semibold fs-6">Groom Name</label>
    <input type="text" name="event[groom_name]" class="form-control"
      placeholder="Masukkan nama mempelai pria"
      value="{{ old('event.groom_name', $data['groom_name'] ?? '') }}">
  </div>

  <div class="col-lg-6 mb-3">
    <label class="form-label fw-semibold fs-6">Wedding Date</label>
    <input type="date" name="event[wedding_date]" class="form-control"
      value="{{ old('event.wedding_date', $data['wedding_date'] ?? '') }}">
  </div>

  <div class="col-lg-6 mb-3">
    <label class="form-label fw-semibold fs-6">Venue</label>
    <input type="text" name="event[vanue]" class="form-control"
      placeholder="Masukkan lokasi acara"
      value="{{ old('event.vanue', $data['vanue'] ?? '') }}">
  </div>

  <div class="col-lg-6 mb-3">
    <label class="form-label fw-semibold fs-6">Maps</label>
    <input type="text" name="event[maps]" class="form-control"
      placeholder="Masukkan link Google Maps"
      value="{{ old('event.maps', $data['maps'] ?? '') }}">
  </div>
</div>
