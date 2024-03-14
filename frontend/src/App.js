import React, {useState} from 'react';
import './App.css';
// <li><a href = '#'>Create new account </a></li>
//import './logintest.css';
//<p> Username: </p>
//<p> Password: </p>
//<button onClick = {clickLogin}> Login </button>
/*<button className = "forgotPassword" onClick = {forgotPassword}> Forgot Password? </button>
      <button className = "newAccount" onClick = {newAccount}> New Account? </button> */
function App() {

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
    /*function clickLogin()
    {
      alert("Logging to home page")
    } */
    function forgotPassword()
    {
      alert("Heading to forgot password page")
    }
    function newAccount()
    {
      alert("Heading to new account page")
    } 
    return (
    <div>
      <div className = 'title'>
        <p> DisCoogs </p>
      </div>
      <input className = 'username' value = {name} onChange = {handleNameChange} placeholder = "Username" />
      <div className = 'space'>
      </div>
      <input className = "password" value1 = {password} onChange = {handlePasswordChange} placeholder = "Password"/>
      <div className= 'space'>
      </div>
      <button className = "forgotPassword" onClick = {forgotPassword}> Forgot Password? </button>
      <div className = 'space'></div>
      <button className = "newAccount" onClick = {newAccount}> New Account? </button>
    </div>
  );
}
export default App;