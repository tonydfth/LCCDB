// ---- Skipped if we're already logged in
let state = "LOGIN"

const loginSection = document.getElementById("loginSection")
const registerSection = document.getElementById("registerSection")

const toggleLoginRegister = () => {
  if (state === "LOGIN") {
    loginSection.classList.add("hidden")
    registerSection.classList.remove("hidden")
    state = "REGISTER"
  }
  else {
    loginSection.classList.remove("hidden")
    registerSection.classList.add("hidden")
    state = "LOGIN"
  }
}
