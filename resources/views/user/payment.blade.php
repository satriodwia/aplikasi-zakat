<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow mt-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">Pembayaran Zakat</h2>
        <form id="payment-form" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="customer_name" class="block font-semibold mb-1 text-gray-700">Nama Lengkap</label>
                <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" id="customer_name" name="customer_name" required>
            </div>

            <div class="mb-4">
                <label for="customer_email" class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" class="w-full border border-gray-300 rounded px-3 py-2" id="customer_email" name="customer_email" required>
            </div>

            <div class="mb-4">
                <label for="customer_phone" class="block font-semibold mb-1 text-gray-700">No. Telepon</label>
                <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" id="customer_phone" name="customer_phone" required>
            </div>

            <div class="mb-4">
                <label for="zakat_id" class="block font-semibold mb-1 text-gray-700">Jenis Zakat</label>
                <select class="w-full border border-gray-300 rounded px-3 py-2" id="zakat_id" name="zakat_id" required>
                    <option value="">Pilih Jenis Zakat</option>
                    <option value="1">Zakat Fitrah</option>
                    <option value="2">Zakat Mal</option>
                    <option value="3">Infaq</option>
                    <option value="4">Sedekah</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block font-semibold mb-1 text-gray-700">Jumlah</label>
                <input type="number" class="w-full border border-gray-300 rounded px-3 py-2" id="quantity" name="quantity" min="1" required>
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block font-semibold mb-1 text-gray-700">Total Harga (Rp)</label>
                <input type="number" class="w-full border border-gray-300 rounded px-3 py-2" id="total_amount" name="total_amount" min="0" required>
            </div>

            <button type="submit" id="pay-button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Bayar Sekarang</button>
        </form>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);

            fetch("{{ route('payment.checkout') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.snap_token){
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result){
                            alert("Pembayaran berhasil!");
                            window.location.href = "{{ route('dashboard') }}";
                        },
                        onPending: function(result){
                            alert("Pembayaran sedang diproses.");
                            window.location.href = "{{ route('dashboard') }}";
                        },
                        onError: function(result){
                            alert("Pembayaran gagal!");
                        },
                        onClose: function(){
                            alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                } else {
                    alert("Terjadi kesalahan pada server.");
                }
            })
            .catch(error => {
                alert("Terjadi kesalahan pada server.");
            });
        });
    </script>
</x-app-layout>