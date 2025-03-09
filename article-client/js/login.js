document.addEventListener("DOMContentLoaded", function (){
    const loginForm = document.getElementById("login-form");

    //login

    if(loginForm){
        loginForm.addEventListener("submit",handleLogin)
    }
});

async function handleLogin(event){
    event.preventDefault();
    try{
        const formData = new FormData(event.target)

        const response = await axios.post("../../../faq/article-server/apis/v1/login.php",formData);

        if (response.data.success) {
            localStorage.setItem('id', response.data.id);
            localStorage.setItem('fullName', response.data.user_full_name);
            console.log("User ID:", localStorage.getItem('user_id'));
        console.log("User Full Name:", localStorage.getItem('user_fullname'));
        alert("Login successful!");
        window.location.href ="../../../faq/article-client/home.html";
    }
    else {
        
        alert(
          "Registration error: " + (response.data.message || "Unknown error")
        );
      }
    }
    catch(err){
        alert("Connection error. Please try again later.");
    }
}

