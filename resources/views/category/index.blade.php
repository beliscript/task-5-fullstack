@extends('layouts.index')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Kategori</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
           <div class="col-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#isAdd">
                Tambah Kategori <i class="fa fa-tags"> </i>
              </button>
           </div>
           <!-- Categories List -->
           <table class="table table-borderd" id='categoriesList'>
            <thead>
             <tr>
               <th>ID</th>
               <th>Nama</th>
               <th>Dibuat Oleh</th>
               <th>Aksi</th>
             </tr>
            </thead>
            <tbody></tbody>
          </table>
          
          <!-- Paginate -->
          <div id='pagination'></div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right" id="pagination_link">
      
        </ul>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <form method="POST" class="modal fade" id="isAdd">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Kategori</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" style="display:none"></div>
          <div class="alert alert-success" style="display:none"></div>
          <div class="col-12">
              <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input class="form-control" value="" name="name" placeholder="Ex: Php" />
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
  <form method="POST" class="modal fade" id="isUpdate">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Kategori</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" style="display:none"></div>
          <div class="alert alert-success" style="display:none"></div>
          <div class="col-12">
              <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input type="hidden" name="id" id="id_category" value=""/>
                <input class="form-control" value="" id="update_name" name="name" placeholder="Ex: Php" />
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
  <div class="modal fade" id="isShow">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Kategori</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
              <tr>
                <th>Nama </th>
                <td id="name_category"></td>
              </tr>
              <tr>
                <th>Dibuat Oleh </th>
                <td id="user_category"></td>
              </tr>
              <tr>
                <th>Tanggal Dibuat </th>
                <td id="created_category"></td>
              </tr>
              <tr>
                <th>Update Terakhir </th>
                <td id="updated_category"></td>
              </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection
@section('script')
<script type='text/javascript'>
 $(document).ready(function() {

$('#pagination').on('click', 'a', function(e) {
    e.preventDefault();
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
});

loadPagination('{{ route('categories.index') }}?page=1');

function loadPagination(page) {
    $.ajax({
        url: page,
        type: 'get',
        dataType: 'json',
        headers: {
            'Authorization': 'Bearer ' + getCookie('token'),
        },
        success: function(response) {
            console.log(response);
            createPagination(response.data.links);
            createTable(response.data.data);
        }
    });
}


function createPagination(links) {
    $('#pagination_link').empty();
    for (index in links) {
        let li = `<li ${links[index].active ? 'class="active"' : ''}><a style="cursor:pointer;" ${links[index].url != null ?  'data-id="'+links[index].url+'"' : ''}>${links[index].label}</a></li>`;
        $('#pagination_link').append(li);
    }
}

function createTable(result) {
    $('#categoriesList tbody').empty();
    for (index in result) {
        var id = result[index].id;
        var name = result[index].name;
        var fullname = result[index].user.name;
        var tr = "<tr>";
        tr += "<td>" + id + "</td>";
        tr += "<td>" + name + "</td>";
        tr += "<td>" + fullname + "</td>";
        tr += `<td>
      <button type="button" class='btn btn-sm btn-primary isShow' data-id="${id}"><i class="fa fa-eye"></i> Info</button>
      <button type="button" class='btn btn-sm btn-success isUpdate' data-id="${id}" data-name="${name}"><i class="fa fa-pencil"></i> Edit</button>
      <button type="button" class='btn btn-sm btn-danger isDelete' data-id="${id}"><i class="fa fa-trash"></i> Hapus</button>
      </td>`;
        tr += "</tr>";
        $('#categoriesList tbody').append(tr);
    }
}
document.getElementById("pagination_link").addEventListener("click", function(e) {
    loadPagination($(e.target).attr('data-id'));
});

$("#isAdd").submit(function(event) {
    event.preventDefault();
    const formData = new URLSearchParams(new FormData(this));
    $('.alert-danger').hide();
    $('.alert-danger').html('');
    $('.alert-success').hide();
    $('.alert-success').html('');
    fetch("{{ route('categories.index') }}", {
            method: 'POST',
            mode: 'same-origin',
            credentials: 'same-origin',
            body: formData,
            headers: {
                'Authorization': 'Bearer ' + getCookie('token'),
            }
        })
        .then(function(response) {
            return response.json();
        }).then(function(text) {
            console.log()
            if (text.status == true) {
                $('.alert-success').show();
                $('.alert-success').append('<p>' + text.message + '</p>');
                loadPagination('{{ route('categories.index') }}?page=1');
                document.getElementById("isAdd").reset();
            } else {
                $.each(text.errors, function(key, value) {
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>' + value + '</p>');
                });
            }
        }).catch(function(err) {
            alert(err);
        });
});
$(document).on("click", ".isDelete", function() {
    var categoryId = $(this).data('id');
    if (confirm("Apakah yakin akan menghapus ?") == true) {
        fetch("{{ route('categories.index') }}/" + categoryId, {
                method: 'DELETE',
                mode: 'same-origin',
                credentials: 'same-origin',
                headers: {
                    'Authorization': 'Bearer ' + getCookie('token'),
                }
            })
            .then(function(response) {
                return response.json();
            }).then(function(text) {
                console.log()
                if (text.status == true) {
                    alert('Berhasil menghapus kategori');
                    loadPagination('{{ route('categories.index') }}?page=1');
                } else {
                    alert('Gagal menghapus kategori');
                }
            }).catch(function(err) {
                alert(err);
            });
    }
});
$(document).on("click", ".isUpdate", function() {
    $('.alert-danger').hide();
    $('.alert-danger').html('');
    $('.alert-success').hide();
    $('.alert-success').html('');
    var categoryId = $(this).data('id');
    var categoryName = $(this).data('name');
    $('#update_name').val(categoryName);
    $('#id_category').val(categoryId);
    $('#isUpdate').modal('show');
    
});
$(document).on("click", ".isShow", function() {
    var categoryId = $(this).data('id');
    $.ajax({
        url: '{{ route('categories.index') }}/'+categoryId,
        type: 'get',
        dataType: 'json',
        headers: {
            'Authorization': 'Bearer ' + getCookie('token'),
        },
        success: function(response) {
            $('#name_category').html(response.data.name);
            $('#user_category').html(response.data.user.name);
            $('#created_category').html(response.data.created_at);
            $('#updated_category').html(response.data.updated_at);
            $('#isShow').modal('show');
        }
    });
});

$("#isUpdate").submit(function(event) {
    event.preventDefault();
    const formData = new URLSearchParams(new FormData(this));
    $('.alert-danger').hide();
    $('.alert-danger').html('');
    $('.alert-success').hide();
    $('.alert-success').html('');
    fetch("{{ route('categories.index') }}/"+$('#id_category').val(), {
            method: 'PUT',
            mode: 'same-origin',
            credentials: 'same-origin',
            body: formData,
            headers: {
                'Authorization': 'Bearer ' + getCookie('token'),
            }
        })
        .then(function(response) {
            return response.json();
        }).then(function(text) {
            console.log()
            if (text.status == true) {
                $('.alert-success').show();
                $('.alert-success').append('<p>' + text.message + '</p>');
                loadPagination('{{ route('categories.index') }}?page=1');
                document.getElementById("isAdd").reset();
            } else {
                $.each(text.errors, function(key, value) {
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>' + value + '</p>');
                });
            }
        }).catch(function(err) {
            alert(err);
        });
});

});
   

   </script>

@endsection