import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import "./Login.css";

export default function Login() {

  const [username, setUsername] = useState();
  const [password, setPassword] = useState();

  const handleLogin = () => {
    console.log(username);
    console.log(password);
    axios
      .post(window.apiUrl + "login.php", {
        username: username,
        password: password,
      })
      .then((response) => {
        console.log(response.data);
        if( response.data.token != null){
          localStorage.setItem("token",response.data.token);
          axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}` 
        }
      });
  };

  let navigate = useNavigate();
  const routeSignUp = () => {
    console.log("sign up!");
    navigate("/SignUp")
  };
  
  return (
    <div className="login-container">
      <div className="login-wrapper">
        <div className="login-title">DisCoogs</div>
        <div className="login-group">
          {/* <form> */}
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
            <button className="loginButton" type="submit" onClick={handleLogin}>
              Login
            </button>
            <button
              className="loginButton"
              type="submit"
              onClick={routeSignUp}
            >
              Sign Up
            </button>
          </div>
          {/* </form> */}
        </div>
      </div>
    </div>
  );
}
