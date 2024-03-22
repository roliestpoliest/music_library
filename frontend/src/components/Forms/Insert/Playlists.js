import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Playlists() {
  const [account, setAccount]= useState();
  const [title, setTitle] = useState();
  const [image_path, setImagePath]= useState();


  const handleSubmitPlaylists = async (e) => {
    e.preventDefault();
    console.log(
      `${account}, ${title}`
    )

    try {
      const response = await axios.post(
        "http://localhost:8888/api/playlists.php",
        {
          playlist_id: null,
          account_id: account,
          title: title,
          image_path: null
        }
      );
      console.log(response.data);
    } catch(error){
      console.error("There was an error!", error.response);
    }
  };
  
  return (
    <div className="insert-body">
      <form>
        <h1>Playlist</h1>
        <div>
          <label>Account</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) => setAccount(e.target.value)}
          />
        </div>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) =>setTitle(e.target.value)}
          />
        </div>
        <div>
        <button onClick={handleSubmitPlaylists}>Submit</button>
          <label>Image Path</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) => setImagePath(e.target.value)}
          />
        </div>
        <div>TBA: songs in playlist</div>
        <button>Submit</button>
      </form>
    </div>
  );
}
