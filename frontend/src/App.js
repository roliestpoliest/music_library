import React, {useState} from 'react';
import './App.css';
// <li><a href = '#'>Create new account </a></li>
//import './logintest.css';
//<p> Username: </p>
//<p> Password: </p>
function App() {

    const [name, setName] = useState("Username")
    const [password,setPassword] = useState("Password")
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
    <div>
      <div className = 'title'>
        <p> DisCoogs </p>
      </div>
      <input className = 'username col-xs-3' value = {name} onChange = {handleNameChange} placeholder = "Username" />
      <input className = "password col-xs-4 col-xs-offset-2" value1 = {password} onChange = {handlePasswordChange} placeholder = "Password"/>
      <button onClick = {clickLogin}> Login </button>
    </div>
  );
}
export default App;