<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_form = $(this).attr('data-form');
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_form);

    $('.delete-title').html(data_title);
    $('.delete-id').val(delete_id);
  });  
});
$(".setting").addClass( "menu-is-opening menu-open");
$(".setting a").addClass( "active-menu");


$( ".row_position" ).sortable({
      stop: function() {
			var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            console.log(selectedData);
            updateOrder(selectedData);

        }
  });

  function updateOrder(data) {
  $.ajax({
      url:"{{url('api')}}/admin/item/update-item-priority",
      type:'post',
      data:{position:data, table: 'top_inflatable'},
      success:function(result){
        console.log(result);
      }
  })
}

function updateStatus($id) {
  $.ajax({
      url:"{{route('status.update')}}",
      type:'post',
      data:{id:$id, table: 'top_inflatable'},
      success:function(result){
        console.log(result);
      }
  })
}



</script>

<div class="content-wrapper">

    <section class="content">
    <div class="cmsModal-formGroup">
      <div class="container-fluid">
      
        <div class="row">
        
        <div class="col-md-6">
              <div class="">
                      <h3 class="">Header Js</h3>
                </div>
                <form id="ajaxForm" method="post" enctype="multipart/form-data"  class="form-horizontal" 
                action="{{route('customJs.store')}}">
                  @csrf
                  <div class=" p-2 pt-4">
                  <input type="hidden" name="type" value="header-code">
                   <div class="form-group row">
                      <div class="col-sm-12">
                            <textarea name="description" class="cmsModal-formControl" rows="14" cols="14" 
                            placeholder="Paste your js code here">{{$headerJs->description}}</textarea>
                            <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">Save Header Code</button>
                  </div>
                </form>

              </div>

            <div class="col-md-6">
              <div class="">
                      <h3 class="">Footer Js</h3>
                </div>
                <form id="ajaxForm" method="post" enctype="multipart/form-data"  class="form-horizontal" 
                action="{{route('customJs.store')}}">
                  @csrf
                  <div class=" p-2 pt-4">
                  <input type="hidden" name="type" value="footer-code">
                   <div class="form-group row">
                      <div class="col-sm-12">
                            <textarea name="description"  class="cmsModal-formControl" rows="14" 
                            cols="14" placeholder="Paste your js code here">{{$footerJs->description}}</textarea>
                            <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-dark">Save Footer Code</button>
                  </div>
                </form>

              </div>
            </div>


      </div>
      </div>
    </section>
  </div>



  