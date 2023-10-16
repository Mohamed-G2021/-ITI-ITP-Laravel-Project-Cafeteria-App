var showorderbody=document.getElementById("showorderbody"),
showproductbody=document.getElementById("showproductbody"),
orderbody=document.querySelector(".orderbody"),
productbody=document.querySelector(".productbody");


showorderbody.addEventListener("click",function(){
    //console.log(this);
    if(this.innerText == "+"){
        this.innerText="-"
    }
    else{
        this.innerText="+"
    }
    orderbody.classList.toggle("d-none");
});


showproductbody.addEventListener("click",function(){
    //console.log(this);
    if(this.innerText == "+"){
        this.innerText="-"
    }
    else{
        this.innerText="+"
    }
    productbody.classList.toggle("d-none");
});
