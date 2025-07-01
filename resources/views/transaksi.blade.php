@extends('layouts.navigation')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6">Daftar Transaksi</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transaksis as $transaksi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->katalog->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($transaksi->total_harga, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($transaksi->status) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->additional }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaksi->status == 'belum bayar')
                                    <button onclick="payWithMidtrans('{{ $transaksi->id }}')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Bayar
                                    </button>
                                @else
                                    <span class="text-green-500 font-semibold">Lunas</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    function payWithMidtrans(transaksiId) {
        fetch(`/payments/create/${transaksiId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Open Midtrans payment popup
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        // Handle successful payment
                        alert('Pembayaran berhasil');

                        // Kirimkan data status pembayaran ke backend untuk diperbarui
                        fetch('/payments/callback', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                order_id: result.order_id, // ID pesanan dari hasil pembayaran
                                transaction_status: result.transaction_status, // Status transaksi dari Midtrans
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                location.reload(); // Reload halaman untuk memperbarui status transaksi
                            } else {
                                alert('Gagal mengupdate status pembayaran');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengupdate status pembayaran');
                        });

                    },
                    onPending: function(result) {
                        alert('Menunggu pembayaran');
                    },
                    onError: function(result) {
                        alert('Terjadi kesalahan saat pembayaran');
                    },
                    onClose: function() {
                        alert('Anda menutup pop-up tanpa menyelesaikan pembayaran');
                    }
                });
            } else {
                alert('Gagal membuat pembayaran: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses pembayaran.');
        });
    }
</script>

@endsection
