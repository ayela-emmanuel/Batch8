


fetch("/api/users/profile.php").then(res=>{
    if(res.ok){
        return res.json()
    }else{
        if(res.status == 401)
        {alert("Not Allowed");}
        else
        {alert("Error")}
    }
})