<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>

                <th scope="col">Id Supplier</th>
                <th scope="col">Nama</th>
                <th scope="col">Toko</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Telp</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @php($i=1)

            @foreach($supplier as $s)
                <tr>
                    <td id="id{{$s->id_supplier}}">{{$s->id}}
                    </td>
                    <td>
                        <div id="nama{{$s->id_supplier}}">{{$s->nama_supplier}}</div>
                    </td>
                    <td>
                        <div id="toko{{$s->id_supplier}}">{{$s->nama_toko}}</div>
                    </td>
                    <td>
                        <div id="alamat{{$s->id_supplier}}">{{$s->alamat}}</div>
                    </td>
                    <td>
                        <div id="no_telp{{$s->id_supplier}}">{{$s->no_telp}}</div>
                    </td>
                    <td>

                            <div class="menu-item px-3">
                                <span  title="Edit supplier">
                                    <button onclick="lempar({{$s->id_supplier}})">Edit</a>
                                </span>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <button onclick="javascript:window.open('supplier/hapus/{{$s->id_supplier}}','_self')">Hapus</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>

                </tr>

            @php($i++)
            @endforeach

        </tbody>
    </table>
</body>
</html>
