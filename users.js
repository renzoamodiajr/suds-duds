// =============================== DOM MANIPULATION ===============================

$(document).on('click', '#washOnly', function(){
    $("#modalFormTitle").html("Wash Only");
    $("#srvcType").val(1);
     $("#washDryForm").find('input, #washDryKilo').removeClass('has-error');
     $(".errMsg").hide();
});
$(document).on('click', '#washDryBtn', function(){
    $("#modalFormTitle").html('Wash & Dry');
    $("#srvcType").val(3);
     $("#washDryForm").find('input, #washDryKilo').removeClass('has-error');
     $(".errMsg").hide();
});
  

//  REMOVES DISABLED ATTRIBUTE ON QUANTITY FIELD AFTER DROPDOWN 
$(document).on('change', '.selItem', function(){
 
    if($(this).val() == ""){
        $(this).closest('.row').find('input').attr('disabled', true);
    }else{
        $(this).closest('.row').find('input').prop('disabled', false);
    }
});




// =============================== RESERVATION DATE PICKER ===============================

function checkDateAvlblty(){
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'checkDateAvlblty': true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
          
            console.log(resp);
          
            var array = resp;
            $( ".datepicker" ).datepicker({
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ array.indexOf(string) == -1 ]
                }
            });
           
        }
    });
    
}
checkDateAvlblty();


$(document).on('change', '.selDate', function(){
    let resDate = $(this).val();

    if($(this).val() == ""){
        $(this).closest('.row').find('select').attr('disabled', true);
    }else{
        $(this).closest('.row').find('select').prop('disabled', false);
        checkTimeAvlblty(resDate)
    }
});


// =============================== CHECKS TIME AVAILABLITY ===============================

function checkTimeAvlblty(resDate){
   
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'resDate': resDate,
            'checkTimeAvlblty': true
        },
        success: function(jsonResp){
            let resp = JSON.parse(jsonResp);
            let len = resp.length;
            let opts;
            opts += '<option value="">Select time</option>';
            opts += '<option value="08:00 am">08:00 am</option>';
            opts += '<option value="08:00 am">09:00 am</option>';
            opts += '<option value="10:00 am">10:00 am</option>';
            opts += '<option value="11:00 am">11:00 am</option>';
            opts += '<option value="12:00 pm">12:00 pm</option>';
            opts += '<option value="01:00 pm">01:00 pm</option>';
            opts += '<option value="02:00 pm">02:00 pm</option>';
            opts += '<option value="03:00 pm">03:00 pm</option>';
            opts += '<option value="04:00 pm">04:00 pm</option>';

            if(len != 0){
                for(let i = 0; i < len; i++){
                    $("#washDryResTime option:contains(" + resp[i] + ")").html(resp[i] + ' - Full').attr('disabled', true).css({'background': '#E9ECEF'});
                    $("#dryResTime option:contains(" + resp[i] + ")").html(resp[i] + ' - Full').attr('disabled', true).css({'background': '#E9ECEF'});
                }
            }
            if(len == 0){
                $("#washDryResTime").html(opts);
                $("#dryResTime").html(opts);
            }
                
           
        }
    });
}


// =============================== AUTO POPULATE DROPDOWN DETERGENT AND FABCON  ===============================
function populateDrpDwnFabConDtrgnt(){
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'populateTrig': true
        },
        success: function(jsonResp){
            console.log(jsonResp);
            let resp = JSON.parse(jsonResp);
            console.log(resp);
            $("#selDetergent").html(resp.detergentDropdown);
            $("#selFabCon").html(resp.fabConDropdown);
        }
    });
}
populateDrpDwnFabConDtrgnt();






// ====================================================== SUBMIT RESERVATION INFO =========================================
 

$(document).on('click', '#submitWashDryBtn', function(){
    let btn = $(this);
    let srvType = $("#srvcType").val();
    let userID = $("#userID").val();
    let washDryKilo = $("#washDryKilo").val();
    let selDetergent = $("#selDetergent").val();
    let detergentQty = $("#detergentQty").val();
    let selFabCon = $("#selFabCon").val();
    let fabConQty = $("#fabConQty").val();
    let washDryResDate = $("#washDryResDate").val();
    let washDryResTime = $("#washDryResTime").val();
    let washDryPN = $("#washDryPN").val();
    let washDryNote = $("#washDryNote").val();

   
    $("#washDryForm").find('input, #washDryKilo').not('input[type="hidden"], #detergentQty, #fabConQty, #washDryNote').each(function(){
        if($(this).val() == ""){
            $(this).addClass('has-error');
            $(".errMsg").show();
        }else{
            $(this).removeClass('has-error');
        }
    });
    
    if(washDryKilo != "" && washDryResDate != "" && washDryResTime != "" && washDryPN != ""){
            $(".errMsg").hide();
            $.ajax({
                url: 'server.php',
                method: 'POST',
                data:{
                    'srvType': srvType,
                    'userID': userID,
                    'washDryKilo': washDryKilo,
                    'selDetergent': selDetergent,
                    'detergentQty': detergentQty,
                    'selFabCon': selFabCon,
                    'fabConQty': fabConQty,
                    'washDryResDate': washDryResDate,
                    'washDryResTime': washDryResTime,
                    'washDryPN': washDryPN,
                    'washDryNote': washDryNote,
                    'submitWashDryBtnTrig': true
                },
                success: function(jsonResp){
                    console.log(jsonResp);
                    let resp = JSON.parse(jsonResp);
                    if(resp.statusCode == 'reserved'){

                        $(btn).html('<i class="fa fa-spinner fa-spin"></i>');

                        setTimeout(function(){
                            location.href = "tracker.php";
                        }, 1500);
                        
                    }
                }
            });
    }

});




