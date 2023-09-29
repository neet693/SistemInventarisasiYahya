<a href="{{ route('barangs.create') }}" class="btn btn-primary mb-2"><i class="bi bi-plus-circle-fill"></i> Tambah
    Barang</a>
<a href="{{ route('export-barang') }}" class="btn btn-warning mb-2"><i class="bi bi-printer-fill"></i> Export Barang
</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Modal Upload File
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File Barang </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import-barang') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="your_file">
                    <button class="btn btn-success mb-2" type="submit">Impor Data Excel</button>
                </form>
            </div>
        </div>
    </div>
</div>
