import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Accounts() {
  const [role, setRole] = useState();
  const [fname, setFname] = useState();
  const [lname, setLname] = useState();
  const [username, setUsername] = useState();
  const [bio, setBio] = useState();
  const [gender, setGender] = useState();
  const [DOB, setDOB] = useState();
  const [region, setRegion] = useState();
  const [email, setEmail] = useState();
  const [password, setPassword] = useState();
  
  const [accountId, setAcountId] = useState(null);
  const [image_path, setImagePath] = useState();
  const [showImageForm, setShowImageForm] = useState(false);

  let file = null;

  const getAccounts = () => {
    console.log(localStorage.getItem("token"));
    axios.get("http://localhost:8888/api/accounts.php?account_id=5",{
      headers: {
        "Authorization" : localStorage.getItem("token"),
      },
    }).then((response) =>{
      console.log(response.data);
      setRole(response.data.role);
      setFname(response.data.fname);
      setLname(response.data.lname);
      setUsername(response.data.username);
      setBio(response.data.bio);
      setGender(response.data.gender);
      setDOB(response.data.DOB);
      setRegion(response.data.region);
      setEmail(response.data.email);
      setAcountId(response.data.accountId);
    });
  };
  

  const handleSubmitAccounts = async (e) => {
    e.preventDefault();
    // console.log(
    //   `${role}, ${fname}, ${lname}, ${username}, ${bio}, ${gender}, ${DOB}, ${region}, ${email}, ${password}`
    // );
    // const toNullIfEmpty = (value) => value.trim() === '' ? null : value.trim();
    const toNullIfEmpty = (value) => (value === "" ? null : value);

    console.log(accountId);
// return;
    try {
      const response = await axios.put(
        "http://localhost:8888/api/accounts.php",
        {
          account_id: accountId,
          user_role: toNullIfEmpty(role),
          fname: toNullIfEmpty(fname),
          lname: toNullIfEmpty(lname),
          username: toNullIfEmpty(username),
          bio: toNullIfEmpty(bio),
          gender: toNullIfEmpty(gender),
          DOB: toNullIfEmpty(DOB),
          region: toNullIfEmpty(region),
          email: toNullIfEmpty(email),
          password: toNullIfEmpty(password),
          isAdmin: null,
          image_path: toNullIfEmpty(image_path),
        }
      );
      if(accountId == null){
        setAcountId(parseInt(response.data));
      };
      // console.log(accountId);
      // console.log(response.data);
      setShowImageForm(true);
    } catch (error) {
      console.error(
        "There was an error!",
        error.response ? error.response : error
      );
    }
  };



  const handleImageUpload = (event) => {
    event.preventDefault();
    const file = event.target.files[0];
    // create a new FormData object and append the file to it
    const formData = new FormData();
    formData.append("file", file);
    // console.log(accountId);
    // make a POST request to the File Upload API with the FormData object and Rapid API headers
    const url = "http://localhost:8888/api/accounts.php?accountId=" + accountId;
    
    axios
      .post(url, {
        'myObj{}': {x: 1, s: "foo"},
        'files[]': file
      }, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
      .then((response) => {
    // handle the response
        console.log(response.data);
      })
      .catch((error) => {
        // handle errors
        console.log(error);
      });
  };
  

  return (
    <div className="insert-body">
      <div>
      <p>{role}</p>
      <p>{fname}</p>
      <p>{lname}</p>
      <p>{username}</p>
      <p>{bio}</p>
      <p>{gender}</p>
      <p>{DOB}</p>
      <p>{region}</p>
      <p>{email}</p>
      <p>{accountId}</p>
      </div>
      <form className="inputForm" encType="multipart/form-data">
        <h1>Account</h1>
        <div>
          <label>User Role</label>
          <select
            className="Accounts"
            onChange={(e) => setRole(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="User">User</option>
            <option value="Artist">Artist</option>
            <option value="Admin">Admin</option>
          </select>
        </div>
        <div>
          <label>First Name</label>
          <input
            type="text"
            className="Accounts"
            value={fname}
            onChange={(e) => setFname(e.target.value)}
          />
        </div>
        <div>
          <label>Last Name</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setLname(e.target.value)}
          />
        </div>
        <div>
          <label>Username</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setUsername(e.target.value)}
          />
        </div>
        <div>
          <label>Bio</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setBio(e.target.value)}
          />
        </div>
        <div>
          <label>Gender</label>
          <select
            className="Accounts"
            onChange={(e) => setGender(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="F">Female</option>
            <option value="M">Male</option>
            <option value="O">Other</option>
          </select>
        </div>
        <div>
          <label>DOB</label>
          <input
            type="date"
            className="Accounts"
            onChange={(e) => setDOB(e.target.value)}
          />
        </div>
        <div>
          <label>Region</label>
          <select
            className="Accounts"
            onChange={(e) => setRegion(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            <option value="NE">Northeast</option>
            <option value="SW">Southwest</option>
            <option value="W">West</option>
            <option value="SE">Southeast</option>
            <option value="MW">Midwest</option>
          </select>
        </div>
        <div>
          <label>Email</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setEmail(e.target.value)}
          />
        </div>
        <div>
          <label>Password</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setPassword(e.target.value)}
          />
        </div>
        
        <button type="submit" onClick={handleSubmitAccounts}>
          Submit
        </button>
      </form>

      {setShowImageForm > 0 &&
      <div id="uploadAvatarComponent">
        <form method="put" encType="multipart/form-data">
          <input type="file" onChange={handleImageUpload} />
        </form>
      </div>
      }

      <button onClick={getAccounts}>Get Your Data</button>
    </div>
      
  );
}
