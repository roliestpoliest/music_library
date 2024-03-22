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

  const [complete, setComplete] = useState(false);

  const handleSubmitAccounts = async (e) => {
    e.preventDefault();
    console.log(
      `${role}, ${fname}, ${lname}, ${username}, ${bio}, ${gender}, ${DOB}, ${region}, ${email}, ${password}`
    );

    try {
      const response = await axios.post(
        "http://localhost:8888/api/accounts.php",
        {
          account_id: null,
          user_role: role,
          fname: fname,
          lname: lname,
          username: username,
          bio: bio,
          gender: gender,
          DOB: DOB,
          region: region,
          email: email,
          password: password,
          isAdmin: null,
        }
      );

      console.log(response.data);
    } catch (error) {
      console.error(
        "There was an error!",
        error.response ? error.response : error
      );
    }
  };

  return (
    <div className="accounts-body">
      <form>
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
    </div>
  );
}
