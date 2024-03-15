import { React, useState, useEffect } from "react";
import "./Insert.css";

export default function Albums() {
  const [recordLabel, setRecordLabel] = useState();
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  const [format, setFormat] = useState();
  const [release_date, setReleaseDate] = useState();
  // const [rating, setRating] = useState();

  const [complete, setComplete] = useState(false);

  return (
    <div>
      <form>
        <h1>Album</h1>
        <div>
          <label>Record Label</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setRecordLabel(e.target.value)}
          />
        </div>
        <div>
          <label>Artist</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setArtist(e.target.value)}
          />
        </div>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <div>
          <label>Format</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setFormat(e.target.value)}
          />
        </div>
        <div>
          <label>Release Date</label>
          <input
            type="text"
            className="Albums"
            onChange={(e) => setReleaseDate(e.target.value)}
          />
          TBA songs in album
        </div>
        <button>Submit</button>
      </form>
    </div>
  );
}
