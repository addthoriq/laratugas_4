<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Guru;

class GuruController extends Controller
{
    protected $dir  = 'admin.guru';
    public function index()
    {
        $data['guru']    = Guru::orderBy('id')->paginate(3);
        return  view($this->folder.'.index', $data);
    }
    public function create()
    {
        return view($this->folder.'.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'  => 'required|max:30',
            'nip'  => 'required|max:20',
            'gender'  => 'required',
            'hp'  => 'required|max:12',
            'email'  => 'required|email|unique:guru,email',
        ]);
        $poto   = $request->poto;
        $path   = $poto->store('public/Admin/GambarGuru');
        $guru   = new Guru;
        $guru->nama   = $request->nama;
        $guru->nip    = $request->nip;
        $guru->gender = $request->gender;
        $guru->hp     = $request->hp;
        $guru->email  = $request->email;
        $guru->poto   = $path;
        $guru->save();
        return redirect('admin/guru')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $guru   = Guru::find($id);
        return view($this->folder.'.edit', compact('guru'));
    }
    public function update(Request $request)
    {
        $id     = $request->id;
        $this->validate($request,[
            'nama'  => 'required|max:30',
            'nip'  => 'required|max:20',
            'hp'  => 'required|max:12',
            'email'  => 'required|email|unique:guru,email,'.$id,
        ]);
        if ($request->hasFile('poto'))
        {
            $poto   = $request->poto;
            $path   = $poto->store('public/Admin/GambarGuru');
            Guru::find($id)->update([
                'nama'  => $request->nama,
                'nip'  => $request->nip,
                'gender'  => $request->gender,
                'hp'  => $request->hp,
                'email'  => $request->email,
                'poto'  => $path
            ]);
        }
        else
        {
            Guru::find($id)->update([
                'nama'  => $request->nama,
                'nip'  => $request->nip,
                'gender'  => $request->gender,
                'hp'  => $request->hp,
                'email'  => $request->email
            ]);
        }
        return redirect('admin/guru')->with('success', 'Data berhasil diubah');
    }
    public function delete($id)
    {
        Guru::find($id)->delete();
        return redirect('admin/guru')->with('success', 'Data berhasil dihapus');
    }
}
