"use strict";

$(()=>{

    const displayAllCustomers = async () => {

        let res = await $.bbs.customer("all", { balance: true });
        
        res.result.data.forEach(v=>{

            let  { id, name, balance } = v;
            
            let tr = $("<tr>").append(
                $("<td>").text(id),
                $("<td>").text(name),
                $("<td>").html(`&#8377; ${balance}`)
            );

            let btn = $("<button>").text("View");
            btn.on("click", ()=>{
                window.location.assign("../cust?c=" + id);
            });

            tr.append(btn);

            $("#all-cust-rows").append(tr);

        });



    };


    displayAllCustomers();

});