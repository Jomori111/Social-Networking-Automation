$(document).ready(function(){
    $("#company").on("change",function(){
      var id = $("#company").val();
      $("#hidden_company_id").val(id);
      $("#addon_table").jsGrid("loadData");
      $("#message_table").jsGrid("loadData");
      $("#link_table").jsGrid("loadData");
      $("#hash_table").jsGrid("loadData");

    })

    $("#add_message").on("click",function(){
        if($("#company_message").val() != "")
        {
            $.ajax({
                url : "admin_list/insert_message",
                type : "POST",
                data : {
                    message : $("#company_message").val(),
                    id : $("#hidden_company_id").val(),
                },
                dataType : "JSON",
                success : function(res)
                {
                    $("#message_table").jsGrid("loadData");
                    $("#company_message").val("");
                }
            })
        }else{
            noti("message");
        }
    })

    $("#message_table").jsGrid({
        width: "100%",
        filtering: false,
        editing: true,
        inserting: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,

        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the message?",
        controller: {
            loadData : function(filter){
                return $.ajax({
                    type : "POST",
                    url : 'admin_list/get_message_list',
                    data : {
                      id : $("#hidden_company_id").val(),
                    },
                    dataType : "JSON",

                });
            },
            deleteItem : function(item)
            {
                return $.ajax({
                    type : "DELETE",
                    url : 'admin_list/delete_message_list',
                    dataType : "JSON",
                    data : item,
                    success : function(res)
                    {
                        $("#message_table").jsGrid("loadData");
                    }
                });
            },
            updateItem : function(item)
            {
                return $.ajax({
                    type : "post",
                    url : 'admin_list/update_message_list',
                    data : item,
                    dataType : "JSON",
                    success : function(res)
                    {
                        $("#message_table").jsGrid("loadData");
                    }
                });
            }
        },

        fields: [
            { name : 'id', type: "hidden", css:'hide', width: 0},
            { name: "name", title : "Name", type: "text", width: 100},
            { name: "message", title : "message", type: "text", width: 100},
            { type: "control"}

        ]
    });


    $("#add_link").on("click",function(){
        if($("#company_nick").val() != "" || $("#company_link").val() != "")
        {
            $.ajax({
                url : "admin_list/insert_link",
                type : "POST",
                data : {
                    nick : $("#company_nick").val(),
                    link : $("#company_link").val(),
                    id : $("#hidden_company_id").val(),
                },
                dataType : "JSON",
                success : function(res)
                {
                    $("#link_table").jsGrid("loadData");
                    $("#company_message").val("");
                }
            })
        }else{
            noti("link");
        }
    })

    $("#link_table").jsGrid({
        width: "100%",
        filtering: false,
        editing: true,
        inserting: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,

        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the message?",
        controller: {
            loadData : function(filter){
                return $.ajax({
                    type : "POST",
                    url : 'admin_list/get_link_list',
                    data : {
                      id : $("#hidden_company_id").val(),
                    },
                    dataType : "JSON",

                });
            },
            deleteItem : function(item)
            {
                return $.ajax({
                    type : "DELETE",
                    url : 'admin_list/delete_link_list',
                    dataType : "JSON",
                    data : item,
                    success : function(res)
                    {
                        $("#link_table").jsGrid("loadData");
                    }
                });
            },
            updateItem : function(item)
            {
                return $.ajax({
                    type : "post",
                    url : 'admin_list/update_link_list',
                    data : item,
                    dataType : "JSON",
                    success : function(res)
                    {
                        $("#link_table").jsGrid("loadData");
                    }
                });
            }
        },

        fields: [
            { name : 'id', type: "hidden", css:'hide', width: 0},
            { name: "nick", title : "Nick", type: "text", width: 100},
            { name: "link", title : "Link", type: "text", width: 100},
            { type: "control"}

        ]
    });




    $("#add_hash").on("click",function(){
        if($("#company_hash").val() != "")
        {
            $.ajax({
                url : "admin_list/insert_hash",
                type : "POST",
                data : {
                    hash : $("#company_hash").val(),
                    id : $("#hidden_company_id").val(),
                },
                dataType : "JSON",
                success : function(res)
                {
                    $("#hash_table").jsGrid("loadData");
                    $("#company_hash").val("");
                }
            })
        }else{
            noti("hashtag");
        }
    })

    $("#hash_table").jsGrid({
        width: "100%",
        filtering: false,
        editing: true,
        inserting: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,

        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the message?",
        controller: {
            loadData : function(filter){
                return $.ajax({
                    type : "POST",
                    url : 'admin_list/get_hash_list',
                    data : {
                      id : $("#hidden_company_id").val(),
                    },
                    dataType : "JSON",

                });
            },
            deleteItem : function(item)
            {
                return $.ajax({
                    type : "DELETE",
                    url : 'admin_list/delete_hash_list',
                    dataType : "JSON",
                    data : item,
                    success : function(res)
                    {
                        $("#hash_table").jsGrid("loadData");
                    }
                });
            },
            updateItem : function(item)
            {
                return $.ajax({
                    type : "post",
                    url : 'admin_list/update_hash_list',
                    data : item,
                    dataType : "JSON",
                    success : function(res)
                    {
                        $("#hash_table").jsGrid("loadData");
                    }
                });
            }
        },

        fields: [
            { name : 'id', type: "hidden", css:'hide', width: 0},
            { name: "name", title : "Name", type: "text", width: 100},
            { name: "hash", title : "hashtag", type: "text", width: 100},
            { type: "control"}

        ]
    });




    $("#add_addon").on("click",function(){
        if($("#company_addon").val() != "")
        {
            $.ajax({
                url : "admin_list/insert_addon",
                type : "POST",
                data : {
                    message : $("#company_addon").val(),
                    id : $("#hidden_company_id").val(),
                },
                dataType : "JSON",
                success : function(res)
                {
                    $("#addon_table").jsGrid("loadData");
                    $("#company_addon").val("");
                }
            })
        }else{
            noti("add-on text");
        }
    })

    $("#addon_table").jsGrid({
        width: "100%",
        filtering: false,
        editing: true,
        inserting: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,

        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the message?",
        controller: {
            loadData : function(filter){
                return $.ajax({
                    type : "POST",
                    url : 'admin_list/get_addon_list',
                    data : {
                      id : $("#hidden_company_id").val(),
                    },
                    dataType : "JSON",

                });
            },
            deleteItem : function(item)
            {
                return $.ajax({
                    type : "DELETE",
                    url : 'admin_list/delete_addon_list',
                    dataType : "JSON",
                    data : item,
                    success : function(res)
                    {
                        $("#addon_table").jsGrid("loadData");
                    }
                });
            },
            updateItem : function(item)
            {
                return $.ajax({
                    type : "post",
                    url : 'admin_list/update_addon_list',
                    data : item,
                    dataType : "JSON",
                    success : function(res)
                    {
                        $("#addon_table").jsGrid("loadData");
                    }
                });
            }
        },

        fields: [
            { name : 'id', type: "hidden", css:'hide', width: 0},
            { name: "name", title : "Name", type: "text", width: 100},
            { name: "message", title : "Add-on text", type: "text", width: 100},
            { type: "control"}

        ]
    });


})

function noti(name)
{
  $.notify({
    title:'Warning!',
    icon:'fa fa-warning',
    message:'Please input correct '+name
 },
 {
    type:'danger',
    allow_dismiss:false,
    newest_on_top:false ,
    mouse_over:false,
    showProgressbar:false,
    spacing:10,
    timer:2000,
    placement:{
      from:'top',
      align:'right'
    },
    offset:{
      x:30,
      y:30
    },
    delay:1000 ,
    z_index:10000,
    animate:{
      enter:'animated bounce',
      exit:'animated bounce'
  }
});
}