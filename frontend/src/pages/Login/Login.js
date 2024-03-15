import React, { useState } from "react";
import "./Login.css";

export default function Login() {
  const [name, setName] = useState("");
  const [password, setPassword] = useState("");

  function handleNameChange(event) {
    setName(event.target.value);
  }

  function handlePasswordChange(event) {
    setPassword(event.target.value);
  }

  // function clickLogin() {
  //   alert("Logging to home page");
  // }

  function forgotPassword() {
    alert("Heading to forgot password page");
  }

  function newAccount() {
    alert("Heading to new account page");
  }

  return (
    <div className="login">
      <div className="title">DisCoogs</div>
      <input
        className="username"
        value={name}
        onChange={handleNameChange}
        placeholder="Username"
      />
      <input
        className="password"
        value1={password}
        onChange={handlePasswordChange}
        placeholder="Password"
      />
      <button className="forgotPassword" onClick={forgotPassword}>
        {" "}
        Forgot Password?{" "}
      </button>
      <button className="newAccount" onClick={newAccount}>
        {" "}
        New Account?{" "}
      </button>
    </div>
  );
}
