<!-- resources/views/components/acc_peminjaman.blade.php -->
<form action="{{ route('peminjamans.acc', $peminjaman->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="acc_peminjaman" class="form-label">Approval Peminjaman</label>
        <select name="acc_peminjaman" id="acc_peminjaman" class="form-control" required>
            <option value="pending" {{ $peminjaman->acc_peminjaman === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $peminjaman->acc_peminjaman === 'approved' ? 'selected' : '' }}>Disetujui
            </option>
            <option value="rejected" {{ $peminjaman->acc_peminjaman === 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <div class="mb-3" id="alasan_tidak_acc_div"
        style="display: {{ $peminjaman->acc_peminjaman === 'rejected' ? 'block' : 'none' }};">
        <label for="alasan_tidak_acc" class="form-label">Alasan Ditolak</label>
        <textarea name="alasan_tidak_acc" class="form-control">{{ old('alasan_tidak_acc', $peminjaman->alasan_tidak_acc) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Status</button>
</form>

<script>
    document.getElementById('acc_peminjaman').addEventListener('change', function() {
        var alasanDiv = document.getElementById('alasan_tidak_acc_div');
        if (this.value === 'rejected') {
            alasanDiv.style.display = 'block';
        } else {
            alasanDiv.style.display = 'none';
        }
    });
</script>
