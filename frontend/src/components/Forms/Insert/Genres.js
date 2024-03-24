import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Genres() {
  const [title, setTitle] = useState();

  const handleSubmitGenres = async (e) => {
    e.preventDefault();
    console.log(`${title}`);
    const toNullIfEmpty = (value) => (value === "" ? null : value);

    try {
      const response = await axios.post(
        window.apiUrl + "genres.php",
        {
          genre_id: null,
          title: toNullIfEmpty(title),
        },
        {
          headers: {
            "Authorization" : localStorage.getItem("token"),
          },
        }
      );
      console.log(response.data);
    } catch (error) {
      console.error("There was an error!", error.response);
    }
  };

  const handleSumbitGenres = (e) => {
    e.preventDefault();
    console.log(
      `${title}`
    );

    axios
    .post(window.apiUrl + "genres.php", {
      genre_id: null,
      title: title
    },
    {
      headers: {
        "Authorization" : localStorage.getItem("token"),
      },
    })
    .then((response) => {
      console.log(response.data)
    }); 
};

  return (
    <div className="insert-body">
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
        <button onClick={handleSubmitGenres}>Submit</button>
      </form>
    </div>
  );
}
