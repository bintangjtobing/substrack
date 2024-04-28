@extends('welcome')

@section('title', 'Petty Cash Reports')

@section('addNewData')
    <div class="action-btn">
        <a href="/financial-reports/pdf" class="btn btn-sm btn-primary btn-add">
            <i class="la la-download"></i> Print Report</a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        {!! showSuccessToast(session('success')) !!}
        {{ Session::forget('success') }}
    @endif
    <div class="col-lg-12 mb-25">
        <div class="social-overview-wrap">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="table4 table5 p-25 bg-white">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>Tanggal</th>
                                        <th>Transaksi</th>
                                        <th>Keterangan</th>
                                        <th align="right">Debet</th>
                                        <th align="right">Kredit</th>
                                        <th align="right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $saldo = 0;
                                    @endphp
                                    @forelse ($financialReports as $report)
                                        @php
                                            $saldo += $report->debit - $report->credit;
                                        @endphp
                                        <tr>
                                            <td>{{ $report->tanggal }}</td>
                                            <td>{{ $report->transaction_type }}</td>
                                            <td>{{ $report->description }}</td>
                                            <td align="right">Rp. {{ number_format($report->debit, 2, ',', '.') }}</td>
                                            <td align="right">Rp. {{ number_format($report->credit, 2, ',', '.') }}</td>
                                            <td align="right">Rp. {{ number_format($saldo, 2, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data available in the database</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="text-left"><strong>Total</strong></td>
                                        <td align="right">
                                            <strong>Rp. {{ number_format($total_debet, 2, ',', '.') }}</strong>
                                        </td>
                                        <td align="right">
                                            <strong>Rp. {{ number_format($total_kredit, 2, ',', '.') }}</strong>
                                        </td>
                                        <td align="right">
                                            <strong>Rp.
                                                {{ number_format($total_debet - $total_kredit, 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"><strong>Saldo Awal:</strong></td>
                                        <td align="right" colspan="4">
                                            <strong>Rp. {{ number_format($total_debet, 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"><strong>Total Pengeluaran:</strong></td>
                                        <td align="right" colspan="4">
                                            <strong>Rp. {{ number_format($total_kredit, 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"><strong>Sisa Saldo:</strong></td>
                                        <td align="right" colspan="4">
                                            <strong>Rp.
                                                {{ number_format($total_debet - $total_kredit, 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
