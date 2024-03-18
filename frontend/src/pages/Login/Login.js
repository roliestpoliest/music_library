import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Login.css";

export default function Login() {
  const domain = window.$domain;

  const [username, setUsername] = useState();
  const [password, setPassword] = useState();
  const [data, setData] = useState();

  // useEffect(() => {

  // }, []);

  function handleSubmit() {
    // axios.post(domain + "/api/login.php",{})
    //   .then((response) => {
    //     console.log(response);
    // setData(response.data);
    // });
    // axios
    //   .post(domain + "/api/login.php", {
    //     username: "username",
    //     password: "password",
    //   })
    //   .then((response) => {
    //     console.log(response);
    //   });
  }

  return (
    <div className="login-container">
      <div className="login-wrapper">
        <div className="login-title">DisCoogs</div>
        <div className="login-group">
          <form>
            <label>
              <input
                className="loginInput"
                type="text"
                placeholder="username"
                onChange={(e) => setUsername(e.target.value)}
              />
            </label>
            <br />
            <label>
              <input
                className="loginInput"
                type="password"
                placeholder="password"
                onChange={(e) => setPassword(e.target.value)}
              />
            </label>
            <div className="button-wrapper">
              <button
                className="loginButton"
                type="submit"
                onClick={handleSubmit}
              >
                Login
              </button>

              <button
                className="loginButton"
                type="submit"
                onClick={handleSubmit}
              >
                Sign Up
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
