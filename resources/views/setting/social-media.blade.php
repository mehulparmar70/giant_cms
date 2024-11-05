
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    var data_url = $(this).attr('data-url');
    
    $('.delete-form').attr('action','/admin/url-list1/delete/'+ delete_id);
    $('.delete-title').html(data_title);
    $('.delete-url').attr('src',data_url);
  });  
});


$(".setting").addClass( "menu-is-opening menu-open");
$(".setting a").addClass( "active-menu");

</script>

@include('widget.table-search-draggable')

<div class="content-wrapper">
    


    <div >
                	<div class="row">
                    <div class="col-md-10">
                    <form id="socialmediaajax" role="form"  method="post" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="cmsModal-formGroup">
                        {{csrf_field()}}
                    <h5 class="text-danger text-center">Social Button</h5>
                      <table data-table="clients" class="table table-hover text-nowrap" id="clienttable" >
                        <tr>
                          <td width="30%"><label for="title" class="cmsModal-formLabel">Facebook</label></td>
                          <td><input type="url" class="cmsModal-formControl" id="facebook"  name="facebook" value="@if(old('facebook')){{old('facebook')}}@else{{$socialMedia->facebook}}@endif" placeholder="Facebook Profile"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Instagram</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="instagram"  name="instagram" value="@if(old('instagram')){{old('instagram')}}@else{{$socialMedia->instagram}}@endif" placeholder="Instagram Profile"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Twitter</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="twitter"  name="twitter" value="@if(old('twitter')){{old('twitter')}}@else{{$socialMedia->twitter}}@endif" placeholder="Twitter Profile"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Youtube</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="youtube"  name="youtube" value="@if(old('youtube')){{old('youtube')}}@else{{$socialMedia->youtube}}@endif" placeholder="Youtube Channel"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">LinkedIn</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="linkedin"  name="linkedin" value="@if(old('linkedin')){{old('linkedin')}}@else{{$socialMedia->linkedin}}@endif" placeholder="LinkedIn Profile"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Pinterest</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="pinterest"  name="pinterest" value="@if(old('pinterest')){{old('pinterest')}}@else{{$socialMedia->pinterest}}@endif" placeholder="pinterest Profile"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Skype</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="skype"  name="skype" value="@if(old('skype')){{old('skype')}}@else{{$socialMedia->skype}}@endif" placeholder="Skype Profile"></td>
                        </tr>

                        
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Email Id</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="email"  name="email" value="@if(old('email')){{old('email')}}@else{{$socialMedia->email}}@endif" placeholder="Email Id"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Phone No</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="phone"  name="phone" value="@if(old('phone')){{old('phone')}}@else{{$socialMedia->phone}}@endif" placeholder="Phone Number"></td>
                        </tr>
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Whatsapp No</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="whatsapp"  name="whatsapp" value="@if(old('whatsapp')){{old('whatsapp')}}@else{{$socialMedia->whatsapp}}@endif" placeholder="Whatsapp Number"></td>
                        </tr>
                        
                        <tr>
                          <td><label for="title" class="cmsModal-formLabel">Whatsapp Group</label></td>
                          <td><input type="text" class="cmsModal-formControl" id="whatsapp_group"  name="whatsapp_group" value="@if(old('whatsapp_group')){{old('whatsapp_group')}}@else{{$socialMedia->whatsapp_group}}@endif" placeholder="Whatsapp Group Link"></td>
                        </tr>

                        <tr>
                          <td><label for="address" class="cmsModal-formLabel">Address</label></td>
                          <td><textarea type="text" class="cmsModal-formControl" id="address"  name="address" placeholder="Address Here">@if(old('address')){{old('address')}}@else{{$socialMedia->address}}@endif</textarea></td>
                        </tr>
  
                          <tr>
                            <td colspan="2">
                            <h5 class="text-danger text-center">API Code</h5></td>
                          </tr>

                          <tr>
                            <td><label for="title">TinyPng</label></td>
                            <td><input type="text" class="cmsModal-formControl" id="tinypng"  name="tinypng" 
                              placeholder="Tiny Png Api Key" 
                              value="@if(old('tinypng')){{old('tinypng')}}@else{{$socialMedia->tinypng}}@endif"></td>
                          </tr>

                          <tr>
                            <td colspan="2">
                            <h5 class="text-danger text-center">Embed Code</h5></td>
                          </tr>
                          <tr>
                            <td><label for="title">Youtube Embed</label></td>
                            <td><textarea type="text" class="cmsModal-formControl" id="twitter"  name="youtube_embed" 
                              placeholder="Youtube Embed Code">@if(old('youtube_embed')){{old('youtube_embed')}}@else{{$socialMedia->youtube_embed}}@endif</textarea></td>
                          </tr>
                          <tr>
                            <td><label for="title">Google Map Embed</label></td>
                            <td><textarea type="text" class="cmsModal-formControl" id="map_embed"  name="map_embed" 
                              placeholder="Google Map Embed">@if(old('map_embed')){{old('map_embed')}}@else{{$socialMedia->map_embed}}@endif</textarea></td>
                          </tr>
                        
                        <tr>
                          <td><label for="title">Facebook Embed</label></td>
                          <td><textarea type="text" class="cmsModal-formControl" id="facebook_embed"  name="facebook_embed" 
                          placeholder="Signal Group Link">@if(old('facebook_embed')){{old('facebook_embed')}}@else{{$socialMedia->facebook_embed}}@endif</textarea></td>
                        </tr>
                        
                        <tr>
                          <td colspan="2">
                          <h5 class="text-danger text-center">Product</h5></td>
                        </tr>

                        <tr>
                          <td><label for="title">Product Title</label></td>
                          <td><textarea type="text" class="cmsModal-formControl" id="facebook_embed"  name="product_title" 
                          placeholder="Product Title">@if(old('product_title')){{old('product_title')}}@else{{$socialMedia->product_title}}@endif</textarea></td>
                        </tr>

                        <tr>
                          <td></td>
                          <td><button type="button" onclick="editsocialmediasubmit()" class="cmsBtn blue"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Update </button></td>
                        </tr>

                      </table>
</div>
                      </form>
                  </div>
                </div>
                </div>
                </div>


