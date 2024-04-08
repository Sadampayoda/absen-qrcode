<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user-manajement.index',[
            'data' => User::paginate(10),
            'active' => 'user-manejement'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'level' => 'required',
            'nim' => 'required|numeric'
        ]);

    
        // if ($request->hasFile('foto')) {
        //     $fotoName = time() . '.' . $request->foto->extension();
        //     $request->foto->move('image/users', $fotoName);
        //     $validatedData['foto'] = $fotoName;
            
        // }
        $validatedData['level'] = $request->level;

        
        $validatedData['password'] = bcrypt($request->password);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'password' => $request->password,
            'level' => $request->level,
        ]);

        $data = User::where('email',$request->email)->first();

        Semester::create([
            'id_user' => $data->id,
            'periode' => 1,
            'sks' => 23
        ]);

        
        return redirect()->route('user-manejement.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'level' => 'required',
            'nim' => 'required|numeric'
        ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nim = $request->nim;
        // $user->jenis_kelamin = $request->jenis_kelamin;
        $user->level = $request->level;

        
        // if ($request->hasFile('foto')) {
            
        //     if ($user->foto) {
        //         File::delete('image/users/' . $user->foto);
        //     }
        //     $fotoName = time() . '.' . $request->foto->extension();
        //     $request->foto->move('image/users', $fotoName);
        //     $user->foto = $fotoName;
        // }

        
        $user->save();

        
        return redirect()->route('user-manejement.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);



        



        $filePath = public_path('image/tugas/' . $data->file);


        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $data->delete();
        Semester::where('id',$id)->delete();
        
        return redirect()->route('user-manejement.index')->with('success', 'User berhasil dihapus.');
    }
}
