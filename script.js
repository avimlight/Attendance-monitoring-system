document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const userType = document.getElementById("userType").value;
    // Perform further actions here like sending the data to the server for authentication
    console.log("Username: " + username);
    console.log("Password: " + password);
    console.log("User Type: " + userType);
  });

// script.js

document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const userType = document.getElementById("userType").value;

    // Perform validation here, and if successful, redirect to the admin panel
    if (
      username === "your_username" &&
      password === "your_password" &&
      userType === "admin"
    ) {
      window.location.replace("/phpglab3/admin_pannel1.php"); // Replace with your admin panel page name
    } else {
      alert("Invalid credentials. Please try again.");
    }
  });
