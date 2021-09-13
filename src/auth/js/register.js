const usernameInputRegister = document.getElementById("usernameInputRegister")
const passwordInputRegister = document.getElementById("passwordInputRegister")
const registerButton        = document.getElementById("registerButton")
const loginPrompt   = document.getElementById("loginPrompt")

/* ------------------------------------------------------------------------------------------------ */
// ---- Authenticate the user with `username` and `password`
function register() {

  // ---- Get form data
  const username = usernameInputRegister.value
  const password = passwordInputRegister.value
  // ---- Do some input validation (make sure both fields aren't empty)
  //      In Javascript, empty string evaluates to false
  if (!username || !password) {

    // ---- Display input validation messages here


    return // short circuit
  }


  // ---- Hit the server with an AJAX request
  const endpoint = `auth/register.php`
  const body = {
    username: username,
    password: password
  }
  POST(endpoint, body, (response) => {

    console.log(">>>>", response)

    if (response.status === 200) {
      if (response.success) onRegisterSuccess()
      else onRegisterFailed()
    }
    else {
      // ---- Handle errors
    }
  })
}

// ---- Called when register succeeds
function onRegisterSuccess() {

  const username = usernameInputRegister.value
  const password = passwordInputRegister.value

  // ---- Log the user in
  authenticate(username, password)
}

// ---- Called when register fails
function onRegisterFailed() {

}

/* ------------------------------------------------------------------------------------------------ */
// ---- Add an event listener for click events
//      Any time the button is clicked,
//      we run the callback function provided as the second argument
registerButton.addEventListener('click', register)

// ---- Show the login section
loginPrompt.addEventListener('click', toggleLoginRegister);

// ---- Handle register on enter press
const onEnterRegister = event => event.key === "Enter" && register()
usernameInputRegister.addEventListener('keydown', onEnterRegister);
passwordInputRegister.addEventListener('keydown', onEnterRegister);
