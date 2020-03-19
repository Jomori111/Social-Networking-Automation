$(document).ready(function(){
    $("#add_company").on("click",function(){
        if($("#company_name").val() != "")
        {
            $.ajax({
                url : "admin_company/insert_company",
                type : "POST",
                data : {
                    name : $("#company_name").val(),
                },
                dataType : "JSON",
                success : function(res)
                {
                    $("#company_table").jsGrid("loadData");
                    document.location.replace("admin_company");
                    $("#company_name").val("");
                }
            })
        }else{
            $.notify({
              title:'Warning!',
              icon:'fa fa-warning',
              message:'Please input correct company name'
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
    })

    $("#company_table").jsGrid({
        width: "100%",
        filtering: false,
        editing: true,
        inserting: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,

        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the Template?",
        controller: {
            loadData : function(filter){
                return $.ajax({
                    type : "GET",
                    url : 'admin_company/get_company_list',
                    data : filter,
                    dataType : "JSON",

                });
            },
            deleteItem : function(item)
            {
                return $.ajax({
                    type : "DELETE",
                    url : 'admin_company/delete_company_list',
                    dataType : "JSON",
                    data : item,
                });
            },
            updateItem : function(item)
            {
                return $.ajax({
                    type : "post",
                    url : 'admin_company/update_company_name',
                    data : item,
                    dataType : "JSON",
                    success : function(res)
                    {
                        $("#company_table").jsGrid("loadData");
                    }
                });
            }
        },

        fields: [
            { name : 'no', type: "text", width: 60,editing:false},
            { name : 'id', type: "hidden", css:'hide', width: 0},
            { name: "name", title : "Name", type: "text", width: 60},
            { type: "control"}

        ]
    });

})

function show_social(id)
{
    $.ajax({
        url : "admin_company/get_company_social_info",
        type : "POST",
        data : {
            id : id,
        },
        dataType : "JSON",
        success : function(res)
        {
            $("#hidden_modal_btn").click();
            console.log(res);
            if(res[0]['linkedin_token'] != "")
            {
                $("#linkedin_verify").css("display","none");
                $("#linkedin_verified").css("display","block");
            }else{
                $("#linkedin_verify").css("display","block");
                $("#linkedin_verified").css("display","none");
            }

            if(res[0]['twitter_token'] != "")
            {
                $("#twitter_verify").css("display","none");
                $("#twitter_verified").css("display","block");
            }else{
                $("#twitter_verify").css("display","block");
                $("#twitter_verified").css("display","none");
            }

            if(res[0]['instagram_token'] != "")
            {
                $("#instagram_verify").css("display","none");
                $("#instagram_verified").css("display","block");
            }else{
                $("#instagram_verify").css("display","block");
                $("#instagram_verified").css("display","none");
            }

            if(res[0]['facebook_token'] != "")
            {
                $("#facebook_verify").css("display","none");
                $("#facebook_verified").css("display","block");
            }else{
                $("#facebook_verify").css("display","block");
                $("#facebook_verified").css("display","none");
            }
        }
    })
}