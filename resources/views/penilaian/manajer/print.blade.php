{{-- <!DOCTYPE html>
<html>

<head>
    <title>Laporan Penilaian Manajer</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.5cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 8pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
            position: relative;
        }

        .header h2 {
            margin: 0;
            font-size: 12pt;
            color: #000;
        }

        .header h3 {
            margin: 2px 0 0;
            font-size: 10pt;
            color: #333;
        }

        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
            height: 40px;
        }

        .logo-right {
            position: absolute;
            right: 0;
            top: 0;
            height: 50px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-table td {
            padding: 3px;
            vertical-align: top;
        }

        .info-table .label {
            font-weight: bold;
            width: 15%;
            background-color: #f5f5f5;
        }

        .kompetensi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7pt;
            margin-bottom: 5px;
        }

        .kompetensi-table th,
        .kompetensi-table td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: center;
        }

        .kompetensi-table th {
            background-color: #23439c;
            color: white;
            font-weight: bold;
        }

        .kompetensi-table td.left-align {
            text-align: left;
            padding-left: 5px;
        }

        .category-header {
            background-color: #ecf0f1;
            font-weight: bold;
            text-align: left;
            padding: 2px 5px;
            margin: 3px 0;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .summary-cell {
            width: 33%;
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .summary-label {
            font-weight: bold;
            font-size: 8pt;
        }

        .summary-value {
            font-weight: bold;
            font-size: 10pt;
            color: #2c3e50;
        }

        .signature-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
            padding: 5px;
        }

        .table-feedback-box {
            width: 60%;
            border: 1px solid #ddd;
            padding: 3px;
            font-size: 7pt;
        }

        .table-signature-box {
            width: 40%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 43px auto 5px;
        }

        .page-break {
            page-break-after: always;
        }

        .compact-row {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo.png') }}" class="logo-left">
        <img src="{{ public_path('assets/img/logo_1.png') }}" class="logo-right">
        <h2>LAPORAN PENILAIAN KINERJA MANAJER</h2>
        <h3>PT. CIPTA BUMI PRAWARA (STAFFLINK) - Periode {{ $penilaian->periode }}</h3>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama</td>
            <td width="25%">{{ $penilaian->manajer->nama }}</td>
            <td class="label">NIP</td>
            <td width="15%">{{ $penilaian->manajer->nip }}</td>
            <td class="label">Jabatan</td>
            <td width="25%">{{ ucfirst($penilaian->manajer->user->role->name) ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Departemen</td>
            <td>{{ $penilaian->manajer->departemen }}</td>
            <td class="label">Penilai</td>
            <td>{{ $penilaian->penilai->nama }}</td>
            <td class="label">Tanggal</td>
            <td>{{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="category-header">KOMPETENSI</div>
    <table class="kompetensi-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="30%">Kompetensi</th>
                <th width="10%">Metode</th>
                <th width="8%">Target</th>
                <th width="8%">Aktual</th>
                <th width="8%">Gap</th>
                <th width="8%">Nilai</th>
                <th width="8%">Bobot</th>
                <th width="16%">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @php $currentCategory = ''; @endphp
            @foreach ($penilaian->kompetensi_items as $index => $item)
                @if ($item['kategori'] != $currentCategory)
                    @php $currentCategory = $item['kategori']; @endphp
                    <tr>
                        <td colspan="9" class="left-align" style="background-color:#f5f5f5;">
                            <strong>{{ $currentCategory }}</strong>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="left-align">{{ $item['kompetensi'] }}</td>
                    <td>{{ $item['metode'] }}</td>
                    <td>{{ $item['target'] }}</td>
                    <td>{{ $item['aktual'] }}</td>
                    <td>{{ $item['gap'] }}</td>
                    <td>{{ $item['aktual'] * 10 }}</td>
                    <td>{{ $item['hasil_bobot'] }}</td>
                    <td class="left-align">{{ $item['komentar'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td class="summary-cell">
                <div class="summary-label">TOTAL SCORE</div>
                <div class="summary-value">{{ $penilaian->total_score }}</div>
            </td>
            <td class="summary-cell">
                <div class="summary-label">PERSENTASE</div>
                <div class="summary-value">{{ $penilaian->total_persentase }}%</div>
            </td>
            <td class="summary-cell">
                <div class="summary-label">INDEKS</div>
                <div class="summary-value">{{ $penilaian->indeks }}</div>
            </td>
        </tr>
    </table>


    <table class="signature-table">
        <tr>
            <td class="table-feedback-box">
                <strong>Feedback & Catatan:</strong><br>
                {{ $penilaian->feedback_manajer ?? '-' }}<br><br>
                <strong>Corrective Action:</strong><br>
                {{ $penilaian->corrective_action ?? '-' }}
            </td>
            <td class="table-signature-box">
                <div>Jember, {{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</div>
                <div>Penilai,</div>
                <div class="signature-line"></div>
                <div><strong>{{ $penilaian->penilai->nama }}</strong></div>
            </td>
            <td class="table-signature-box">
                <div>Jember, {{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</div>
                <div>Mengetahui,</div>
                <div class="signature-line"></div>
                <div><strong>{{ $penilaian->manajer->nama }}</strong></div>
            </td>
        </tr>
    </table>
</body>

</html> --}}

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penilaian Manajer</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0.5cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 8pt;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
            position: relative;
        }

        .header h2 {
            margin: 0;
            font-size: 12pt;
            color: #000;
        }

        .header h3 {
            margin: 2px 0 0;
            font-size: 10pt;
            color: #333;
        }

        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
            height: 40px;
        }

        .logo-right {
            position: absolute;
            right: 0;
            top: 0;
            height: 40px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-table td {
            padding: 3px;
            vertical-align: top;
        }

        .info-table .label {
            font-weight: bold;
            width: 15%;
            background-color: #f5f5f5;
        }

        .kompetensi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-bottom: 5px;
        }

        .kompetensi-table th,
        .kompetensi-table td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: center;
        }

        .kompetensi-table th {
            background-color: #23439c;
            color: white;
            font-weight: bold;
        }

        .kompetensi-table td.left-align {
            text-align: left;
            padding-left: 5px;
        }

        .category-header {
            background-color: #ecf0f1;
            font-weight: bold;
            text-align: left;
            padding: 2px 5px;
            margin: 3px 0;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .summary-cell {
            width: 33%;
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .summary-label {
            font-weight: bold;
            font-size: 8pt;
        }

        .summary-value {
            font-weight: bold;
            font-size: 10pt;
            color: #2c3e50;
        }

        .signature-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
            padding: 5px;
        }

        .table-feedback-box {
            width: 60%;
            border: 1px solid #ddd;
            padding: 3px;
            font-size: 7pt;
        }

        .table-signature-box {
            width: 40%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 43px auto 5px;
        }

        .page-break {
            page-break-after: always;
        }

        .compact-row {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo.png') }}" class="logo-left">
        <img src="{{ public_path('assets/img/logo_1.png') }}" class="logo-right">
        <h2>LAPORAN PENILAIAN KINERJA MANAJER</h2>
        <h3>PT. CIPTA BUMI PRAWARA (STAFFLINK) - Periode {{ $penilaian->periode }}</h3>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama</td>
            <td width="15%">{{ $penilaian->manajer->nama }}</td>
            <td class="label">NIP</td>
            <td width="15%">{{ $penilaian->manajer->nip }}</td>
            <td class="label">Jabatan</td>
            <td width="15%">{{ ucfirst($penilaian->manajer->user->role->name) ?? '-' }}</td>
            <td class="label">Detail Jabatan</td>
            <td width="15%">{{ $penilaian->manajer->detail_jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Departemen</td>
            <td>{{ $penilaian->manajer->departemen }}</td>
            <td class="label">Penilai</td>
            <td>{{ $penilaian->penilai->nama }}</td>
            <td class="label">Tanggal</td>
            <td>{{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="category-header">KOMPETENSI</div>
    <table class="kompetensi-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="30%">Kompetensi</th>
                <th width="10%">Metode</th>
                <th width="8%">Target</th>
                <th width="8%">Aktual</th>
                <th width="8%">Gap</th>
                <th width="8%">Nilai</th>
                <th width="8%">Bobot</th>
                <th width="16%">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @php $currentCategory = ''; @endphp
            @foreach ($penilaian->kompetensi_items as $index => $item)
                @if ($item['kategori'] != $currentCategory)
                    @php $currentCategory = $item['kategori']; @endphp
                    <tr>
                        <td colspan="9" class="left-align" style="background-color:#f5f5f5;">
                            <strong>{{ $currentCategory }}</strong>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="left-align">{{ $item['kompetensi'] }}</td>
                    <td>{{ $item['metode'] }}</td>
                    <td>{{ $item['target'] }}</td>
                    <td>{{ $item['aktual'] }}</td>
                    <td>{{ $item['gap'] }}</td>
                    <td>{{ $item['aktual'] * 10 }}</td>
                    <td>{{ $item['hasil_bobot'] }}</td>
                    <td class="left-align">{{ $item['komentar'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td class="summary-cell">
                <div class="summary-label">TOTAL SCORE</div>
                <div class="summary-value">{{ $penilaian->total_score }}</div>
            </td>
            <td class="summary-cell">
                <div class="summary-label">PERSENTASE</div>
                <div class="summary-value">{{ $penilaian->total_persentase }}%</div>
            </td>
            <td class="summary-cell">
                <div class="summary-label">INDEKS</div>
                <div class="summary-value">{{ $penilaian->indeks }}</div>
            </td>
        </tr>
    </table>


    <table class="signature-table">
        <tr>
            <td class="table-feedback-box">
                <strong>Feedback & Catatan:</strong><br>
                {{ $penilaian->feedback_manajer ?? '-' }}<br><br>
                <strong>Corrective Action:</strong><br>
                {{ $penilaian->corrective_action ?? '-' }}
            </td>
            <td class="table-signature-box">
                <div>Jember, {{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</div>
                <div>Penilai,</div>
                <div class="signature-line"></div>
                <div><strong>{{ $penilaian->penilai->nama }}</strong></div>
            </td>
            <td class="table-signature-box">
                <div>Jember, {{ $penilaian->tanggal_penilaian->format('d/m/Y') }}</div>
                <div>Mengetahui,</div>
                <div class="signature-line"></div>
                <div><strong>{{ $penilaian->manajer->nama }}</strong></div>
            </td>
        </tr>
    </table>
</body>

</html>
