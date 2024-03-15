import React, { useState } from "react";
import "./Login.css";

export default function Login() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  function handleUsername(event) {
    setUsername(event.target.value);
  }

  function handlePassword(event) {
    setPassword(event.target.value);
  }

  function handleLogin() {
    alert("Logging to home page");
  }

  function forgotPassword() {
    alert("Heading to forgot password page");
  }

  function handleSignUp() {
    alert("Heading to new account page");
  }

  return (
    <div className="login">
      <div className="title">DisCoogs</div>
      <input
        className="loginInput"
        value={username}
        onChange={handleUsername}
        placeholder="Username"
      />
      <input
        className="loginInput"
        value1={password}
        onChange={handlePassword}
        placeholder="Password"
      />
      <div className="displayButtons">
        <button className="loginButton" onClick={handleLogin}>
          {" "}
          Log in{" "}
        </button>
        <button className="loginButton" onClick={forgotPassword}>
          {" "}
          Forgot Password?{" "}
        </button>
        <button className="loginButton" onClick={handleSignUp}>
          {" "}
          Sign Up{" "}
        </button>
      </div>
    </div>
  );
}
