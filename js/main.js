

var output = document.getElementById("js_out");
var btn = document.getElementById("js_btn");


btn.onclick = ()=>{

    fetch("/api/create_user.php",{
        method : "POST"
    })
    .then((response)=>response.text())
    .then((data)=>{
        output.innerHTML = data;
    });
}

