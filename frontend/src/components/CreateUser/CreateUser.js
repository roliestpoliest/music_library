import { React, useState, useEffect } from "react";
import axios from "axios";

export default function CreateUser({userObj}) {
    const [showImageForm, setShowImageForm] = useState(false);
    const folder = window.$imageFolder;

    const handleImageUpload = (event) => {
        event.preventDefault();
        const file = event.target.files[0];
        const formData = new FormData();
        formData.append("file", file);
        const url = window.apiUrl + "accounts.php?accountId=" + userObj.accountId;
        axios
          .post(url, {
            'myObj{}': {x: 1, s: "foo"},
            'files[]': file
          }, {
            headers: {
              "Content-Type": "multipart/form-data",
              "Authorization" : localStorage.getItem("token"),
            },
          })
          .then((response) => {
            console.log(response.data);
            setShowImageForm(false);
          })
          .catch((error) => {
            console.log(error);
          });
      };
    
    return(
        <div className="sg-card">
            <div className="sg-card-image">
                <img className="song-image"
                src={window.$imageFolder + userObj.image_path}
                alt="song cover"
                />
            </div>
            <div className="sg-card-content">
                <div className="song-title">{userObj.fname} {userObj.lname}</div>
                <div className="sg-artist-name">{userObj.email}</div>
                <div className="sg-artist-name">{userObj.image_path}</div>
                <button className="appButton" onClick={()=>{setShowImageForm(true);}}>Change Avatar</button>
                {showImageForm > 0 &&
                <div id="uploadAvatarComponent">
                    <form method="put" encType="multipart/form-data">
                    <input type="file" onChange={handleImageUpload} />
                    <button className="cancelButton" onClick={()=>{setShowImageForm(false);}}>Cancel</button>
                    </form>
                </div>
                }
            </div>
        </div>
    );
}