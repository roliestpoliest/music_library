import { React, useState, useEffect } from "react";
import "./Insert.css";

export default function Accounts() {
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

  return (
    <div>
      <form>
        <h1>Account</h1>
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
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setGender(e.target.value)}
          />
        </div>
        <div>
          <label>DOB</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setDOB(e.target.value)}
          />
        </div>
        <div>
          <label>Region</label>
          <input
            type="text"
            className="Accounts"
            onChange={(e) => setRegion(e.target.value)}
          />
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
        <button type="submit">Submit</button>
      </form>
    </div>
  );
}
