<h3>Detail Pelanggan</h3>

<table class="table">
    <tr>
        <th>Nama</th>
        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>

    </tr>
    <tr>
        <th>Email</th><td>{{ $customer->email }}</td>
    </tr>
</table>

<hr>

<h4>Upload File Pendukung</h4>

<form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="ref_table" value="pelanggan">
    <input type="hidden" name="ref_id" value="{{ $customer->id }}">

    <div class="mb-3">
        <label> Pilih File (bisa banyak):</label>
        <input type="file" name="files[]" multiple class="form-control">
    </div>

    <button class="btn btn-primary">Upload</button>
</form>

<hr>

<h4>List File Pendukung</h4>

<ul>
@forelse($files as $file)
    <li>
        @if(in_array(pathinfo($file->file, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
            <img src="{{ asset('uploads/'.$file->file) }}" width="80" class="img-thumbnail">
        @endif

        <a href="{{ asset('uploads/'.$file->file) }}" target="_blank">
            {{ $file->file }}
        </a>

        <form action="{{ route('upload.delete', $file->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Hapus file ini?')" class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </li>
@empty
    <li>Tidak ada file.</li>
@endforelse
</ul>
