@if(session()->has('flash_message'))
  @if(session('flash_message.key')==null)
    <script type="text/javascript">
    swal({
          title: '{{session('flash_message.title')}}',
          text: '{{session('flash_message.message')}}',
          type: '{{session('flash_message.level')}}',
          showConfirmButton: false,
          timer: 2000
          })
    </script>
  @else
    <script type="text/javascript">
    swal({
          title: "{!!session('flash_message.title')!!}",
          text: "{!!session('flash_message.message')!!}",
          type: "{!!session('flash_message.level')!!}",
          confirmButtonText: 'Ok'
          })
    </script>
  @endif
@endif
