import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Albums() {
  const [recordLabel, setRecordLabel] = useState();
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  const [format, setFormat] = useState();
  const [release_date, setReleaseDate] = useState();
  // const [rating, setRating] = useState();

  const [complete, setComplete] = useState(false);

  const handleSumbitAlbums = (e) => {
    e.preventDefault();
    console.log("foo");
    console.log(
      `${recordLabel}, ${artist}, ${title}, ${format}, ${release_date}`
    );

    axios
      .post("http://localhost:8888/api/albums.php", {
        album_id: null,
        record_label:recordLabel,
        artist_id: artist,
        title: title,
        format: format,
        release_date: release_date,
        rating: null
      })
      .then((response) => {
        console.log(response.data)
      }); 
  };


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
            type="date"
            className="Albums"
            onChange={(e) => setReleaseDate(e.target.value)}
          />
          TBA songs in album
        </div>
        <button onClick={handleSumbitAlbums}>
          Submit</button>
      </form>
    </div>
  );
}
