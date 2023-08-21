@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Filling KRS
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <div>
        <form method="post" action="{{ route('krs.post', $token)}}">
          <div class="card mb-3" style="border: 1px solid #d9dee3;">
              <h5 class="card-header">Fill your KRS</h5>
              <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped card-table">
                      <thead>
                          <tr>
                              <td></td>
                              <td>Kode</td>
                              <td>Mata Kuliah</td>
                              <td>SKS</td>
                              <td>Dosen</td>
                              <td>Hari</td>
                              <td>Ruangan</td>
                              <td>Waktu</td>
                              <td>Status</td>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($course as $key=>$c)    
                            <?php 
                                $date = strtotime($c['begin_time']);
                                $day = strftime("%A", $date);
                                $time = strftime("%H:%M", $date)
                            ?>
                            <tr class="table-dark">
                                <td><input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" /></td>
                                <td>{{$c['_class']['code']}}</td>
                                <td>{{$c['name']}}</td>
                                <td>{{$c['sks']}}</td>
                                <td>{{$c['teacher']['fullname']}}</td>
                                <td>{{$day}}</td>
                                <td>{{$c['room_name']}}</td>
                                <td>{{$time}}</td>
                                @if($c['capacity'] >= 1)
                                <td>Tersedia</td>
                                @endif
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              </div>
          </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
  </div>
</div>
@endsection