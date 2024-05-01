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
                            <h3 class="page-title mb-0 p-0">Tambah Transaksi</h3>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="col-12">
        <div class="card mt-2">
        <div class="card-body">
            <form action="{{ route('transaksi.simpan') }}" method="post">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="tanggal" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="searchInput" class="form-label">Cari Pasien</label>
                    <input type="text" class="form-control" id="searchInput" name="searchInput" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <input type="hidden" id="pasien_id" name="pasien_id">
                </div>
                <div class="mb-3">
                    <label for="no_reg" class="form-label">No Registrasi</label>
                    <input type="string" class="form-control" id="no_reg" name="no_registrasi">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">No Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="no_telepon" pattern="[0-9]{12,13}" title="Nomor telepon harus terdiri dari 12-13 digit angka">
                    <div class="form-text">Contoh: 081234567890 </div>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                </div>
                <div class="mb-3">
                    <label for="usia" class="form-label">Usia</label>
                    <input type="number" class="form-control" id="usia" name="usia" required>
                </div>
                <div class="mb-3">
                    <label for="tindakan" class="form-label">Tindakan</label>
                    <input type="number" class="form-control" id="tindakan" name="tindakan" required>
                </div>
                <div class="mb-3">
                    <label for="jasa_tindakan" class="form-label">Jasa Tindakan</label>
                    <input type="number" class="form-control" id="jasa_tindakan" name="jasa_tindakan" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="harga_obatobatan" class="form-label">Harga Obat</label>
                    <input type="number" class="form-control" id="harga_obatobatan" name="harga_obatobatan" required>
                </div> -->
                <div class="mb-3">
                    <label for="jasa_pemeriksaan_lain" class="form-label">BHP</label>
                    <input type="number" class="form-control" id="jasa_pemeriksaan_lain" name="jasa_pemeriksaan_lain" required>
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="total" name="total" required>
                </div>
                <div class="mb-3">
                    <label for="laba_bersih" class="form-label">Laba Bersih</label>
                    <input type="number" class="form-control" id="laba_bersih" name="laba_bersih" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
    document.getElementById('hiddenDate').value = today;
</script>

<script>
    window.onload = function() {

        document.getElementById('nama').value = '';
        document.getElementById('no_reg').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('usia').value = '';
        document.getElementById('jenis_kelamin').value = '';
        document.getElementById('jasa_tindakan').value = '';
        // document.getElementById('harga_obatobatan').value = '';
        document.getElementById('jasa_pemeriksaan_lain').value = '';
        document.getElementById('total').value = '';
        document.getElementById('laba_bersih').value = '';
        // Ajax request to fetch patient names
        fetch('/getPasiens')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('nama');
                data.forEach(patient => {
                    const option = document.createElement('option');
                    option.value = patient.id;
                    option.textContent = patient.nama;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching patients:', error));
    };
</script>

<script>
 document.getElementById('searchInput').addEventListener('input', function() {
    const query = this.value;

    if (query.trim() === '') {
        // Jika query kosong, kosongkan semua kolom dan buka kembali input
        document.getElementById('nama').value = '';
        document.getElementById('no_reg').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('jenis_kelamin').value = '';
        document.getElementById('pasien_id').value = '';
        


        // Atau lakukan tindakan lain yang sesuai dengan kebutuhan Anda
        return;
    }

    fetch(`/getPasienBySearch?query=${query}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('nama').value = data.nama || 'Data Tidak Ditemukan';
                document.getElementById('no_reg').value = data.no_registrasi || 'Data Tidak Ditemukan';
                document.getElementById('alamat').value = data.alamat || 'Data Tidak Ditemukan';
                document.getElementById('phone').value = data.no_telepon || 'Data Tidak Ditemukan';
                document.getElementById('jenis_kelamin').value = data.jenis_kelamin || 'Data Tidak Ditemukan';
                document.getElementById('pasien_id').value = data.id || '';

                // Kunci semua kolom
                document.getElementById('nama').setAttribute('readonly', 'readonly');
                document.getElementById('no_reg').setAttribute('readonly', 'readonly');
                document.getElementById('alamat').setAttribute('readonly', 'readonly');
                document.getElementById('phone').setAttribute('readonly', 'readonly');
                document.getElementById('jenis_kelamin').setAttribute('readonly', 'readonly');
                document.getElementById('pasien_id').setAttribute('readonly', 'readonly');
            } else {
                // Jika data tidak ditemukan, kosongkan semua kolom dan buka kembali input
                document.getElementById('nama').value = '';
                document.getElementById('no_reg').value = '';
                document.getElementById('alamat').value = '';
                document.getElementById('phone').value = '';
                document.getElementById('jenis_kelamin').value = '';
                document.getElementById('pasien_id').value = '';
                
                // Buka kembali input yang sebelumnya terkunci
                document.getElementById('nama').removeAttribute('readonly');
                document.getElementById('no_reg').removeAttribute('readonly');
                document.getElementById('alamat').removeAttribute('readonly');
                document.getElementById('phone').removeAttribute('readonly');
                document.getElementById('jenis_kelamin').removeAttribute('readonly');
                document.getElementById('pasien_id').removeAttribute('readonly');

                // Atau lakukan tindakan lain yang sesuai dengan kebutuhan Anda
            }
        })
        .catch(error => console.error('Error fetching patient:', error));
});

</script>


<!-- <script>
    
    document.getElementById('nama').addEventListener('change', function() {
    const patientId = this.value;
    fetch(`/getPasienDetails/${patientId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('alamat').value = data.alamat;
            document.getElementById('no_reg').value = data.no_registrasi;
            document.getElementById('phone').value = data.no_telepon;
            document.getElementById('jenis_kelamin').value = data.jenis_kelamin;
            document.getElementById('pasien_id').value = data.id;
            document.getElementById('nama').value = data.nama;
            // Isi bidang lain sesuai kebutuhan
        })
        .catch(error => console.error('Error fetching patient details:', error));
});
</script> -->

<script>
    // Ambil nilai dari input yang diperlukan
    const jasaTindakanInput = document.getElementById('jasa_tindakan');
    // const hargaObatInput = document.getElementById('harga_obatobatan');
    const jasaPemeriksaanInput = document.getElementById('jasa_pemeriksaan_lain');
    const totalInput = document.getElementById('total');
    const labaBersihInput = document.getElementById('laba_bersih');

    // Tambahkan event listener untuk setiap input
    [jasaTindakanInput, jasaPemeriksaanInput].forEach(input => {
        input.addEventListener('input', calculate);
    });

    // Fungsi untuk menghitung total harga dan laba bersih
    function calculate() {
        const jasaTindakan = parseFloat(jasaTindakanInput.value) || 0;
        // const hargaObat = parseFloat(hargaObatInput.value) || 0;
        const jasaPemeriksaan = parseFloat(jasaPemeriksaanInput.value) || 0;

        // Hitung total harga
        const totalHarga = jasaTindakan + jasaPemeriksaan;
        totalInput.value = totalHarga.toFixed(2);

        // Hitung laba bersih
        const labaBersih = jasaTindakan - jasaPemeriksaan;
        labaBersihInput.value = labaBersih.toFixed(2);
    }
</script>

@endsection
