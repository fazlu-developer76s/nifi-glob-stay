<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Google Authentication Example</title>

  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <script>
    function signInWithGoogle() {
      const client = google.accounts.oauth2.initCodeClient({
        client_id: '725074302481-k18mcep9m8bk7hutv8suh1hftdueb432.apps.googleusercontent.com', // auto-fill via Laravel
        scope: 'profile email',
        ux_mode: 'popup',
        callback: (response) => {
          const authCode = response.code;
          const url = `http://127.0.0.1:8000/test/googleAuth?code=${authCode}`;

          fetch(url, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
            },
          })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data.success) {
              document.getElementById('userInfo').innerHTML = `
                <h3>Welcome, ${data.user.name}</h3>
                <p>Email: ${data.user.email}</p>
              `;
            } else {
              alert("Authentication failed: " + data.message);
            }
          })
          .catch(err => {
            console.error("Error during Google Sign-In:", err);
          });
        }
      });

      client.requestCode();
    }
  </script>
</head>
<body>
  <h1>Google Sign-In Example</h1>
  <button onclick="signInWithGoogle()">Sign in with Google</button>
  <div id="userInfo"></div>
</body>
</html>
