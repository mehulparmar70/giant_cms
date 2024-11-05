@extends('layout.admin-index')
@section('title','Dashboard - Charotar Corporation')
@section('content')

@section('custom-js')

<script>


$(".dashboard").addClass( "menu-is-opening menu-open");
$(".dashboard a").addClass( "active-menu");

</script>

<script>
  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    var sparkline1 = new Sparkline($('#sparkline-1')[0], { width: 240, height: 70, lineColor: '#92c1dc', endColor: '#92c1dc' })
    var sparkline2 = new Sparkline($('#sparkline-2')[0], { width: 240, height: 70, lineColor: '#f56954', endColor: '#f56954' })
    var sparkline3 = new Sparkline($('#sparkline-3')[0], { width: 240, height: 70, lineColor: '#3af221', endColor: '#3af221' })

    sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
    sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
    sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

  })

</script>


@endsection

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <section class="content">
      <div class="container-fluid">


      <div class="row">
          <div class="col-12">
            <!-- jQuery Knob -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Total Data Entries:
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row dashboard-top-button">

                <div class="col text-center block">
                    <a href="{{route('admin.category.list')}}?type=main_category">
                    <input type="text" class="knob" value="{{getItemCount()['totalMainCategories']}}" data-width="90" data-height="90" data-fgColor="#3c8dbc"
                           data-readonly="true" disabled>
                          <div class="knob-label" style="color:#3c8dbc">MAIN CATEGORIES</div></a>
                </div>

                  <div class="col text-center block">
                    <a href="{{route('admin.category.list')}}?type=sub_category">
                    <input type="text" class="knob" value="{{getItemCount()['totalSubCategories']}}" 
                      data-width="90" data-height="90" data-fgColor="#dc3545"
                           data-readonly="true" disabled>
                          <div class="knob-label" style="color:#dc3545">SUB CATEGORIES</div></a>
                  </div>
                  
                  <!-- <div class="col text-center block">
                           <a href="{{route('product.index')}}">
                    <input type="text" class="knob"  value="{{getItemCount()['totalProducts']}}" data-width="90" data-height="90"data-width="90"
                           data-height="90" data-fgColor="#dc3545"  data-readonly="true" disabled>

                           <div class="knob-label" style="color:#dc3545">PRODUCTS</div></a>
                  </div>
                   -->
                  <div class="col text-center block">
                    <a href="{{route('blog.index')}}">
                    <input type="text" class="knob" value="{{getItemCount()['totalBlogs']}}" data-width="90" data-height="90"
                     data-fgColor="#932ab6"   data-readonly="true" disabled>
                    <div class="knob-label" style="color:#932ab6">BLOGS</div></a>
                  </div>
                  
                  <div class="col text-center block">
                    <a href="{{route('testimonials.index')}}">
                    <input type="text" class="knob" value="{{getItemCount()['totalTestimonials']}}" data-width="90" data-height="90" 
                    data-fgColor="rgb(29 117 49)"  data-readonly="true" disabled>
                    <div class="knob-label" style="color:rgb(29 117 49)">TESTIMONIALS</div></a>
                  </div>
                  
                  <div class="col text-center block">
                    <a href="{{route('video.index')}}">
                    <input type="text" class="knob" value="{{getItemCount()['totalVideos']}}"
                     data-width="90" data-height="90" 
                    data-fgColor="rgb(43 45 45)"  data-readonly="true" disabled>
                    <div class="knob-label" style="color:rgb(43 45 45)">VIDEOS</div></a>
                  </div>
                  
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <div class="container-fluid">
          


        <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Add Data:
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">

                <div class="col-4 col-sm-3 col-md-2">
            <a href="{{route('slider.index')}}" class="text-dark">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-picture-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ADD Slider</span>
              </div>
            </div>
            </a>
          </div>
                
          

                <div class="col-4 col-sm-3 col-md-2">
                <a href="{{route('blog.create')}}" class="text-info">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list-ol"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">ADD CATEGORIES</span>
                  </span>
                </div>

              </div>
            </div>

          <!-- <div class="col-4 col-sm-3 col-md-2">
          <a href="{{route('product.create')}}" class="text-danger">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ADD PRODUCTS</span>
              </div>
            </div>
            </a>
          </div> -->

          <div class="clearfix hidden-md-up"></div>

          <div class="col-4 col-sm-3 col-md-2">
          <a href="{{route('blog.create')}}"  class="text-success">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-pencil-square-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ADD BLOGS</span>
              </div>
            </div>
          </a>
          </div>

          <div class="col-4 col-sm-3 col-md-2">
          <a href="{{route('testimonials.create')}}" class="text-warning">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-address-card-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ADD TESTIMONIAL</span>
              </div>
            </div>
          </a>
          </div>
          
          <div class="col-4 col-sm-3 col-md-2">
          <a href="{{route('video.create')}}" style="color:#932ab6;background:#932ab6">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" 
              style="background:#932ab6"><i class="fa fa-video-camera text-light"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" >ADD VIDEO</span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

              </div>
              <!-- /.card-body -->
            </div>

        </div>
        
        <!-- Add Data: -->
        


        <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Manage Blocks:
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                
        <div class="row">
          <div class="col">
          <a href="{{route('admin.setting.seo-manage')}}" class="text-info">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-bar-chart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SEO</span>
                </span>
              </div>

            </div>
          </div>

          <div class="col">
          <a href="{{route('setting.social-media')}}" class="text-danger">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-facebook"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SOCIAL MEDIA</span>
              </div>
            </div>
            </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col">
          <a href="{{route('admin.customJs.create')}}"  class="text-success">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-header"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">HEADER / FOOTER</span>
              </div>
            </div>
          </a>
          </div>

          <div class="col">
          <a href="{{route('slider.index')}}" class="text-warning">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-picture-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SLIDERS</span>
              </div>
            </div>
          </a>
          </div>
          
          <div class="clearfix hidden-md-up"></div>

          <div class="col">
            <a href="{{route('client.index')}}" class="text-dark">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">CLIENTS</span>
                </div>
              </div>
              </a>
          </div>
        </div>
              </div>
              <!-- /.card-body -->
            </div>

        </div>
        
        
        
      </div>
      
    </section>
    
  </div>
  

  @endsection