<script>

  // $('body').hide();


  $('.category_parent_id').on('change', function () {

    var parent = $(this).find(':selected').val();
    $.get(`{{url('api')}}/get/getPetaKacheri/` + parent, { category_parent_id: parent })
      .done(function (data) {
        // alert(JSON.stringify(data));

        if (JSON.stringify(data.length) == 0) {
          $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
        }
        else {
          $('.sub_category_parent_id').empty();
          $('.sub_category_parent_id').html('<option value="">Select Sub Category</option>');
          for (var i = 0; i < JSON.stringify(data.length); i++) {
            $('.sub_category_parent_id').append('<option value=' + JSON.stringify(data[i].id) + '>' + data[i].name + '</option>')
          }
        }
      });
    $('.category_id').val(parent);
    $('.search').val(parent);
    $('.search_link').attr('href', `{{route('product.index')}}?search=` + parent);

  });


  $('.sub_category_parent_id').on('change', function () {
    var parent = $(this).find(':selected').val();

    $.get(`{{url('api')}}/get/getDepartment/` + parent, { sub_category_parent_id: parent })
      .done(function (data) {
        // alert(JSON.stringify(data));

        if (JSON.stringify(data.length) == 0) {
          $('.subcategory2_id').html('<option>Select Sub Category2</option>');
        }
        else {
          $('.subcategory2_id').empty();
          $('.subcategory2_id').html('<option value="">Select Sub Category2</option>');
          for (var i = 0; i < JSON.stringify(data.length); i++) {
            $('.subcategory2_id').append('<option value=' + JSON.stringify(data[i].id) + '>' + data[i].name + '</option>')
          }
        }
      });
    $('.category_id').val(parent);
    $('.search_link').attr('href', `{{route('product.index')}}?search=` + parent);
    $('.search').val(parent);

  });

  $(document).ready(function () {
    $(".del-modal").click(function () {
      var delete_id = $(this).attr('data-id');
      var data_title = $(this).attr('data-title');

      $('.delete-form').attr('action', delete_id);
      $('.delete-title').html(data_title);
    });
  });


  $(".listing").addClass("menu-is-opening menu-open");
  $(".listing a").addClass("active-menu");

  function updateStatus($id) {
    $.ajax({
      url: "{{route('status.update')}}",
      type: 'post',
      data: { id: $id, table: 'product' },
      success: function (result) {
        // console.log(result);

      }
    })
  }

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');

  });

</script>



<div class="content-wrapper">



  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div >

            <div class="">
              <div class="">

                <input type="hidden" name="category_id" class="category_id">
                <div class="row">
                  <div class="col-md-6">
                  <form id="searchproduct" method="get" class="col-sm-12">
                    <select name="main_category" class="form-control category_parent_id" required>
                      <option value="">Select Main Category</option>
                      @foreach($parent_categories as $Maincategory)
                      <option value="{{$Maincategory->id}}" @if(isset($_REQUEST['main_category']) &&
                        $_REQUEST['main_category']==$Maincategory->id)
                        selected
                        @endif

                        >{{$Maincategory->name}}</option>
                      @endforeach
                    </select>
                    @if( Request::query('search') )
                    <input type="hidden" name="search" class="search" value="{{Request::query('search')}}" />
                    @else
                    <input type="hidden" name="search" class="search" value="" />

                    @endif
                    <select name="sub_category" class="form-control  mr-3 search-font1 sub_category_parent_id" required>
                      @if(isset($_REQUEST['sub_category']))
                      <option value="{{$_REQUEST['sub_category']}}">{{getCategory($_REQUEST['sub_category'])->name}}
                      </option>
                      @else
                      <option value="">Select Sub Category</option>
                      @endif
                    </select>


                    <button type="button" onclick="searchproduct()" class="btn btn-sm btn-dark search_link">
                      <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                
                </form>
              </div>
              
              <div class="col-md-6">
                <ol class=" float-sm-right"><button  onclick="popupmenu(`{{url('powerup/products/addform')}}`,'editmodal','','','','')" class="cmsBtn blue"><i class="fa fa-plus" aria-hidden="true"></i>
                  &nbsp;&nbsp;Add Product </button>
              
          </ol>
              </div>

              </div>
            </div>

            @if($products->count() > 0)
            <div id="resultproduct" class="card-body table-responsive p-0 display-data">
              <form method="post">
                <input type="hidden" name="type" value="product">
                @if(isset($request->query))
                <input type="hidden" class="media_id" value="{{$$request->query('image')}}">
                @endif

                <input type="hidden" class="image_type" value="product">




              </form>
            </div>
            @endif

          </div>
        </div>
      </div>


    </div>
  </section>
</div>