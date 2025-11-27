public function store(Request $request)
{
    $request->validate([
        'files.*' => 'required|mimes:png,jpg,jpeg,pdf,docx,xlsx,txt|max:5000',
        'ref_table' => 'required|string',
        'ref_id' => 'required|integer'
    ]);

    if($request->hasFile('files'))
    {
        foreach ($request->file('files') as $file) {

            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            MultipleUpload::create([
                'file'       => $filename,
                'ref_table'  => $request->ref_table,
                'ref_id'     => $request->ref_id,
            ]);
        }
    }

    return back()->with('success', "File berhasil di-upload.");
}