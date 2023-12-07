// adminscript.js

// Function to handle redirecting to the main page
function redirectToMainPage() {
  window.location.href = "http://localhost/admin_panel.php";
}

// You can call this function in response to the user's action, for example, clicking the back button in the browser.
// Assuming you have a back button with id="backButton"
document.getElementById("backButton").addEventListener("click", function () {
  history.back(); // This will go back to the previous page in the browser history.
});
