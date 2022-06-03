@extends('layouts.index')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Dashboard</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3 id="total_categories">0</h3>
  
                <p>Total Kategori</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
              <a href="{{ route('category') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3 id="total_articles">0</h3>
  
                <p>Total Artikel</p>
              </div>
              <div class="icon">
                <i class="ion ion-book"></i>
              </div>
              <a href="{{ route('article') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

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
@endsection
@section('script')
<script type='text/javascript'>
    $(document).ready(function() {
        fetch("{{ route('api.dashboard') }}", {
            method: 'GET',
            mode: 'same-origin',
            credentials: 'same-origin',
            headers: {
                'Authorization': 'Bearer ' + getCookie('token'),
            }
        })
        .then(function(response) {
            return response.json();
        }).then(function(text) {
            if (text.status == true) {
                $('#total_categories').html(text.data.categories);
                $('#total_articles').html(text.data.articles);
            } 
        }).catch(function(err) {
            alert(err);
        });
    });
    </script>
@endsection