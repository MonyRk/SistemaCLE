    <button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal" data-target="#modal-default">Default</button>
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">@yield('titulo')</h6>
              {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button> --}}
          </div>
          
          <div class="modal-body">
              @yield('contenido')
          </div>
          
          <div class="modal-footer">
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button> 
          </div>
          
      </div>
  </div>
</div>