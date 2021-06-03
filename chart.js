
// WEEKLY DASHLET
function weeklyDynamicReport(){
  
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'weeklyDynamicReportTrig': true
        },
        success: function(jsonResponse){
         
            let data = JSON.parse(jsonResponse);
            console.log(data);
                // ############## WEEKLY REVENUE ##############
                let weeklyDynamicRepREVData = {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [
                            {
                                label: ['Revenue'],
                                data: [data.totRevWeek1, data.totRevWeek2, data.totRevWeek3, data.totRevWeek4],
                                backgroundColor: ['#F99223']
                            }
                    ]
                };
                
                let weeklyDynamicRepREVCtx = $("#weeklyDynamicRepREV");
                let weeklyDynamicRepREV = new Chart(weeklyDynamicRepREVCtx, {
                    type: 'bar',
                    data: weeklyDynamicRepREVData,
                    options: {
                        scales: {
                            yAxes: {
                                ticks: {
                                    callback: function(value, index, values) {
                                        return '₱' + value;
                                    }
                                }
                            }
                        }
                    }
                    
                  
                });


           
            
        }
    });

    
}
weeklyDynamicReport();




// MONTHLY DASHLET
function monthlyDynamicReport(){
  
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'monthlyDynamicReportTrig': true
        },
        success: function(jsonResponse){
            // console.log(jsonResponse);
            let data = JSON.parse(jsonResponse);
            // console.log(data);
            

            // ############## MONTHLY  REVENUE ##############
            let revDataLen = data.totMonthlyRev.length;
            let revData = [];
            for(let i = 0; i<revDataLen; i++){
                revData.push(data.totMonthlyRev[i]);
            }
            
            let monthlyDynamicRepREVData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                        {
                            label: ['Revenue'],
                            data: revData,
                            backgroundColor: ['#F99223']
                        }
                ]
            };
            
            let monthlyDynamicRepREVCtx = $("#monthlyDynamicRepREV");
            let monthlyDynamicRepREV = new Chart(monthlyDynamicRepREVCtx, {
                type: 'bar',
                data: monthlyDynamicRepREVData,
                options: {
                    scales: {
                        yAxes: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }
                    }
                }
                
                
            });


            
        }
    });

    
}
monthlyDynamicReport();





// YEARLY DASHLET
function yearlyDynamicReport(){
  
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data:{
            'yearlyDynamicReportTrig': true
        },
        success: function(jsonResponse){
            console.log(jsonResponse);
            let data = JSON.parse(jsonResponse);
            // console.log(data);
            
            let yearsLen = data.years.length;
            let years = [];
            for(let y=0; y<yearsLen; y++){
                years.push(data.years[y]);
            }

            // ############## YEARLY REVENUE ##############

            let revDataLen = data.totYearlyRev.length;
            let revData = [];
            for(let i=0; i<revDataLen; i++){
                revData.push(data.totYearlyRev[i]);
            }

            let yearlyDynamicRepREVData = {
                labels: years,
                datasets: [
                        {
                            label: ['Revenue'],
                            data: revData,
                            backgroundColor: ['#F99223']
                        }
                ]
            };
            
            let yearlyDynamicRepREVCtx = $("#yearlyDynamicRepREV");
            let yearlyDynamicRepREV = new Chart(yearlyDynamicRepREVCtx, {
                type: 'bar',
                data: yearlyDynamicRepREVData,
                options: {
                    scales: {
                        yAxes: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }
                    }
                }
                
                
            });

         

            
        }
    });

    
}
yearlyDynamicReport();