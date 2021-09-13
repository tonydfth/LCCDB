/* -------------------------------- HTTP Requests -------------------------------- */
/**
 * Sends a GET Request to given url,
 * calls callback with with response data
 */

const BASE_URL = "../php"

const GET = (endpoint, callback) => {
  $.ajax({
    type: "GET",
    url: `${BASE_URL}/${endpoint}`,
    success: callback,
    dataType: "json",
  })
}

/**
 * Sends a POST Request to given url with body,
 * calls callback with with response data
 */
const POST = (endpoint, body, callback) => {
  $.ajax({
    type: "POST",
    url: `${BASE_URL}/${endpoint}`,
    data: body,
    success: callback,
    dataType: "json",
  })
}

/* -------------------------------- Cookies -------------------------------- */
/**
 * Returns an object contains all of the cookies for the current host
 */
const getCookies = () => {
  const cookieMap = {},
        cookiesStr = document.cookie
  cookiesStr.split(";")
    .forEach(cookieStr => {
      const [key, value] = cookieStr.split("=")
      cookieMap[key.trim()] = value
    })
  return cookieMap
}

/**
 * Sets a cookie with key, value and expiration time.
 */
//const setCookie = (key, value, expires) => {
 // document.cookie = `${key}=${value};${expires};path=/`
//}

/**
 * Checks if the loginToken is still valid,
 * @onSuccess: if the loginToken is still valid
 * @onFailed:  if the loginToken is invalid
 */
//const verifyPersistentLogin = (onSuccess, onFailed) => {

//  if (!onSuccess)
//    onSuccess = () => null
//  if (!onFailed)
//    onFailed = () => navigateTo("/auth")
//
//  const cookies = getCookies()
//  const token = cookies["token"]

  // ---- Send the value of the cookie to the server
  //      to verify that it is still valid
//  const endpoint = `auth/verify.php?token=${token}`
//  GET(endpoint, response => {
 //   if (response.success)
//      onSuccess()
 //   else
//      onFailed()
 // })
//}

/* -------------------------------- Navigation -------------------------------- */
const navigateTo = (path) => {
  window.location.pathname = path
}
