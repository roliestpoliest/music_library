import React, {useState} from 'react';
import './Login.css';

export default function Login() {

    const [name, setName] = useState("")
    const [password,setPassword] = useState("")
    function handleNameChange(event)
    {
      setName(event.target.value);
    }
    function handlePasswordChange(event)
    {
      setPassword(event.target.value)
    }
    function clickLogin()
    {
      alert("Logging to home page")
    }
    return (
    <div classname = "login">
      <p> DisCoogs </p>
      <p> Username: </p>
      <input value = {name} onChange = {handleNameChange}/>
      <p> Password: </p>
      <input className = 'password' password = {password} onChange = {handlePasswordChange}/>
      <p></p>
      <button onClick = {clickLogin}> Login </button>
      <li><a href = '#'>Create new account </a></li>
    </div>
  );
}
