<script>
  $('#mdate').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    weekStart: 0,
    time: false
  });

  $('#salaryStartDate').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    weekStart: 0,
    time: false,
    minDate: new Date($('#salaryStartDate').val())
  });

  $('.servicesList').multiSelect({
    selectableHeader: "<div class='custom-header'>All services</div>",
    selectionHeader: "<div class='custom-header'>User services</div>",
  });

  $('.storesList').multiSelect({
    selectableHeader: "<div class='custom-header'>All stores</div>",
    selectionHeader: "<div class='custom-header'>User stores</div>",
  });

  $.ajax({
    url: "getValuts",
    type: 'GET',
    dataType: 'json',
    context: document.body,
    success: function(resp){
      let tpl = '';
      resp.forEach(function(item) {
        tpl += '<option value="'+item.id+'">'+item.sign+'</option>';
      });

      $('#valuts').html(tpl);
    }
  });

  $.ajax({
    url: "getRoles",
    type: 'GET',
    dataType: 'json',
    context: document.body,
    success: function(resp){
      let tpl = '';
      resp.forEach(function(item) {
        let selected = item.id == {{$user->role_id}} ? 'selected' : '';
        tpl += '<option '+selected+' value="'+item.id+'">'+item.title+'</option>';
      });

      $('#roles').html(tpl);
    }
  });

  $.ajax({
    url: "getCities",
    type: 'GET',
    dataType: 'json',
    context: document.body,
    success: function(resp){
      let tpl = '';
      resp.forEach(function(item) {
        let selected = item.id == {{$user->city_id}} ? 'selected' : '';
        tpl += '<option '+selected+' value="'+item.id+'">'+item.title+'</option>';
      });

      $('#cities').html(tpl);
    }
  });

  function storeEmployee() {
    let data = $('#form-store-user').serialize();
    $.ajax({
      url: "storeEmployee",
      type: 'POST',
      dataType: 'json',
      data: data,
      context: document.body,
      success: function(resp){
        Swal.fire(
          'Success!',
          'User has been success.',
          'success'
        );
        $("#employeesGrid").jsGrid("loadData");
      }
    });
  }
</script>
<style>
  .ms-container{
    width: 100%;
  }
</style>
<div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="mainModalLabel">{{!$new ? $user->name : 'New user'}}</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="form-store-user" class="form-horizontal m-t-10" action="storeEmployee" method="POST">
            <input type="text" name="user_id" hidden value="{{!$new ? $user->id : 'new'}}">
            <div class="form-group">
              <label>Name</label>
              <input name="name" value="{{!$new ? $user->name : ''}}" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Role</label>
              <select id="roles" name="role_id" class="form-control"></select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input name="email" value="{{!$new ? $user->email : ''}}" type="email" class="form-control">
            </div>
            <div class="form-group">
              <label>City</label>
              <select id="cities" name="city_id" class="form-control"></select>
            </div>
            <div class="form-group">
              <label>Birthday</label>
              <input name="birthday" type="date" value="{{!$new ? $user->birthday : ''}}" class="form-control" id="mdate">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input name="address" value="{{!$new ? $user->address : ''}}" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label>Salary</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="valuts" name="salary[valut_id]"></select>
                </div>
                <input required="" name="salary[salary]" value="{{!$new && $user->currentSalary ? $user->currentSalary->salary : ''}}" type="text" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">+</span>
                </div>
                <input name="salary[percent]" value="{{!$new && $user->currentSalary ? $user->currentSalary->add_percent : '0'}}" type="text" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Start at:</span>
                </div>
                <input id="salaryStartDate" name="salary[start_date]" value="{{!$new && $user->currentSalary ? $user->currentSalary->start_date : date('Y-m-d')}}" type="date" class="form-control">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">Tarif:</span>
                </div>
                <select name="salary[tarif]">
                  <option>year</option>
                  <option>month</option>
                  <option>week</option>
                  <option>hour</option>
                </select>
              </div> --}}
            </div>
            <div class="form-group">
              <label>Services</label>
              <select class="servicesList m-b-10 select2-multiple" name="services[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                @foreach($services as $service)
                  <option {{in_array($service->id, $user->services->modelKeys()) ? 'selected="selected"' : ''}} value="{{$service->id}}">{{$service->title}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Stores</label>
              <select class="storesList m-b-10 select2-multiple" name="stores[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                @foreach($stores as $store)
                  <option {{in_array($store->id, $user->stores->modelKeys()) ? 'selected="selected"' : ''}} value="{{$store->id}}">{{$store->title}}({{$store->city->title}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Status</label>
              <br>
              <div class="switch">
                <label>Active<input type="checkbox" name="status" {{!$new && !$user->status ? 'checked=""' : ''}}><span class="lever"></span>Banned</label>
              </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="storeEmployee()" class="btn btn-primary">Save</button>
    </div>
</div>