document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("register-form");

  //register

  if (registerForm) {
    registerForm.addEventListener("submit", handleRegister);
  }
});

async function handleRegister(event) {
  event.preventDefault();
  try {
    
    const formData = new FormData(event.target);

    const response = await axios.post(
      "../../../faq/article-server/apis/v1/register.php",
      formData
    );

    if (response.data.success === true) {
      //console.log("Registration successful, redirecting");
      window.location.href = "../../../faq/article-client/index.html";
    } else {
      //console.log("Registration failed with response:", response.data);
      alert(
        "Registration error: " + (response.data.message || "Unknown error")
      );
    }
  } catch (err) {
    alert("Connection error. Please try again later.");
  }
}
