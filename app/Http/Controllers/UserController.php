<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = $request->password;

        // ============================
        //  UPLOAD FOTO (TAMBAHAN)
        // ============================
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = 
                $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name     = $request->name;
        $user->email    = $request->email;

        // Jika password diisi, update
        if ($request->password != "") {
            $user->password = $request->password;
        }

        // ============================
        //  UPDATE FOTO (TAMBAHAN)
        // ============================
        if ($request->hasFile('profile_picture')) {

            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Upload foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // ============================
        //  HAPUS FOTO (TAMBAHAN)
        // ============================
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
