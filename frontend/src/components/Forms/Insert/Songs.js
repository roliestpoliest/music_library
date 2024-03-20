import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Songs() {
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  // const [duration, setDuration] = useState();
  // const [listens, setListens] = useState();
  // const [rating, setRating] = useState();
  const [genre, setGenre] = useState();

  const [complete, setComplete] = useState(false);


  const handleSumbitSongs = (e) => {
    e.preventDefault();
    console.log("foo");
    console.log(
      `${artist}, ${title}, ${genre}`
    );

    axios
      .post("http://localhost:8888/api/songs.php", {
        song_id: null,
        artist_id: artist,
        title: title,
        duration: null,
        listens: null,
        rating: null,
        genre_id: genre
      })
      .then((response) => {
        console.log(response.data)
      }); 
  };

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
