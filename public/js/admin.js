! function(document, window, $) {
  "use strict";

  window.getCategories = function() {
    $.ajax({
      url: "/admin/getCategories",
      type: 'GET',
      dataType: 'json',
      context: document.body,
      success: function(resp){
        let data = resp;
        window.categoriesTree = $('#categoriesTree').tree({
                                  primaryKey: 'id',
                                  textField: 'title',
                                  uiLibrary: 'bootstrap4',
                                  dataSource: data,
                                  checkboxes: true
                                });
      }
    });
  }

  window.getSizes = function() {
    $.ajax({
      url: "/admin/getSizes",
      type: 'GET',
      dataType: 'json',
      context: document.body,
      success: function(resp){
        let tpl = '';
        resp.forEach(function(item) {
          tpl += '<label class="custom-control custom-checkbox">'+
                    '<input name="sizes[]" type="checkbox" class="custom-control-input">'+
                    '<span class="custom-control-label">'+item.title+' ('+item.products_count+')</span>'+
                  '</label>';
        });

        $('#productSizes').html(tpl);
      }
    });
  }

  window.storeCategory = function(id) {
    if(!id) id = 'new';
    let params = $('#categoriesForm').serialize();

    $.ajax({
      url: "admin/storeCategory",
      type: 'GET',
      data: params,
      dataType: 'html',
      context: document.body,
      success: function(resp){
        window.getCategories();
      }
    });
  };


  window.editItem = function (id, url) {
    if(!id) id = 'new';

    if(url == 'productWindow') window.location.href = 'goods/'+id;


    url += '?id='+id;
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'html',
      context: document.body,
      success: function(resp){
        $('#mainModal .modal-dialog').html(resp);
      }
    });
  };
  window.deleteItem = function (id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
      $.ajax({
        url: "deleteUser?id="+id,
        type: 'get',
        dataType: 'html',
        context: document.body,
        success: function(resp){
          Swal.fire(
            'Success!',
            'User has been deleted.',
            'success'
          )
        }
      });
      }
    })
  };

  $(document).ready(function($) {
      window.services = [];
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      /*GETTING SERVICES*/
      $.ajax({
        url: "/admin/getServices",
        type: 'GET',
        dataType: 'json',
        context: document.body,
        success: function(resp){
          window.services = resp;
          let tpl = '';
          resp.forEach(function(item) {
            tpl += '<li><a href="/admin/'+item.url+'"><i class="fas fa-'+item.icon+'"></i> '+item.title+'</a></li>';
          });
          $('#sidebarnav').html(tpl);
        }
      });

    }), jsGrid.setDefaults({
      tableClass: "jsgrid-table table table-striped table-hover"
    }), jsGrid.setDefaults("text", {
      _createTextBox: function() {
        return $("<input>").attr("type", "text").attr("class", "form-control input-sm")
      }
    }), jsGrid.setDefaults("number", {
      _createTextBox: function() {
        return $("<input>").attr("type", "number").attr("class", "form-control input-sm")
      }
    }), jsGrid.setDefaults("textarea", {
      _createTextBox: function() {
        return $("<input>").attr("type", "textarea").attr("class", "form-control")
      }
    }), jsGrid.setDefaults("control", {
      _createGridButton: function(cls, tooltip, clickHandler) {
        var grid = this._grid;
        return $("<button>").addClass(this.buttonClass).addClass(cls).attr({
          type: "button",
          title: tooltip
        }).on("click", function(e) {
          clickHandler(grid, e)
        })
      }
    }), jsGrid.setDefaults("select", {
      _createSelect: function() {
        var $result = $("<select>").attr("class", "form-control input-sm"),
          valueField = this.valueField,
          textField = this.textField,
          selectedIndex = this.selectedIndex;
        return $.each(this.items, function(index, item) {
          var value = valueField ? item[valueField] : index,
            text = textField ? item[textField] : item,
            $option = $("<option>").attr("value", value).text(text).appendTo($result);
          $option.prop("selected", selectedIndex === index)
        }), $result
      }
    }),
    function() {
      var listField = function(config) {
        jsGrid.Field.call(this, config);
      }, actionField = function(config) {
        jsGrid.Field.call(this, config);
      };

      listField.prototype = new jsGrid.Field({
        itemTemplate: function(value) {
          let tpl = '';
          if(!value.length) return '-';

          value.forEach(function(item, index) {
            tpl += item.title;
            if(index != value.length-1) tpl += ', ';
          });
          return tpl;
        },
      });

      actionField.prototype = new jsGrid.Field({
        itemTemplate: function(value,item) {
          let url = '';
          if('role_id' in item && 'email' in item) url = "userEditWindow";
          else if('sale_prc' in item && 'price' in item) url = 'productWindow';

          return '<a class="grid-action-btn" data-toggle="modal" data-target="#mainModal" onclick="window.editItem('+value+', \''+url+'\')" style="font-size:21px;color:#2f90b2"><i class="mdi mdi-settings"></i></a>';
        },
      });

      jsGrid.fields.list = listField;
      jsGrid.fields.action = actionField;

      $("#servicesGrid").jsGrid({
        height: "500px",
        width: "100%",
        filtering: !0,
        editing: !0,
        sorting: !0,
        paging: !0,
        autoload: !0,
        inserting: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Are sure?",
        controller: {
          loadData: function(filter) {
            return $.ajax({
                type: "GET",
                url: "getServices",
                data: filter
              });
          },

          insertItem: function(item) {
            item.id = 'new';
            $.ajax({
              url: "storeService",
              data: item,
              type: 'POST',
              dataType: 'json',
              context: document.body,
              success: function(resp){
                Swal.fire(
                  'Added!',
                  'Service has been added.',
                  'success'
                )
              }
            });
            $("#servicesGrid").jsGrid("refresh");
          },

          updateItem: function(item) { },

          deleteItem: function(item) {
            $.ajax({
              url: "deleteService",
              data: item,
              type: 'POST',
              dataType: 'json',
              context: document.body,
              success: function(resp){
                Swal.fire(
                  'Deleted!',
                  'Service has been deleted.',
                  'success'
                )
              }
            });

            $("#servicesGrid").jsGrid("refresh");
          }
        },
        fields: [{
          name: "title",
          type: "text",
          width: 150
        }, {
          name: "description",
          type: "text",
          width: 150
        }, {
          name: "url",
          type: "text",
          width: 150
        }, {
          name: "icon",
          type: "text",
          width: 150
        }, {
          type: "control"
        }]
      });

      $("#citiesGrid").jsGrid({
        height: "500px",
        width: "100%",
        filtering: !0,
        editing: !0,
        sorting: !0,
        paging: !0,
        autoload: !0,
        inserting: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Are sure?",
        controller: {
          loadData: function(filter) {
            return $.ajax({
                type: "GET",
                url: "getCities",
                data: filter,
                success: function(resp) {
                  let citiesList = resp;
                  $("#storesGrid").jsGrid({
                    height: "500px",
                    width: "100%",
                    filtering: !0,
                    editing: !0,
                    sorting: !0,
                    paging: !0,
                    autoload: !0,
                    inserting: true,
                    pageSize: 15,
                    pageButtonCount: 5,
                    deleteConfirm: "Are sure?",
                    controller: {
                      loadData: function(filter) {

                        return $.ajax({
                            type: "GET",
                            url: "getStores",
                            data: filter
                          });
                      },

                      insertItem: function(item) {
                        item.id = 'new';
                        item.users_count = 0;

                        $.ajax({
                          url: "storeStore",
                          data: item,
                          type: 'POST',
                          dataType: 'json',
                          context: document.body,
                          success: function(resp){
                            Swal.fire(
                              'Success!',
                              'Store has been added.',
                              'success'
                            )
                          }
                        });
                        $("#storesGrid").jsGrid("loadData");
                      },

                      updateItem: function(item) {
                        $.ajax({
                          url: "storeStore",
                          data: item,
                          type: 'POST',
                          dataType: 'json',
                          context: document.body,
                          success: function(resp){
                            Swal.fire(
                              'Success!',
                              'Store has been updated.',
                              'success'
                            )
                          }
                        });
                      },

                      deleteItem: function(item) {
                        $.ajax({
                          url: "deleteStore",
                          data: item,
                          type: 'POST',
                          dataType: 'json',
                          context: document.body,
                          success: function(resp){
                            Swal.fire(
                              'Success!',
                              'Store has been deleted.',
                              'success'
                            )
                          }
                        });

                        $("#storesGrid").jsGrid("loadData");
                      }
                    },
                    fields: [
                      {
                        title: 'Store',
                        name: "title",
                        type: "text",
                      },
                      {
                        title: 'City',
                        name: "city_id",
                        type: "select",
                        items: citiesList,
                        valueField: "id",
                        textField: "title",
                      },
                      {
                        title: 'Priority',
                        name: "priority",
                        type: "text",
                        inserting: false,
                        editing: false,
                        filtering: false,
                      },
                      {
                        title: 'Status',
                        name: "status",
                        filtering: false,
                        type: "select",
                        items: [
                          { Name: "status", Id: -1 },
                          { Name: "active", Id: 1 },
                          { Name: "disabled", Id: 0 },
                        ],
                        valueField: "Id",
                        textField: "Name",
                      },
                      {
                        title: 'Team',
                        name: "users_count",
                        type: "text",
                        inserting: false,
                        editing: false,
                        filtering: false,
                      },
                      {
                        title: 'Date created',
                        name: "created_at",
                        type: "text",
                        inserting: false,
                        editing: false,
                        filtering: false,
                      },
                      {
                        type: "control"
                      }
                    ]
                  });
                }
              });
          },

          insertItem: function(item) {
            item.id = 'new';
            item.users_count = 0;
            item.stores_count = 0;

            $.ajax({
              url: "storeCity",
              data: item,
              type: 'POST',
              dataType: 'json',
              context: document.body,
              success: function(resp){
                Swal.fire(
                  'Success!',
                  'City has been added.',
                  'success'
                )
              }
            });
            $("#citiesGrid").jsGrid("loadData");
          },

          updateItem: function(item) {
            $.ajax({
              url: "storeCity",
              data: item,
              type: 'POST',
              dataType: 'json',
              context: document.body,
              success: function(resp){
                Swal.fire(
                  'Success!',
                  'City has been updated.',
                  'success'
                )
              }
            });
          },

          deleteItem: function(item) {
            $.ajax({
              url: "deleteCity",
              data: item,
              type: 'POST',
              dataType: 'json',
              context: document.body,
              success: function(resp){
                Swal.fire(
                  'Success!',
                  'City has been deleted.',
                  'success'
                )
              }
            });

            $("#citiesGrid").jsGrid("loadData");
          }
        },
        fields: [
          {
            title: 'City',
            name: "title",
            type: "text",
          },
          {
            title: 'Stores',
            name: "stores_count",
            inserting: false,
            editing: false,
            filtering: false,
            type: "number",
          },
          {
            title: 'Status',
            name: "status",
            filtering: false,
            type: "select",
            items: [
               { Name: "status", Id: -1 },
               { Name: "active", Id: 1 },
               { Name: "disabled", Id: 0 },
            ],
            valueField: "Id",
            textField: "Name",
          },
          {

            title: 'Team',
            name: "users_count",
            inserting: false,
            filtering: false,
            editing: false,
            type: "number",
          },
          {

            title: 'Date created',
            name: "created_at",
            inserting: false,
            editing: false,
            filtering: false,
            type: "text",
          },
          {
            type: "control"
          }
        ],
      });

      $("#employeesGrid").jsGrid({
        height: "500px",
        width: "100%",
        sorting: true,
        paging: true,
        autoload: true,
        filtering: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Are sure?",
        controller: {
          loadData: function(filter) {
            return $.ajax({
                type: "GET",
                dataType: 'json',
                url: "getEmployees",
                data: filter
              });
          }
        },
        fields: [
          {
            name: "name",
            title: "Name",
            type: "text",
            width: 150
          }, {
            name: "stores",
            title: "Stores related",
            type: "list",
            width: 150,
            inserting: false,
            sorting: false,
            filtering: false,
            editing: false,
          }, {
            name: "role.title",
            title: "Role",
            type: "text",
            width: 150,
            filtering: false,
          }, {
            name: "login",
            title: "Login",
            type: "text",
            width: 150,
            filtering: false,
          }, {
            name: "birthday",
            title: "Birthday",
            type: "text",
            width: 150,
            filtering: false,
            visible: false,
          }, {
            name: "address",
            title: "Address",
            sorting: false,
            type: "text",
            width: 150,
            filtering: false,
            visible: false,
          }, {
            name: "current_salary.salary",
            title: "Salary",
            type: "text",
            width: 150,
            filtering: false,
          }, {
            name: "created_date",
            title: "Date created",
            type: "text",
            width: 150,
            filtering: false,
          },  {
            visible: false,
            name: "services",
            title: "Services",
            sorting: false,
            type: "list",
            width: 150,
            filtering: false,
          }, {
            name: "status_display",
            title: "Status",
            type: "text",
            filtering: false,
          }, {
            name: "id",
            align: 'center',
            title: "Actions",
            sorting: false,
            type: "action",
            width: 100,
          }
        ],
      });

      $("#goodsGrid").jsGrid({
        width: "100%",
        sorting: true,
        paging: true,
        autoload: true,
        filtering: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Are sure?",
        controller: {
          loadData: function(filter) {
            return $.ajax({
                type: "GET",
                dataType: 'json',
                url: "getProducts",
                data: filter
              });
          }
        },
        fields: [
          {
            name: "title",
            title: "Name",
            type: "text",
            width: 150
          }, {
            name: "model",
            title: "Model",
            type: "text",
            width: 150,
            inserting: false,
            sorting: false,
            filtering: false,
            editing: false,
          }, {
            name: "id",
            align: 'center',
            title: "Actions",
            sorting: false,
            type: "action",
            width: 100,
          }
        ],
      });
    }()
}(document, window, jQuery);