@extends('partial.main')

@section('content')
<div class="page-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Edit Data Pasien</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Data Pasien</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-4 align-self-center">
                        <div class="text-end upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-success d-none d-md-inline-block text-white" target="_blank">Upgrade to
                                Pro</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <div class="container-fluid">
    <div class="col-12">
<form action="{{ route('data_pasien.update', $pasien->id) }}" method="post">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="date" class="form-label">Tanggal</label>
    <input type="date" class="form-control" id="date" name="tanggal" aria-describedby="emailHelp" value="{{ $pasien->tanggal }}" required>
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name" name="nama" value="{{ $pasien->nama }}" required>
  </div>
  <div class="mb-3">
    <label for="no_reg" class="form-label">No Registrasi</label>
    <input type="string" class="form-control" id="no_reg" name="no_registrasi" value="{{ $pasien->no_registrasi }}" required>
  </div>
  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pasien->alamat }}"  required>
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">No Telepon</label>
    <input type="tel" class="form-control" id="phone" name="no_telepon" pattern="[0-9]{12,13}" title="Nomor telepon harus terdiri dari 12-13 digit angka" value="{{ $pasien->no_telepon }}" required>
    <div class="form-text">Contoh: 081234567890 </div>
  </div>
  <div class="mb-3">
    <label class="form-label" >Jenis Kelamin</label>
    <div>
      <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" {{ $pasien->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }} required>
      <label for="laki-laki">Laki-laki</label>
    </div>
    <div>
      <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" {{ $pasien->jenis_kelamin === 'perempuan' ? 'checked' : '' }} required>
      <label for="perempuan">Perempuan</label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
<!-- <script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementById('date').value = today;
  document.getElementById('hiddenDate').value = today;
</script> -->

@endsection