
// =============================== MANAGE USERS ===============================
// DEACTIVATE
$(document).on('click', '.deactBtn', function(){
    let id = $(this).data('id');
    let btn = $(this);
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'id':id,
            'deactTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
            if(response.statusCode == 'deactivated'){
                $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function(){
                    location.reload();
                }, 1500)
                
            }
        }
    });
})

// REACTIVATE
$(document).on('click', '.reactivBtn', function(){
    let id = $(this).data('id');
    let btn = $(this);
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'id':id,
            'reactivTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
            if(response.statusCode == 'reactivated'){
                $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function(){
                    location.reload();
                }, 1500)
                
            }
        }
    });
})


// DELETE
$(document).on('click', '.delBtn', function(){
    var id = $(this).data('id');
    var btn = $(this);
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'id':id,
            'delTrig': true
        },
        success: function(jsonResp){
            console.log(jsonResp);
            var response = JSON.parse(jsonResp);
            if(response.statusCode == 'deleted'){
                $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function(){
                    location.reload();
                }, 1500)
                
            }
        }
    });
})



// DASHLET COUNT

function manageUserDashlet(){
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'manageUserDashletTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
            
            $("#totUsers").html(response.totUsers);
            $("#totActUsers").html(response.totActive);
            $("#totDeactUsers").html(response.totDeact);
            
        }
    });
}
manageUserDashlet();







// =============================== ADD PRODUCT ===============================

$(document).on('click','.manage-item-tab',function(){
    
    $(this).each(function(){
        if($(this).hasClass('active')){
            $(this).find('span').removeClass('bg-primary').addClass('bg-success');
        }
        // $('.manage-item-tab').not($('button[class="manage-item-tab nav-link active]')).find('span').removeClass('bg-success').addClass('bg-primary');
       
    })
    
    
})


$(document).on('click', '#addNewProdBtn', function(){
    let btn = $(this);
    $(".manage-item-tab").each(function(){
        if($(this).hasClass('active')){
            let prodName = $("#prodName").val();
            let prodCateg = $(this).data('id');
            let prodQuantity = $("#prodQuantity").val();
            
            if(prodName == "" || prodQuantity == ""){
                $("#prodName").addClass('has-error');
                $("#prodQuantity").addClass('has-error');
                $("#addProdModalerr").show();
            }else{
                $("#prodName").removeClass('has-error');
                $("#prodQuantity").removeClass('has-error');
                $("#addProdModalerr").hide();
        
                $.ajax({
                    url:'server.php',
                    method:'POST',
                    data:{
                        'prodName':prodName,
                        'prodCateg':prodCateg,
                        'prodQuantity':prodQuantity,
                        'addProdTrig':true
                    },
                    success: function(jsonResp){
                        let resp = JSON.parse(jsonResp);
                        if(resp.statusCode == 'prodAdded'){
                            $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }
                    }
                })
            }
        }
    })
        

});


// =============================== ADD QUANTITY ===============================
$(document).on('click', '.addQuantityBtn', function(){
    let id = $(this).data('id');
    let qtyFld = $("#addQuanFld" + id).val();
    let btn = $(this);

    if(qtyFld == ""){
        $("#addQuanFld" + id).addClass('has-error');
        $("#addQuanModalerr" + id).show();
    }else{
        $("#addQuanFld" + id).removeClass('has-error');
        $("#addQuanModalerr" + id).hide();

        $.ajax({
            url:'server.php',
            method:'POST',
            data:{
                'id':id,
                'qtyFld':qtyFld,
                'qtyFldTrig':true
            },
            success: function(jsonResp){
                let resp = JSON.parse(jsonResp);
                if(resp.statusCode == 'quantAdded'){
                    $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                    setTimeout(function(){
                        location.reload();
                    },1500);
                }
            }
        });
    }

});


// =============================== STOCK DASHLETS ===============================
function stocksDashlet(){
    $.ajax({
        url:'server.php',
        method:'POST',
        data:{
            'stocksDashletTrig':true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
            $("#totStocksTxt").html(resp.totStocks);
            $("#totInStocksTxt").html(resp.totInStocks);
            $("#totOutOfStocksTxt").html(resp.totOutOfStocks);
           
        }
    });
}
stocksDashlet();






// =============================== ACCEPT RESERVATION ===============================
$(document).on('click', '.acceptResBtn', function(){
    let btn = $(this);
    let resID = $(this).data('id');
    
    $.ajax({
        url:'server.php',
        method:'POST',
        data:{
            'resID': resID,
            'acceptRes':true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
            if(resp.statusCode == 'resAccepted'){
                $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function(){
                    location.reload();
                },1500);
            }
           
        }
    });
});




// =============================== REJECT RESERVATION ===============================
$(document).on('click', '.rejectResbtn', function(){
    let btn = $(this);
    let resID = $(this).data('id');
    
    $.ajax({
        url:'server.php',
        method:'POST',
        data:{
            'resID': resID,
            'rejectRes':true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
            if(resp.statusCode == 'resRejected'){
                $(btn).html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function(){
                    location.reload();
                },1500);
            }
           
        }
    });
});



// =============================== RESERVATION INFO DASHLETS ===============================
function resInfoDashlet(){
    $.ajax({
        url:'server.php',
        method:'POST',
        data:{
            'resInfoDashletTrig':true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
            $("#totRes, #totResTab").html(resp.totRes);
            $("#totPendingRes, #totPenTab").html(resp.totPendingRes);
            $("#totRejectedRes").html(resp.totRejectedRes);
            
        }
    });
}
resInfoDashlet();






// =============================== MARK AS PAID RESERVATION ===================================
$(document).on("click", "#paidBtn", function(){
    let btn = $(this);
    let resID = $(this).data('res-id');
    Swal.fire({
        title: 'Mark this user as Paid?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Mark as paid'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:'server.php',
                method:'POST',
                data:{
                    'resID': resID,
                    'paidTrig': true
                },
                success: function(jsonResp) {
                    let resp = JSON.parse(jsonResp);
                    if(resp.isPaid == "Yes"){
                        Swal.fire('Done!','','success');
                        $(btn).replaceWith('<i class="fas fa-check text-success"></i>');
                    }else{
                        Swal.fire('Done!','','error');
                    }
                    
                }
            })
            
        }
    })
})