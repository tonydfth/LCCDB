const usernameInputLogin = document.getElementById("usernameInputLogin")
const passwordInputLogin = document.getElementById("passwordInputLogin")
const loginButton        = document.getElementById("loginButton")
const signupPrompt       = document.getElementById("signupPrompt")

/* ------------------------------------------------------------------------------------------------ */
// ---- Authenticate the user with `username` and `password`
function authenticate(username, password) {

  // ---- Get form data
  if (!username) username = usernameInputLogin.value
  if (!password) password = passwordInputLogin.value

  console.log(">>>> logging in with", username, password)

  // ---- Do some input validation (make sure both fields aren't empty)
  //      In Javascript, empty string evaluates to false
  if (!username || !password) {

    // ---- Display input validation messages here


    return // short circuit
  }

  // ---- Hit the server with an AJAX request (use GET since we don't need a request body)
  const endpoint = `auth/login.php?username=${username}&password=${password}`
  GET(endpoint, (response) => {


    if (response.status == 200) {
      if (response.success) onLoginSuccess(response)
      else onLoginFailed(response)
    }
    else {
      // ---- Handle errors
    }
  })
}

// ---- Called when login succeeds
function onLoginSuccess(response) {
  console.log(">>>> auth", response)

  if(response.auth){
    console.log(">>>> admin", response.auth)
    navigateTo("/roster");
  } else{  
    console.log(">>>> student", response.auth)
    navigateTo("/college_listStudent");
  }
//  const COOKIE_EXPIRATION_TIME = new Date(new Date().getTime()+60*60*1000*48).toGMTString()
//  setCookie(
//    "token",
//    response.token,
//    COOKIE_EXPIRATION_TIME
//  )

}

// ---- Called when login fails (wrong password, username doesn't exist)
function onLoginFailed(response) {
  

}

/* ------------------------------------------------------------------------------------------------ */
// ---- Add an event listener for click events
//      Any time the button is clicked,
//      we run the callback function provided as the second argument
loginButton.addEventListener('click', () => authenticate())

// ---- Show the register section
signupPrompt.addEventListener('click', toggleLoginRegister);

// ---- Handle login on enter press
const onEnterLogin = event => event.key === "Enter" && authenticate()
usernameInputLogin.addEventListener('keydown', onEnterLogin);
passwordInputLogin.addEventListener('keydown', onEnterLogin);
