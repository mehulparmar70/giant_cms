
@if(Session::get('success'))
          <script>
            $(function() {

              /*var Toast = Swal.mixin({
                toast: true,
                // position: 'bottom',
                showConfirmButton: false,
                timer: 3000
              });*/
            });
            toastr.options = {
                "positionClass": "toast-top-center",
                "showEasing": "swing",
                "showMethod": "show",
            };
            toastr.success(`{{ Session::get('success')}}`);
          </script>
          @if(Session::get('close'))
            <script>
              setTimeout(myGreeting, 5000);
              function myGreeting() {
                // window.top.close();
                $('.onscreenCloseBtn').trigger("click");
              }
            </script>
          @endif
    @elseif(Session::get('fail'))

    <script>
            $(function() {
              /*var Toast = Swal.mixin({
                toast: true,
                // position: 'bottom',
                showConfirmButton: false,
                timer: 3000
              });*/
            });
            toastr.options = {
                "positionClass": "toast-top-center",
                "showEasing": "swing",
                "showMethod": "show",
                
            };
            toastr.error(`{{Session::get('fail')}}`);
          </script>

@endif