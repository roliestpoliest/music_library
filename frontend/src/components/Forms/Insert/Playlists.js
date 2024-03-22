import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Playlists() {
  const [title, setTitle] = useState();
  return (
    <div>
      <form>
        <h1>Playlist</h1>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Playlists"
            onChange={(e) => setTitle(e.target.value)}
          />
          TBA: songs in playlist
        </div>
        <button>Submit</button>
      </form>
    </div>
  )
}
