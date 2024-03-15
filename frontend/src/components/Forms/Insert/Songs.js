import { React, useState, useEffect } from "react";
import "./Insert.css";

export default function Songs() {
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  // const [duration, setDuration] = useState();
  // const [listens, setListens] = useState();
  // const [rating, setRating] = useState();
  const [genre, setGenre] = useState();

  const [complete, setComplete] = useState(false);

  return (
    <div>
      <form>
        <h1>Song</h1>
        <div>
          <label>Artist</label>
          <input
            type="text"
            className="Songs"
            onChange={(e) => setArtist(e.target.value)}
          />
        </div>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Songs"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <div>
          <label>Genre</label>
          <input
            type="text"
            className="Songs"
            onChange={(e) => setGenre(e.target.value)}
          />
        </div>
        <button>Submit</button>
      </form>
    </div>
  )
}
