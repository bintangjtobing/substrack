<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Keuangan</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Transaksi</th>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th> <!-- Menambahkan kolom saldo -->
                </tr>
            </thead>
            <tbody>
                @php
                    $saldo = 0;
                @endphp
                @foreach($financialReports as $report)
                    @php
                        $saldo += $report->debit - $report->credit;
                    @endphp
                    <tr>
                        <td>{{ $report->tanggal }}</td>
                        <td>{{ $report->transaction_type }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->debit }}</td>
                        <td>{{ $report->credit }}</td>
                        <td>{{ $saldo }}</td> <!-- Menambahkan saldo ke dalam baris -->
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="3">Total</td>
                    <td>{{ $total_debet }}</td>
                    <td>{{ $total_kredit }}</td>
                    <td>{{ $total_debet - $total_kredit }}</td> <!-- Menambahkan total saldo -->
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
