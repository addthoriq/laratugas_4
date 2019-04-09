<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Santri;
use App\Model\Provinsi;

class SantriController extends Controller
{
    protected $folder   = 'admin.santri';
    public function index()
    {
        $santri = Santri::orderBy('id')->paginate(3);
        return view($this->folder.'.index', compact('santri'));
    }
    public function create()
    {
        $data['prov'] = Provinsi::all();
        return view($this->folder.'.create', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'  => 'required',
            'email'  => 'required|email|unique:santri,email',
            'password'  => 'required|max:30',
            'gender'    => 'required',
            'alamat'    => 'required'
        ]);
        if ($request->hasFile('poto'))
        {
            $poto       = $request->file('poto');
            $path  = $poto->store('public/admin/gambarsantri');
            $santri         = new Santri;
            $santri->id_provinsi   = $request->provinsi;
            $santri->nama   = $request->nama;
            $santri->email   = $request->email;
            $santri->password   = bcrypt($request->password);
            $santri->gender   = $request->gender;
            $santri->poto   = $path;
            $santri->alamat     = $request->alamat;
            $santri->save();
        }
        else
        {
            $santri         = new Santri;
            $santri->id_provinsi   = $request->provinsi;
            $santri->nama   = $request->nama;
            $santri->email   = $request->email;
            $santri->password   = bcrypt($request->password);
            $santri->gender   = $request->gender;
            $santri->alamat     = $request->alamat;
            $santri->save();
        }
        // $santri     = "N";
        // if ($request->hasFile('poto')) {
        //     $destinasi  = 'Admin/gambarsantri';
        //     $poto       = $request->file('poto');
        //     $nama       = $poto->getClientOriginalName();
        //     $poto->move($destinasi, $nama);
        //     $santri     = "Y";
        // }
        // Santri::create([
        //     'nama'  => $request->nama,
        //     'email'  => $request->email,
        //     'password'  => bcrypt($request->password),
        //     'gender'  => $request->gender,
        //     'poto'    => $request->$nama
        // ]);
        return redirect('admin/santri')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $santri    = Santri::find($id);
        return view($this->folder.'.edit', compact(['santri']));
    }
    public function update(Request $request)
    {
        $id     = $request->id;
        $data   = $request->all();
        if (empty($data['password'])) {
            unset($data['password']);
            $this->validate($request,[
                'nama'  => 'required',
                'email'  => 'required|email|unique:santri,email,'.$id,
            ]);
        }else {
            $this->validate($request,[
                'nama'  => 'required',
                'email'  => 'required|email|unique:santri,email,'.$id,
                'password'  => 'sometimes|min:5',
            ]);
        }
        if ($request->hasFile('poto'))
        {
            $poto   = $request->file('poto');
            $path   = $poto->store('public/admin/gambarsantri');
            Santri::find($id)->update([
                'id_provinsi' => $request->provinsi,
                'nama'  => $request->nama,
                'email'  => $request->email,
                'password'  => bcrypt($request->password),
                'gender'  => $request->gender,
                'poto'  => $path,
                'alamat'    => $request->alamat
            ]);
        }
        else
        {
            Santri::find($id)->update([
                'id_provinsi' => $request->provinsi,
                'nama'  => $request->nama,
                'email'  => $request->email,
                'password'  => bcrypt($request->password),
                'gender'  => $request->gender,
                'alamat'    => $request->alamat
            ]);
        }
        return redirect('admin/santri')->with('success', 'Data berhasil diubah');
    }
    public function delete($id)
    {
        Santri::find($id)->delete();
        return redirect('admin/santri')->with('success', 'Data berhasil dihapus');
    }
}
