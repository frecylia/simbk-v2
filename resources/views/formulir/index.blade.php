@extends('layouts.admin.app')
@section('content')
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="main-content">
                    <form id="peminatan-form" action="{{route('minat-bakat.store')}}" method="POST" class="bg-white p-4 rounded shadow-sm" onsubmit="return confirm('Apakah Anda yakin ingin mengirim formulir ini?');">
                        @csrf
                        <div class="text-center mb-5">
                            <h1 class="text-primary">FORMULIR TES PEMINATAN KEJURUAN</h1>
                            <h2 class="text-secondary h3">MAN 1 Bandung</h2>
                            <p class="fw-bold">Tahun Ajaran 2025/2026</p>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fa fa-check-circle me-2"></i>
                                <div>
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fa fa-exclamation-triangle me-2"></i>
                                <div>
                                    {{ Session::get('error') }}
                                </div>
                            </div>
                        @endif
                        
                        
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white"><h2 class="mb-0 h4">DATA PRIBADI</h2></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="nama" class="form-label">Nama Lengkap:</label>
                                            <input type="text" id="nama" name="nama" required value="{{ Auth::user()->name }}" class="form-control @error('nama') is-invalid @enderror">
                                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="nis" class="form-label">Nomor Induk Siswa:</label>
                                            <input type="text" id="nis" name="nis" required value="{{ Auth::user()->nis }}" class="form-control @error('nis') is-invalid @enderror" readonly>
                                            @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" id="email" name="email" required value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror">
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="telepon" class="form-label">No. Telepon/HP:</label>
                                            <input type="text" id="no_telp" name="no_telp" required value="{{ Auth::user()->no_telp }}" placeholder="Masukan Nomor Handphone" class="form-control number-only @error('no_telp') is-invalid @enderror">
                                            @error('no_telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="{{ Auth::user()->tanggal_lahir }}"  class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Contoh: Bandung, 17 Agustus 2009">
                                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                   <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kelamin:</label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-Laki" required {{ Auth::user()->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="laki_laki">
                                                        Laki-laki
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="perempuan">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            @error('jenis_kelamin') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat:</label>
                                            <input type="text" id="alamat" name="alamat" required value="{{ Auth::user()->alamat }}" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukan Alamat">
                                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white"><h2 class="mb-0 h4">RIWAYAT PENDIDIKAN & PEMINATAN JURUSAN</h2></div>
                            <div class="card-body">
                                <p class="alert alert-info"><em>Untuk Urutkan pilihan jurusan dari 1-3 sesuai minat Anda (1 = pilihan tertinggi). Peringkat tidak boleh sama.</em></p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="asal_smp" class="form-label">Asal SMP:</label>
                                                    <input type="text" id="asal_smp" name="asal_smp" required value="{{ old('asal_smp') }}" class="form-control @error('asal_smp') is-invalid @enderror" placeholder="Masukan Asal SMP">
                                                    @error('asal_smp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label for="nilai_rapor" class="form-label">Nilai Rata-rata Rapor Kelas 9:</label>
                                                    <input type="number" id="nilai_rapor" name="nilai_rapor" min="0" max="100" step="0.01" required value="{{ old('nilai_rapor') }}" class="form-control @error('nilai_rapor') is-invalid @enderror" placeholder="Masukan Nilai Rata-rata Rapor Kelas 9">
                                                    @error('nilai_rapor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                         
                                                <div class="form-group">
                                                    <label for="prestasi" class="form-label">Prestasi Akademik/Non-Akademik:</label>
                                                    <textarea id="prestasi" name="prestasi" class="form-control @error('prestasi') is-invalid @enderror" placeholder="Masukan Prestasi Akademik/Non-Akademik">{{ old('prestasi') }}</textarea>
                                                    @error('prestasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="rank_ipa" class="form-label">Peringkat IPA (Ilmu Pengetahuan Alam)</label>
                                                    <select id="rank_ipa" name="rank_ipa" min="1" max="3" required value="{{ old('rank_ipa') }}" class="form-control rank-select @error('rank_ipa') is-invalid @enderror">
                                                        <option value="">Pilih Peringkat</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    @error('rank_ipa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="rank_ips" class="form-label">Peringkat IPS (Ilmu Pengetahuan Sosial)</label>
                                                    <select id="rank_ips" name="rank_ips" min="1" max="3" required value="{{ old('rank_ips') }}" class="form-control rank-select @error('rank_ips') is-invalid @enderror">
                                                        <option value="">Pilih Peringkat</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    @error('rank_ips') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="rank_bahasa" class="form-label">Peringkat Bahasa</label>
                                                    <select id="rank_bahasa" name="rank_bahasa" min="1" max="3" required value="{{ old('rank_bahasa') }}" class="form-control rank-select @error('rank_bahasa') is-invalid @enderror">
                                                         <option value="">Pilih Peringkat</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    @error('rank_bahasa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                                <div id="rank-error" class="text-danger mt-2 fw-bold" style="display: none;">
                                                    <i class="fa fa-exclamation-triangle me-2"></i>Peringkat tidak boleh ada yang sama.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h2 class="mb-0 h4">TES KEMAMPUAN DASAR</h2>
                            </div>
                            <div class="card-body">
                                <p class="alert alert-info"><i class="fa fa-info-circle me-2"></i>Selesaikan soal di setiap kategori. Anda dapat berpindah kategori dengan menekan tab di atas atau menggunakan tombol navigasi di bawah.</p>

                                {{-- Navigasi Tab --}}
                                <ul class="nav nav-tabs" id="soalTab" role="tablist">
                                    @foreach ($kategoriSoal as $kategori)
                                        <li class="nav-item " role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                    id="tab-{{ $kategori->id }}" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#konten-{{ $kategori->id }}" 
                                                    type="button" 
                                                    role="tab" 
                                                    aria-controls="konten-{{ $kategori->id }}" 
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}" style="color: #090808 !important">
                                                {{ $kategori->nama_kategori }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                                {{-- Konten Tab --}}
                                <div class="tab-content" id="soalTabContent">
                                    @php($nomor = 1)
                                    @foreach ($kategoriSoal as $kategori)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                            id="konten-{{ $kategori->id }}" 
                                            role="tabpanel" 
                                            aria-labelledby="tab-{{ $kategori->id }}">
                                            
                                            {{-- Card di dalam tab untuk konsistensi visual --}}
                                            <div class="card border-0">
                                                <div class="card-body px-0 py-4">
                                                    @foreach ($kategori->soal as $soal)
                                                    <div class="question mb-4">
                                                        <p class="fw-bold">{!! $nomor . '. ' . $soal->pertanyaan !!}</p>
                                                        <div class="radio-group">
                                                            @foreach ($soal->pilihanJawaban as $pilihan)
                                                            <div class="form-check">
                                                                <input class="form-check-input" 
                                                                    type="radio" 
                                                                    name="jawaban[{{ $soal->id }}]" 
                                                                    id="pilihan-{{ $pilihan->id }}" 
                                                                    value="{{ $pilihan->id }}"
                                                                    {{ old('jawaban.'.$soal->id) == $pilihan->id ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="pilihan-{{ $pilihan->id }}">
                                                                    {!! $pilihan->teks_pilihan !!}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        @error('jawaban.' . $soal->id)
                                                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    @php($nomor++)
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                {{-- Tombol Navigasi Antar Tab --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" id="btn-prev-tab"><i class="fa fa-arrow-left me-2"></i> Sebelumnya</button>
                                    <button type="button" class="btn btn-info" id="btn-next-tab">Berikutnya <i class="fa fa-arrow-right ms-2"></i></button>
                                </div>

                            </div>
                        </div>
                        
                        <div class="text-center mt-4 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="submit-button">Kirim Formulir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@push('styles')
    <style>
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .radio-group, .checkbox-group {
            display: flex;
            flex-direction: column;
        }
        
        .radio-group label, .checkbox-group label {
            margin-bottom: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: .25rem;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        
        .radio-group label:hover, .checkbox-group label:hover {
            background-color: #f8f9fa;
        }
        
        .question {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .question:last-child {
            border-bottom: none;
        }
        
        .jurusan-rank {
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: .25rem;
        }
        
        #esai {
            min-height: 150px;
        }
        .signature-box {
            height: 100px;
            background-color: #f8f9fa;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
            background-color: #91c5ff !important;
            color: #fff !important ;
        }
    </style>
@endpush
@push('scripts')
<script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
    $(document).ready(function() {
        validateRanks();

        $('.rank-select').on('change', function() {
            validateRanks();
        });

        updateNavButtons();

        $('#soalTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            updateNavButtons();
        });
        
        $('#btn-next-tab').on('click', function() {
            $('#soalTab .nav-link.active').parent().next().find('button').tab('show');
        });

        $('#btn-prev-tab').on('click', function() {
            $('#soalTab .nav-link.active').parent().prev().find('button').tab('show');
        });
    });
    function updateNavButtons() {
        const activeTab = $('#soalTab .nav-link.active').parent();
        const firstTab = $('#soalTab .nav-item:first');
        const lastTab = $('#soalTab .nav-item:last');

        // Sembunyikan tombol 'Sebelumnya' jika di tab pertama
        $('#btn-prev-tab').toggle(!activeTab.is(firstTab));
        
        // Sembunyikan tombol 'Berikutnya' jika di tab terakhir
        $('#btn-next-tab').toggle(!activeTab.is(lastTab));
    }
    function validateRanks() {
        const selectedValues = [];
        let isDuplicate = false;
        
        $('.rank-select').each(function() {
            const value = $(this).val();
            if (value !== '') {
                selectedValues.push(value);
            }
        });

        if (selectedValues.length > 1) {
            const uniqueValues = new Set(selectedValues);
            if (uniqueValues.size < selectedValues.length) {
                isDuplicate = true;
            }
        }

        if (isDuplicate) {
            $('#rank-error').show();
            $('#submit-button').prop('disabled', true); 
        } else {
            $('#rank-error').hide();
            $('#submit-button').prop('disabled', false);
        }
    }
</script>
@endpush