@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    2021 A
  </div>
  <div class="card-body">
    <div class="accordion" id="accordionExample">
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
              Matkul
            </button>
          </h2>
          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item">Pemrograman Lanjut A</li>
                    <li class="list-group-item">Bahasa Arab A</li>
                  </ul>
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo" role="tabpanel">
              Mahasiswa
            </button>
          </h2>
          <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Pinda
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree" role="tabpanel">
              Tugas
            </button>
          </h2>
          <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Tugas 2
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour" role="tabpanel">
              Ujian
            </button>
          </h2>
          <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Ujian Akhir Semester
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection