document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById("default").click();
 });


function myFunction(input) {
    var x = document.getElementsByClassName("message");
	for (let i=0; i<x.length; i++) {
        x[i].innerHTML = "te pup dulce";
    }
}

function Show(n){
    var x = document.getElementsByClassName("info");
    for(let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[n-1].style.display = "";
   /* var m = document.getElementsByClassName("info");
    m[n-1].style.backgroundColor = "purple";*/ 
    var s = document.getElementsByClassName("btn");
    for (let i = 0; i < x.length; i++) {
        s[i].style.backgroundColor = "";
    }
    s[n-1].style.backgroundColor = "#2d333b";

   
}

