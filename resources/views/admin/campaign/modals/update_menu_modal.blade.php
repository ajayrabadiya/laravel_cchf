{{--  ADD MODAL --}}
<div class="modal fade" id="update_menu_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg p-9">
        <div class="modal-content modal-rounded">
            <div class="modal-header py-7 d-flex justify-content-between">
                <h2>
                    Add Menu
                </h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y m-3">
                <form action="{{ route('admin.storeMenu') }}" id="updateMenuForm" method="POST">
                    <div class="card-body pt-">
                        <div class="w-100">
                            <div class="fv-row mb-10">
                                <input type="hidden" name="menuId" id="menuId" value="">
                                <input type="hidden" id="EditMenuCampaignId" name="campaign_id"  value="{{ $campaign->id }}">
                                <label class="form-label required">Title</label>
                                <input name="title" id="EditMenuTitle" class="form-control form-control-lg form-control-solid" value="" />
                                @if ($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label required">URL</label>
                                <input name="url" id="EditMenuUrl" class="form-control form-control-lg form-control-solid" value="" />
                                @if ($errors->has('url'))
                                <div class="text-danger">{{ $errors->first('url') }}</div>
                                @endif
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="form-label required mb-3">Menu Type</label>
                                <select name="type" id="EditMenuType"  class="form-select  form-select-solid form-select-sm" data-control="select2" data-placeholder="Menu Type..." data-hide-search="false">
                                   <option></option>
                                    <option id="menuPrimary" value="primary">Primary</option>
                                    <option id="menuSecondary" value="secondary">Secondary</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="UpdateMenu" class="btn btn-lg btn-primary" data-kt-element="type-next">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
              </div>
    </div>
</div>
<script>
    $(document).ready(function() {
      $('#UpdateMenu').click(function() {
          let formData = new FormData($('#updateMenuForm')[0]);
          formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token if required

          let action = $('#updateMenuForm').attr('action');

          ajaxCall(
              action
              , 'POST'
              , formData
              , function(response) {
                  Swal.fire({
                      text: 'Menu Successfully updated'
                      , icon: 'success'
                      , confirmButtonText: "Ok"
                      , buttonsStyling: false
                      , customClass: {
                          confirmButton: "btn btn-light-primary"
                      }
                  })
                  $('#update_menu_modal').modal('hide');
                  location.reload();
              }
              , function(xhr, status, error) {
                 console.error('Error:', error);
                 let errorMessage = 'An error occurred. Please try again.';
                 if (xhr.responseJSON && xhr.responseJSON.messages) {
                     errorMessage = '<ul>';
                     $.each(xhr.responseJSON.messages, function(key, messages) {
                         $.each(messages, function(index, message) {
                             errorMessage += '<li>' + message + '</li>';
                         });
                     });
                     errorMessage += '</ul>';
                 }
                 Swal.fire({
                     html: errorMessage
                     , icon: 'error'
                     , buttonsStyling: false
                     , confirmButtonText: "Ok, got it!"
                     , customClass: {
                         confirmButton: "btn btn-light-primary"
                     }
                 });
             }
          );
      });
  });
</script>

