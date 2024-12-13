document.addEventListener('DOMContentLoaded', (event) => {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const username = loginForm.username.value;
        const password = loginForm.password.value;

        if (username === "a" && password === "a") {
            document.getElementById('openWindowButton').addEventListener('click', function() {
                window.open("http://google.com", "_self");
            });            
            location.reload();
            // Simulate a button click to open the window
            document.getElementById('openWindowButton').click();
            // location.reload();
        }
        else if (username === "b" && password === "b") {
            document.getElementById('openWindowButton').addEventListener('click', function() {
                window.open("http://google.com", "_self");
            });            
            location.reload();
            // Simulate a button click to open the window
            document.getElementById('openWindowButton').click();
            // location.reload();
        }
        else if (username === "c" && password === "c") {
            document.getElementById('openWindowButton').addEventListener('click', function() {
                window.open("http://google.com", "_self");
            });            
            location.reload();
            // Simulate a button click to open the window
            document.getElementById('openWindowButton').click();
            // location.reload();
        } else {
            alert("Invalid Username or Password");
            location.reload();
        }
    });
});