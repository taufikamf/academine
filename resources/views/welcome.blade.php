@extends('layouts.layout')

@section('content')

@if( Auth::user()->role == 3 )
<div class="col-xl-6">
    <h6 class="text-muted">Info Mahasiswa</h6>
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
            Profile
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
            Akademik
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
          <h3>{{Auth::user()->name}}</h3>
          <div class="d-flex w-100 mb-3 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <small class="text-muted d-block mb-1">Email</small>
              <h6 class="mb-0">{{Auth::user()->email}}</h6>
            </div>
            <div class="user-progress d-flex align-items-center gap-1">
                <span class="text-muted">IPK : </span>
              <h6 class="mb-0">3.5</h6>
            </div>
          </div>
          <div class="me-2">
            <small class="text-muted d-block mb-1">NIM</small>
            <h6 class="mb-0">{{Auth::user()->nomor_identitas}}</h6>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
                <div class="accordion-item card">
                  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                      Accordion Item 1
                    </button>
                  </h2>

                  <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                    <div class="accordion-body">
                      Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                      marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                      soufflé. Wafer gummi bears marshmallow pastry pie.
                    </div>
                  </div>
                </div>

                <div class="accordion-item card">
                  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconTwo">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-2" aria-controls="accordionIcon-2">
                      Accordion Item 2
                    </button>
                  </h2>
                  <div id="accordionIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                    <div class="accordion-body">
                      Pinda
                    </div>
                  </div>
                </div>

                <div class="accordion-item card active">
                  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionIcon-3" aria-expanded="true" aria-controls="accordionIcon-3">
                      Accordion Item 3
                    </button>
                  </h2>
                  <div id="accordionIcon-3" class="accordion-collapse collapse show" data-bs-parent="#accordionIcon">
                    <div class="accordion-body">
                      Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                      gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                      dragée caramels. Ice cream wafer danish cookie caramels muffin.
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endif

@endsection
