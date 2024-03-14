import React, {useState} from 'react';
import './App.css';
// <li><a href = '#'>Create new account </a></li>
//import './logintest.css';
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
    function clickLogin()
    {
      alert("Logging to home page")
    }
    return (
    <div classname = "logindemo">
      <p> DisCoogs </p>
      <p> Username: </p>
      <input value = {name} onChange = {handleNameChange}/>
      <p> Password: </p>
      <input password = {password} onChange = {handlePasswordChange}/>
      <p></p>
      <button onClick = {clickLogin}> Login </button>
    </div>
  );
}
export default App;