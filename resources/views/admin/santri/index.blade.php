@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Halaman Admin
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data santri</h3>
              <a href="{{url('admin/santri/create')}}" class="btn btn-primary pull-right">Tambah</a>
            </div>
            <!-- /.box-header -->
            @include('layouts.alerts.input')
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nomor</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nama</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Gender</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Provinsi</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Dibuat pada</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Action</th>
                </tr>
                </thead>
            <tbody>
                @php
                    $nomor  = 1;
                @endphp
                @foreach ($santri as $row)
                    <tr role="row" class="odd">
                      <td>{{$nomor++}}</td>
                      <td>{{$row->nama}}</td>
                      <td>{{($row->gender)?'Laki-laki':'Perempuan'}}</td>
                      <td>{{$row->provinsi->nama}}</td>
                      <td>{{$row->created_at}}</td>
                      <td>
                          <form class="" action="{{url('admin/santri/'.$row->id.'/delete')}}" method="post">
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                Detail
                              </button>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" onclick='javascript:return confirm("Apakah anda yakin ingin menghapus data ini?")'>Delete</button>
                          </form>
                      </td>
                    </tr>
                @endforeach
            </tbody>
                <tfoot>
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nomor</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nama</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Gender</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Provinsi</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Dibuat pada</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Action</th>
                </tr>
                </tfoot>
              </table>
              @include('layouts.modal.santri')
          </div>
      </div>
      <div class="row">
          <div class="col-sm-5">
              <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                  Menampilkan 1 sampai 3 dari {{$santri->total()}} data
              </div>
          </div>
          <div class="col-sm-7">
              <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{$santri->links()}}
              </div>
          </div>
      </div>
  </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
@endsection
