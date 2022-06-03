@extends('layouts.index')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Artikel</h3>

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
                Tambah Artikel <i class="fa fa-podcast"> </i>
              </button>
           </div>
           <!-- articles List -->
           <table class="table table-borderd table-responsive" id='articlesList'>
            <thead>
             <tr>
               <th>ID</th>
               <th>Kategori</th>
               <th>Penulis</th>
               <th>Judul</th>
               <th>Konten</th>
               <th>Gambar</th>
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
  <form method="POST" class="modal fade" id="isAdd"  enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Artikel</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" style="display:none"></div>
          <div class="alert alert-success" style="display:none"></div>
          <div class="col-12">
              <div class="form-group">
                <label class="form-label">Kategori</label>
                <select class="form-control" id="category_list" name="category_id">
                </select>
              </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">Judul</label>
              <input class="form-control" value="" name="title" placeholder="Ex: Php Terbaru" />
            </div>
        </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">Konten</label>
              <textarea name="content" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
              <label class="form-label">Gambar</label>
              <input type="file" name="image" accept="image/png, image/gif, image/jpeg" />
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
  <form method="POST" class="modal fade" id="isUpdate" enctype="multipart/form-data">

    @method('PUT')
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Artikel</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" style="display:none"></div>
          <div class="alert alert-success" style="display:none"></div>
          <input type="hidden" name="id" id="id_article" value=""/>
          <div class="col-12">
              <div class="form-group">
                <label class="form-label">Kategori</label>
                <select class="form-control" id="category_list_update" name="category_id">
                </select>
              </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">Judul</label>
              <input class="form-control" value="" name="title" id="title_update" placeholder="Ex: Php Terbaru" />
            </div>
        </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">Konten</label>
              <textarea name="content" id="content_update" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-12">
          <img  width="50px" height="50px" id="image_update" />
            <div class="form-group">
              <label class="form-label">Gambar</label>
              <input type="file" name="image" accept="image/png, image/gif, image/jpeg" />
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
  <!-- /.modal -->
  <div class="modal fade" id="isShow">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Artikel</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
              <tr>
                <th>Title </th>
                <td id="title_article"></td>
              </tr>
              <tr>
                <th>Kategori </th>
                <td id="category_article"></td>
              </tr>
              <tr>
                <th>Dibuat Oleh </th>
                <td id="author_article"></td>
              </tr>
              <tr>
                <th>Konten </th>
                <td id="content_article"></td>
              </tr>
              <tr>
                <th>Gambar </th>
                <td id="image_article"></td>
              </tr>
              <tr>
                <th>Tanggal Dibuat </th>
                <td id="created_article"></td>
              </tr>
              <tr>
                <th>Update Terakhir </th>
                <td id="updated_article"></td>
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
@endsection
@section('script')
<script type='text/javascript'>
 $(document).ready(function() {
  const categories =  {!! json_encode($categories->toArray()) !!};
  $('#category_list').append(`<option disabled selected>Pilih salah satu..</option>`)
    categories.forEach(item => {
        console.log(item);
        $('#category_list').append(`<option value='${item.id}'>${item.name}</option>`)
    })
$('#pagination').on('click', 'a', function(e) {
    e.preventDefault();
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
});

loadPagination('{{ route('articles.index') }}?page=1');

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
    $('#articlesList tbody').empty();
    for (index in result) {
        let id = result[index].id;
        let title = result[index].title;
        let category = result[index].category.name;
        let author = result[index].user.name;
        let content = result[index].content;
        let image = result[index].image_path;
        let tr = "<tr>";
        tr += "<td>" + id + "</td>";
        tr += "<td>" + category + "</td>";
        tr += "<td>" + author + "</td>";
        tr += "<td>" + title + "</td>";
        tr += "<td>" + content + "</td>";
        tr += "<td><img src='" + image + "' width='50px' height='50px' /></td>";
        tr += `<td>
          <button type="button" class='btn btn-sm btn-primary isShow' data-id="${id}"><i class="fa fa-eye"></i> Info</button>
      <button type="button" class='btn btn-sm btn-success isUpdate' data-id="${id}" data-title="${title}"  data-image="${image}" data-category_id="${result[index].category.id}" data-content="${content}"><i class="fa fa-pencil"></i> Edit</button>
      <button type="button" class='btn btn-sm btn-danger isDelete' data-id="${id}"><i class="fa fa-trash"></i> Hapus</button>
      </td>`;
        tr += "</tr>";
        $('#articlesList tbody').append(tr);
    }
}
document.getElementById("pagination_link").addEventListener("click", function(e) {
    loadPagination($(e.target).attr('data-id'));
});

$(document).on("click", ".isShow", function() {
    var articleId = $(this).data('id');
    $.ajax({
        url: '{{ route('articles.index') }}/'+articleId,
        type: 'get',
        dataType: 'json',
        headers: {
            'Authorization': 'Bearer ' + getCookie('token'),
        },
        success: function(response) {
            $('#title_article').html(response.data.title);
            $('#category_article').html(response.data.category.name);
            $('#author_article').html(response.data.user.name);
            $('#content_article').html(response.data.content);
            $('#image_article').html(`<img src='${response.data.image_path}' widht='50px' height='50px' />`);
            $('#created_article').html(response.data.created_at);
            $('#updated_article').html(response.data.updated_at);
            $('#isShow').modal('show');
        }
    });
});

$("#isAdd").submit(function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    $('.alert-danger').hide();
    $('.alert-danger').html('');
    $('.alert-success').hide();
    $('.alert-success').html('');
    fetch("{{ route('articles.index') }}", {
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
                loadPagination('{{ route('articles.index') }}?page=1');
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
        fetch("{{ route('articles.index') }}/" + categoryId, {
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
                    alert('Berhasil menghapus Artikel');
                    loadPagination('{{ route('articles.index') }}?page=1');
                } else {
                    alert('Gagal menghapus Artikel');
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
    var categoryId = $(this).data('category_id');
    var title = $(this).data('title');
    var image = $(this).data('image');
    var content = $(this).data('content');
    var id_article = $(this).data('id');
    $('#category_list_update').append(`<option disabled>Pilih salah satu..</option>`)
    categories.forEach(item => {
        $('#category_list_update').append(`<option ${item.id == categoryId ? 'selected' : ''} value='${item.id}'>${item.name}</option>`)
    })
    $('#title_update').val(title);
    $('#id_article').val(id_article);
    $('#content_update').val(content);
    $('#image_update').attr('src', image);
    $('#isUpdate').modal('show');
    
});

$("#isUpdate").submit(function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    $('.alert-danger').hide();
    $('.alert-danger').html('');
    $('.alert-success').hide();
    $('.alert-success').html('');
    fetch("{{ route('articles.index') }}/"+$('#id_article').val(), {
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
                loadPagination('{{ route('articles.index') }}?page=1');
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