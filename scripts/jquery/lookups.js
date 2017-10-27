  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#dayperiod_id").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      var allbooks = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
      var dataString = "allbooks="+allbooks; /* STORE THAT TO A DATA STRING */

      $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "dashboard.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: dataString, /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#listProgramDiv").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
