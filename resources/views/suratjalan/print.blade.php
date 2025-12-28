<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Jalan - {{ $suratjalan->nosuratjalan }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/ptkobarnobgnew.png') }}" />
    <style>
        /* RESET */
        * {
            box-sizing: border-box !important;
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif !important;
        }

      /* UKURAN KERTAS UNTUK PRINT - LANDSKAP */
@media print {
    @page {
        size: landscape;
        margin: 0.5cm;
    }
    
    body {
        width: 100% !important;
        height: auto !important;
        margin: 0 auto !important;
        padding: 0 !important;
        overflow: visible !important; /* TAMBAHAN */
    }
    
    .container {
        width: 100% !important;
        max-width: 27.7cm !important;
        margin: 0 auto !important;
        padding: 15px 20px !important;
        height: auto !important;
        overflow: visible !important; /* TAMBAHAN */
    }

    /* ==== INI INTI PERBAIKANNYA ==== */
    .footer,
    .signature-container,
    .received-box,
    .petugas-container,
    .petugas-box {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    /* ============================== */
    
    .print-controls,
    .stamp-control,
    .no-print {
        display: none !important;
    }
    
    .stamp-overlay {
        display: none !important;
    }
    
    .show-stamp .stamp-overlay {
        display: block !important;
    }
}
   
        /* Untuk tampilan di browser */
        @media screen {
            body {
                background: #f0f0f0;
                padding: 20px;
                display: flex;
                justify-content: center;
                font-family: "Times New Roman", Times, serif !important;
            }
            
            .container {
                background: white;
                width: 29.7cm;
                height: 21cm;
                padding: 20px 25px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                margin: 0 auto;
                font-family: "Times New Roman", Times, serif !important;
            }
        }
        
        /* Header perusahaan */
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            width: 100%;
        }
        
        .perusahaan {
            width: 50%;
            text-align: left;
        }
        
        .customer {
            width: 45%;
            text-align: left;
            border: 1px solid #000;
            padding: 10px;
        }
        
        .perusahaan h2 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: bold;
        }
        
        .perusahaan p, .customer p {
            margin: 2px 0;
            font-size: 12px;
            line-height: 1.3;
        }
        
        .customer h3 {
            margin: 0 0 8px 0;
            font-size: 14px;
            font-weight: bold;
        }
        
        /* Judul Surat Jalan */
        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin: 30px 0 25px 0;
            text-transform: uppercase;
            border-bottom: 6px double #000;
            padding-bottom: 12px;
        }
        
        /* Informasi surat jalan */
        .info-sj {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 3px;
            width: 100%;
        }
        
        .info-sj p {
            margin: 5px 0;
            font-size: 13px;
        }
        
        /* Tabel barang */
        .table-container {
            margin-bottom: 30px;
            width: 100%;
        }
        
        .table-container table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .table-container table th {
            background-color: #e0e0e0;
            font-weight: bold;
            padding: 8px 5px;
            border: 1px solid #000;
            text-align: center;
        }
        
        .table-container table td {
            border: 1px solid #000;
            padding: 8px 5px;
            text-align: left;
            height: auto;
        }
        
        .text-center {
            text-align: center !important;
        }
        
        /* Footer dengan kotak tanda tangan - PERBAIKAN */
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        
        .signature-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            height: 130px;
        }
        
        /* Received box */
        .received-box {
            width: 20%;
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 12px 8px;
            height: 130px;
        }
        
        /* Petugas container */
        .petugas-container {
            width: 78%;
            display: flex;
            height: 130px;
            border: 1px solid #000;
        }
        
        /* Tiap kotak petugas */
        .petugas-box {
            flex: 1;
            border-right: 1px solid #000;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 12px 8px;
            text-align: center;
            position: relative;
            height: 130px;
        }
        
        /* Hapus border kanan untuk elemen terakhir */
        .petugas-box:last-child {
            border-right: none;
        }
        
        /* Prepared cell khusus untuk stamp */
        .prepared-box {
            position: relative;
        }
        
        /* PERBAIKAN: Signature label */
        .signature-label {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #000;
            position: relative; /* TAMBAHKAN INI */
            z-index: 5; /* TAMBAHKAN INI */
        }

        /* PERBAIKAN ALIGNMENT: Khusus untuk label "Prepared" */
        .prepared-box .signature-label {
            margin-bottom: 18px; /* JANGAN DIUBAH, BIAR SAMA DENGAN LAINNYA */
        }
        
        /* PERBAIKAN: Area untuk tanda tangan - HILANGKAN GARIS BAWAH */
        .signature-space {
            flex-grow: 1;
            min-height: 55px;
            margin: 1px 0 22px 0;
            position: relative;
            z-index: 2; /* TAMBAHKAN INI */
        }
        
        /* HAPUS GARIS BAWAH INI */
        /* .signature-space::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 10%;
            width: 80%;
            height: 1px;
            background-color: #000;
            border-bottom: 1px solid #000;
        } */
        
        /* PERBAIKAN: Style untuk nama yang ditampilkan */
        .signature-name {
            height: 22px;
            font-size: 13px;
            margin-top: 8px;
            text-align: center;
            min-height: 22px;
            position: relative;
            z-index: 2;
        }
        
        /* Nama yang sudah terisi (prepared) */
        .signature-name.filled {
            font-weight: bold;
            color: #000;
            padding-top: 2px;
        }
        
        /* Nama yang masih kosong (tanda kurung) - HAPUS ITALIC */
        .signature-name.empty {
            color: #666;
            /* HAPUS: font-style: italic; */
            letter-spacing: 1px;
        }
        
        /* Nama dengan stempel di atasnya */
        .signature-name.with-stamp {
            margin-top: 0; /* PERBAIKAN: KEMBALIKAN KE 0 */
            padding-top: 1px; /* GANTI DENGAN PADDING */
        }
        
        /* Stamp digital */
        .stamp-overlay {
            position: absolute;
            top: 35px; /* PERBAIKAN: DARI 15px JADI 35px */
            left: 50%;
            transform: translateX(-50%);
            display: none;
            z-index: 10;
            pointer-events: none;
            filter: drop-shadow(1px 1px 3px rgba(0,0,0,0.15));
        }
        
        .stamp-image {
            width: 160px;
            height: 75px;
            opacity: 0.9;
            object-fit: contain;
        }
        
        .show-stamp .stamp-overlay {
            display: block;
        }
        
        /* Checkbox untuk stempel */
        .stamp-control {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 3px;
            text-align: center;
        }
        
        .stamp-checkbox {
            margin-right: 8px;
        }
        
        .stamp-label {
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
        }
        
        /* Tombol print */
        .print-controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 8px;
            font-family: Arial, sans-serif !important;
        }
        
        .btn-print {
            background: #007bff;
            color: white;
        }
        
        .btn-close {
            background: #6c757d;
            color: white;
        }
        
        .btn-pdf {
            background: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <div id="printWrapper">
        <div class="container">
            <!-- Judul Surat Jalan -->
            <div class="title">SURAT JALAN</div>
            
            <!-- Header dengan perusahaan dan customer -->
            <div class="header">
                <div class="perusahaan" style="display: flex; align-items: flex-start; width: 50%;">
                    @if($logo_exists)
                        <img src="{{ $logo_path }}" alt="Logo PT Kobar" style="max-width: 70px; height: auto; margin-right: 15px;">
                    @endif
                    <div style="flex: 1;">
                        <h2 style="margin: 0 0 5px 0; font-size: 18px; font-weight: bold;">
                            <span style="color: #0066CC;">PT.</span> 
                            <span style="color: #e00303ff;">KOBAR</span> 
                            <span style="color: #0066CC;">INDONESIA</span>
                        </h2>
                        <p style="margin: 2px 0; font-size: 12px; line-height: 1.3;">Jl. Raya Penggilingan Komplek PIK, Blok G 18-20</p>
                        <p style="margin: 2px 0; font-size: 12px; line-height: 1.3;">Penggilingan Cakung, Jakarta Timur 13940</p>
                        <p style="margin: 2px 0; font-size: 12px; line-height: 1.3;">Telp. 021 46831373</p>
                    </div>
                </div>
                
                <div class="customer">
                    <h3>Kepada :</h3>
                    @if(isset($suratjalan->customer) && $suratjalan->customer->namacustomer)
                        <p style="font-weight: bold; font-size: 13px; margin-bottom: 5px;">{{ $suratjalan->customer->namacustomer }}</p>
                    @else
                        <p style="font-weight: bold;">[Nama Customer Tidak Ditemukan]</p>
                    @endif
                    
                    @if(isset($suratjalan->customer) && $suratjalan->customer->alamat)
                        <p style="font-size: 11px; line-height: 1.3;">{!! nl2br(e($suratjalan->customer->alamat)) !!}</p>
                    @else
                        <p>[Alamat Tidak Ditemukan]</p>
                    @endif
                </div>
            </div>
            
            <!-- Informasi surat jalan -->
            <div class="info-sj">
                <p><strong>No. Surat Jalan :</strong> {{ $suratjalan->nosuratjalan }}</p>
                <p><strong>Tanggal :</strong> 
                    @if(!empty($tanggal_format))
                        {{ $tanggal_format }}
                    @else
                        [Tanggal Tidak Ditemukan]
                    @endif
                </p>
                <p><strong>No. Kendaraan :</strong> 
                    @if(isset($suratjalan->nopol))
                        {{ $suratjalan->nopol }}
                        @if(isset($suratjalan->kendaraan) && !empty($suratjalan->kendaraan->namakendaraan))
                            - {{ $suratjalan->kendaraan->namakendaraan }}
                        @endif
                    @else
                        [Nomor Kendaraan Tidak Ditemukan]
                    @endif
                </p>
            </div>
            
            <!-- Tabel barang -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th width="25%">Nomor Part</th>
                            <th width="40%">Nama Part</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($suratjalan->details) && $suratjalan->details->count() > 0)
                            @foreach($suratjalan->details as $index => $detail)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <div style="font-size: 13px; font-weight: normal;">
                                        {{ $detail->nopart }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 13px; font-weight: normal;">
                                        {{ $detail->part->namapart ?? $detail->nopart }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div style="font-size: 13px;">
                                        {{ $detail->quantity }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 13px;">
                                        {{ $detail->keterangan }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 30px; font-size: 14px;">Tidak ada data detail barang</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Kontrol stempel (hanya tampil di browser) -->
            <div class="stamp-control no-print">
                <input type="checkbox" id="showStamp" class="stamp-checkbox">
                <label for="showStamp" class="stamp-label">Tampilkan Stempel Digital PPIC</label>
            </div>
            
            <!-- Kotak tanda tangan dengan Received terpisah - VERSI DIPERBAIKI -->
            <div class="footer">
                <div class="signature-container">
                    <!-- Received box -->
                    <div class="received-box">
                        <div class="signature-label">Received</div>
                        <div class="signature-space"></div>
                        <div class="signature-name empty">(..............................)</div>
                    </div>
                    
                    <!-- Petugas container dengan flexbox -->
                    <div class="petugas-container">
                        <!-- Security -->
                        <div class="petugas-box">
                            <div class="signature-label">Security</div>
                            <div class="signature-space"></div>
                            <div class="signature-name empty">(..............................)</div>
                        </div>
                        
                        <!-- Driver -->
                        <div class="petugas-box">
                            <div class="signature-label">Driver</div>
                            <div class="signature-space"></div>
                            <div class="signature-name empty">(..............................)</div>
                        </div>
                        
                        <!-- Checked -->
                        <div class="petugas-box">
                            <div class="signature-label">Checked</div>
                            <div class="signature-space"></div>
                            <div class="signature-name empty">(..............................)</div>
                        </div>
                        
                        <!-- Prepared - dengan stamp -->
                        <div class="petugas-box prepared-box">
                            <!-- Stamp overlay -->
                            <div class="stamp-overlay">
                                @if($stamp_exists)
                                    <img src="{{ $stamp_path }}" alt="Logo PT Kobar" class="stamp-image">
                                @else
                                    <div style="width: 160px; height: 75px; border: 2px solid #E30613; border-radius: 3px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: rgba(255, 255, 255, 0.95); padding: 5px;">
                                        <div style="font-size: 13px; font-weight: bold; color: #E30613; text-align: center; line-height: 1.2;">
                                            <div style="margin-bottom: 2px;">PT. KOBAR INDONESIA</div>
                                            <div style="font-size: 11px; color: #000; border-top: 1px solid #E30613; padding-top: 2px; width: 100%;">
                                                DEPT. PPIC
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="signature-label">Prepared</div>
                            <div class="signature-space"></div>
                            <div class="signature-name {{ !empty($nama_prepared) ? 'filled with-stamp' : 'empty' }}" style="text-align: center;">
                                @if(!empty($nama_prepared))
                                    {{ $nama_prepared }}
                                @else
                                    (..............................)
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tombol kontrol untuk browser -->
    <div class="print-controls no-print">
        <button onclick="window.print()" class="btn btn-print">
            Cetak
        </button>
        <button onclick="window.close()" class="btn btn-close">
            Tutup
        </button>
        <button onclick="saveAsPDF()" class="btn btn-pdf">
            Simpan PDF
        </button>
    </div>

    <script>
        window.onload = function() {
            // Kontrol stempel
            const stampCheckbox = document.getElementById('showStamp');
            if (stampCheckbox) {
                stampCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        document.body.classList.add('show-stamp');
                    } else {
                        document.body.classList.remove('show-stamp');
                    }
                });
            }
            
            // Auto print setelah 800ms
            setTimeout(() => { 
                window.print(); 
            }, 800);
        };
        
        // Fungsi untuk menyimpan sebagai PDF
        function saveAsPDF() {
            // Aktifkan stamp jika checkbox dicentang
            const stampCheckbox = document.getElementById('showStamp');
            if (stampCheckbox && stampCheckbox.checked) {
                document.body.classList.add('show-stamp');
            }
            
            // Tunggu sebentar lalu print
            setTimeout(function() {
                window.print();
            }, 300);
        }
        
        window.onafterprint = function() {
            document.body.classList.remove('show-stamp');
        };
    </script>
</body>
</html>