$(document).on('click', '#submitDryBtn', function(){
    let btn = $(this);
    let srvType = 2;
    let userID = $("#userID").val();
    let dryKilo = $("#dryKilo").val();
    let dryResDate = $("#dryResDate").val();
    let dryResTime = $("#dryResTime").val();
    let dryPN = $("#dryPN").val();
    let dryNote = $("#dryNote").val();

    
    
   
    $("#dryOnlyForm").find('input, #dryKilo').not('#dryNote').each(function(){
        if($(this).val() == ""){
            $(this).addClass('has-error');
            $(".errMsg").show();
        }else{
            $(this).removeClass('has-error');
        }
    });
    
    if(dryKilo != "" && dryResDate != "" && dryResTime != "" && dryPN != ""){
            $(".errMsg").hide();
            $.ajax({
                url: 'server.php',
                method: 'POST',
                data:{
                    'srvType': srvType,
                    'userID': userID,
                    'dryKilo': dryKilo,
                    'dryResDate': dryResDate,
                    'dryResTime': dryResTime,
                    'dryPN': dryPN,
                    'dryNote': dryNote,
                    'submitDryBtnTrig': true
                },
                success: function(jsonResp){
                    console.log(jsonResp);
                    let resp = JSON.parse(jsonResp);
                    if(resp.statusCode == 'reserved2'){

                        $(btn).html('<i class="fa fa-spinner fa-spin"></i>');

                        setTimeout(function(){
                            location.href = "tracker.php";
                        }, 1500);
                        
                    }
                }
            });
    }

});


// ============================================ FETCH RESRVATION INFO ================================================

// view Reservation Info button
$(document).on('click', '.viewResInfo', function(){
    let resID = $(this).data('id');


    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'resID':resID,
            'fetchResInfo': true
        },
        success: function(jsonResp){
            console.log(jsonResp);
            let resp = JSON.parse(jsonResp);
            $("#srvcType").html(resp.srvcType);
            $("#kg").html(resp.kg);
            $("#detrgntType").html(resp.detrgntType + ' (' + resp.detrgntQty + 'pcs)');
            $("#fabConType").html(resp.fabConType + ' (' + resp.fabConQty + 'pcs)');
            $("#dateRes").html(resp.dateRes + ' at ' + resp.hourRes);
            $("#notee").html(resp.notee);
            $("#stats").html(resp.stats);
            $("#amntPaid").html('₱' + resp.amntPaid);

            if(resp.stats == "Accepted"){
                $("#downloadPDF").show();
            }
            if(resp.stats == "Rejected" || resp.stats == "Pending"){
                $("#downloadPDF").hide();
            }

            // DOWNLOAD  RESERVATION DETAILS (PDF FORMAT)
            $(document).on('click', '#downloadPDF', function(){
                var doc = new jsPDF();

                doc.setFont("", "bold");
                doc.text("RESERVATION DETAILS", 105, 50, null, null, "center");

                doc.setFont("", "bold");
                doc.text("Service Type:", 40, 65);
                doc.setFont("", "normal");
                doc.text(resp.srvcType, 110, 65);

                doc.setFont("", "bold");
                doc.text("Kilogram:", 40, 75);
                doc.setFont("", "normal");
                doc.text(resp.kg, 110, 75);

                doc.setFont("", "bold");
                doc.text("Detergent:", 40, 85);
                doc.setFont("", "normal");
                doc.text(resp.detrgntType + ' (' + resp.detrgntQty + 'pcs)', 110, 85);

                doc.setFont("", "bold");
                doc.text("FabCon:", 40, 95);
                doc.setFont("", "normal");
                doc.text(resp.fabConType + ' (' + resp.fabConQty + 'pcs)', 110, 95);

                doc.setFont("", "bold");
                doc.text("Date reserved:", 40, 105);
                doc.setFont("", "normal");
                doc.text(resp.dateRes + ' at ' + resp.hourRes, 110, 105);

                doc.setFont("", "bold");
                doc.text("Status:", 40, 115);
                doc.setFont("", "normal");
                doc.text(resp.stats, 110, 115);

                doc.setFont("", "bold");
                doc.text("Amount due:", 40, 125);
                doc.setFont("", "normal");
                doc.text('P' + resp.amntPaid, 110, 125);
                
                doc.save('reservation_details.pdf');
            })
        }
    });
});





// ============================================ FETCH NOTIFICATION IF RESERVATION HAS BEEN ACCEPTED BY THE ADMIN ================================================
function fetchNotif() {
    let userID = $("#userID").val();
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'userID': userID,
            'notif': true
        },
        success: function(jsonResp){
            console.log(jsonResp);
            let resp = JSON.parse(jsonResp);
            if(resp.notifCount > 0){
                if(resp.resStatus == 'Accepted'){
                    Swal.fire({
                        icon: 'success',
                        title: 'ACCEPTED',
                        text: 'Your reservation on ' +  resp.resDate +' has been accepted!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateNotifStatus(userID);
                        }
                    })
                }
                if(resp.resStatus == 'Rejected'){
                    Swal.fire({
                        icon: 'error',
                        title: 'REJECTED',
                        text: 'Your reservation on ' +  resp.resDate +' was rejected!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateNotifStatus(userID);
                        }
                    })
                }
            }
            
        }
    });
}
fetchNotif();


function updateNotifStatus(userID){
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'userID': userID,
            'updNotifStats': true
        },
        success: function(jsonResp){
            console.log(jsonResp);
        }
    });
}