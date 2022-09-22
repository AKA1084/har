"use strict";


$(()=>{
    
    let cust_id = (new URLSearchParams(window.location.search)).get("c");

    console.log(cust_id);

    $("#view-all").on("click", ()=>{

        window.location.assign("../view-all");

    });
    async function basicDetail(){
        let result=await $.bbs.customer(cust_id,{balance:true,email_id:true});
        
        let data = result.result.data[0];
        let {id, name, email_id, balance} =data;
        $("#c-id").text(id);
        $("#c-name").text(name);
        
        $("#c-email_id").text(email_id);
        $("#c-balance").text(balance);
        console.log(data);

    }
    basicDetail();

    $("form").on("submit",async (e)=>{
        e.preventDefault();

        let id, amount, res ,code;

        id = $("#receiver-id").val();
        amount = parseFloat($("#amt").val());
       res = await $.bbs. transferMoney(cust_id, id,amount);
        code = res.result.code;
        
        console.log(res);
        if(code === 1){
          alert("transactions has been done");
        }
        else  alert("balance is not sufficient");

        if(code === 2){
            alert("customer not exist");
           }
    
           if(code===3){
            alert("balance not sufficient");
           }
    });
        
       const transactionRecord = async () => {


        let result = await $.bbs.transaction(cust_id);
        console.log(result);

        if(result.result.code === 1){
            result.result.data.forEach(v=>{
                    let{customer,date_time,amount,action} = v , {name,id} = customer;
                    let tr = $("<tr>").append(
                        $("<td>").text(id),
                         $("<td>").text(name),
                         $("<td>").html(`&#8377; ${amount}`),
                         $("<td>").html(date_time),
                         $("<td>").html(action),
                    );
                    $("#all-cust-rows").append(tr);
            });
        }
       }
       transactionRecord();    
});
