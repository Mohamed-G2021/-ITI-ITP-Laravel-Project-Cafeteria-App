var showOrderBody=document.querySelectorAll("#showorderbody"),
    showProductBody=document.querySelectorAll("#showproductbody");

    //console.log(showOrderBody);
    //console.log(showProductBody);

/* start function to toggle order date part*/
showOrderBody.forEach((elem,index)=>{
    elem.addEventListener("click",function(e){
        //console.log(e.target);
        //console.log(e.target.parentElement.parentElement.parentElement.nextElementSibling);
        if(e.target.innerText == "+"){
            e.target.innerText="-"
        }
        else{
            e.target.innerText="+"
        }
        e.target.parentElement.parentElement.parentElement.nextElementSibling.classList.toggle("d-none");
    });
});
/* end function to toggle order date part*/


/* start function to toggle product part*/
showProductBody.forEach((elem,index)=>{
    elem.addEventListener("click",function(e){
        //console.log(e.target);
        //console.log(e.target.parentElement.parentElement.parentElement.nextElementSibling);
        if(e.target.innerText == "+"){
            e.target.innerText="-"
        }
        else{
            e.target.innerText="+"
        }
        e.target.parentElement.parentElement.nextElementSibling.classList.toggle("d-none");
    });
});
/*end function to toggle product part*/


/*start function that press submit form when select users changes*/
document.addEventListener('DOMContentLoaded', function() {
    // Get the filtration form element
    var filtrationForm = document.getElementById('filtration-form');

    // Add event listener for changes in filtration form elements
    filtrationForm.lastElementChild.addEventListener('change', function(event) {
        // Submit the form
        event.preventDefault();
        filtrationForm.submit();
    });
});
/*end function that press submit form when select users changes*/

