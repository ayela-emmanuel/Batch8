

var output = document.getElementById("js_out");
var btn = document.getElementById("js_btn");





btn.onclick = ()=>{

    fetch("/api/create_user.php",{
        method : "POST"
    })
    .then((response)=>response.json())
    .then((data)=>{
        output.innerHTML = "";
        data.forEach(element => {
            GenerateItem(element.fullname, element.email, null);
        });
    });
}


function GenerateItem(name, email, imgurl) {

    var template = `
        <div class="simple-card">
            <div>
                <span>Name: ${name??"NO NAME"} </span>
                <span>Email: ${email??"NO EMAIL"} </span>
            </div>
            <div>
                <img src="${imgurl??"https://media.lordicon.com/icons/wired/lineal/45-clock-time.svg"}" alt="" srcset="" height="100">
            </div>
        </div>
    `;


    output.innerHTML += template;
    
}


function Register(){
    var form = document.forms["register"];
    var name = form["name"].value;
    var email = form["email"].value;
    var password = form["password"].value;
    // Assingment Validate inputs ... use alert() For Validation Errors

    //return()
    //
    fetch("/api/register.php",{
        method : "POST",
        body: JSON.stringify({
            name:name,
            email:email,
            password:password
        })
    }).then(res=>{
        if(res.ok){
            alert("User Created");
        }else{
            alert("Failed to Create User");
        }
    })

}