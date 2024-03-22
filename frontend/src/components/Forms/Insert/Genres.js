import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Genres() {
  const [title, setTitle] = useState();

  const [complete, setComplete] = useState(false);

  const handleSumbitGenres = (e) => {
    e.preventDefault();
    console.log(
      `${title}`
    );

    axios
    .post("http://localhost:8888/api/genres.php", {
      genre_id: null,
      title: title
    })
    .then((response) => {
      console.log(response.data)
    }); 
};

  return (
    <div>
      <form>
        <h1>Genre</h1>
        <div>
          <label>Title</label>
          <input
            type="text"
            className="Genres"
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <button onClick={handleSumbitGenres}>
           Submit</button>
      </form>
    </div>
  )
}
