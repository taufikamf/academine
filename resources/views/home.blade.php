@extends('layouts.layout')

@section('content')
<?php
// dd(json_decode(json_encode($nilai)));
?>
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
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-kelas" aria-controls="navs-pills-top-kelas" aria-selected="false">
            Kelas
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
              <h6 class="mb-0">{{$ipk}}</h6>
            </div>
          </div>
          <div class="me-2">
            <small class="text-muted d-block mb-1">NIM</small>
            <h6 class="mb-0">{{Auth::user()->nomor_identitas}}</h6>
          </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
              <?php
              // $nilai_user = \App\Models\Nilai::where('id_user', Auth::user()->id)->get(); 
              // $matkul_user = \App\Models\Matkul::where('id_user', Auth::user()->id)->get();
                // dd($nilai_user);
                // dd($nilai);
                // dd($matkul);
              ?>
              @foreach($matkul as $key=>$value)
              <?php
              ?>
                  <div class="accordion-item card">
                    <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$key}}" aria-controls="accordionIcon-1">
                        {{$value['matkul']['nama']}}
                      </button>
                    </h2>
                    <div id="accordion{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                      <div class="accordion-body">
                        <div class="table-responsive text-nowrap">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Kriteria</th>
                                <th>Nilai</th>
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                              @foreach ($value['nilai'] as $nilai)
                                  
                              <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $nilai->kriteria->nama }}</strong></td>
                                <td>{{$nilai->nilai}}</td>
                              </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="navs-pills-top-kelas" role="tabpanel">
        @foreach($kelas_joined as $key=>$value)
          <div class="accordion-item card mt-3 ">
            <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{$key}}" aria-controls="accordionIcon-1">
                {{$value->nama_kelas}}
              </button>
            </h2>
            <div id="accordion{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
              <div class="accordion-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Mata Pelajaran</th>
                        <th>Deskripsi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$value->mata_pelajaran}}</strong></td>
                        <td>{{$value->deskripsi}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
@if(Auth::user()->role != 3)
<h3 id="inline-text-elements" class="anchor-heading mb-4 fw-bold">Hi, {{Auth::user()->name}} !</h3>
<div class="col-xl-6 col-12 mb-4">
  <div class="card">
    <div class="card-header header-elements">
      <h5 class="card-title mb-0">Nilai Statistics</h5>
    </div>
    <div class="card-body">
      <canvas id="barChart" class="chartjs" data-height="500"></canvas>
    </div>
  </div>
</div>
<script src="{{ asset('assets/vendor/libs/chartjs/chart.js')}}"></script>
<script>
var nilai = <?php echo json_encode($nilai)?>;
var nilaiLength = <?php echo json_encode($nilaiLength)?>;
var arr = [];
for(var i = 1; i < nilaiLength+1; i++){
  arr.push(i);
}
console.log(arr)
const cyanColor = '#28dac6';
let borderColor, gridColor, tickColor;
const barChart = document.getElementById('barChart');
if (barChart) {
  const barChartVar = new Chart(barChart, {
    type: 'bar',
    data: {
      labels: arr,
      datasets: [
        {
          data: nilai,
          backgroundColor: cyanColor,
          borderColor: 'transparent',
          maxBarThickness: 15,
          borderRadius: {
            topRight: 15,
            topLeft: 15
          }
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 500
      },
      plugins: {
        tooltip: {
          backgroundColor: config.colors.white,
          titleColor: config.colors.black,
          bodyColor: config.colors.black,
          borderWidth: 1,
          borderColor: borderColor
        },
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          grid: {
            color: gridColor,
            borderColor: borderColor
          },
          ticks: {
            color: tickColor
          }
        },
        y: {
          min: 0,
          max: 100,
          grid: {
            color: gridColor,
            borderColor: borderColor
          },
          ticks: {
            stepSize: 10,
            tickColor: gridColor,
            color: tickColor
          }
        }
      }
    }
  });
}
</script>
@endif
@endsection
