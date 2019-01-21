

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
let chex = []; 
if(document.getElementById("ajaxbtn")){
    document.getElementById("ajaxbtn").addEventListener("click", () => {

        $('input[type="checkbox"]:checked').each(function() {
            chex.push($(this).val());
        });
        ajaks(chex); 

        for(let i=0;i<chex.length;i++){
            if(document.getElementById(chex[i]).checked){
                console.log("Cekirano je: "+document.getElementById(chex[i]).id);
                
            }
        }

    });
}
function ajaks(par){

    $.ajax({
        /* the route pointing to the post function */
        url: '/postajax',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, message:par},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: (response) => { 
            //var obj = JSON.parse(response.msg);
            //var obj = data1.msg;
            console.log(typeof response.msg);
            console.log(response.msg);
            //$(".writeinfo").html(obj); 
            chex = []; 
        }
    }); 
    
}