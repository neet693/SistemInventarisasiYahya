<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#kembalikanModal{{ $peminjaman->id }}">
    Kembalikan
</button>

<!-- Modal Kembalikan -->
<div class="modal fade" id="kembalikanModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="kembalikanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kembalikanModalLabel">Kembalikan Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_penerima" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
