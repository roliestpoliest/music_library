import { React, useState, useEffect } from "react";
import "./Insert.css";
import axios from "axios";

export default function Songs() {
  const [artist, setArtist] = useState();
  const [title, setTitle] = useState();
  const [duration, setDuration] = useState();
  const [genre, setGenre] = useState();
  const [fileInfo, setFileInfo] = useState();

  const [genres, setGenres]=useState([]);
  useEffect(() =>{
    async function fetchGenreData(){
      try {
        const response = await axios.get(
          "http://localhost:8888/api/genres/GenreNames.php"
        );
        setGenres(response.data);
      } catch(error) {
        console.error("Error fetching genre data: ", error);
      }
    }
    fetchGenreData();
  }, []);

  const [artists, setArtists] = useState([]);
  useEffect(() => {
    async function fetchArtistData() {
      try {
        const response = await axios.get(
          "http://localhost:8888/api/artists/names.php",
          {
            headers: {
              "Authorization" : localStorage.getItem("token"),
            },
          }
        );
        setArtists(response.data);
      } catch (error) {
        console.error("Error fetching artist data:", error);
      }
    }

    fetchArtistData();
  }, []);


  const handleSumbitSongs = async (e) => {
    e.preventDefault();
    const url = window.$domain + "songs.php";
    // console.log(url);
    try {
      axios.post(url, 
      {
        song_id: null,
        artist_id: artist,
        title: title,
        duration: null,
        listens: null,
        rating: null,
        genre_id: genre,
        audio_path: null,
        'files[]': fileInfo
      }, {
        headers: {
          "Content-Type": "multipart/form-data",
          "Authorization" : localStorage.getItem("token"),
        }
      }
    ).then((response) => {
      console.log(response.data);
    });
    
    }
    catch (error) {
      console.error("There was an error!", error.response);
    }
  };
  const handleSongUpload = (event) => {
    event.preventDefault();
    const file = event.target.files[0];
    setFileInfo(event.target.files[0]);
  };

  return (
    <div className="insert-body">
      <form className="inputForm">
        <h1>Song</h1>
        <div>
        <label>Artist</label>
          <select
            className="Albums"
            onChange={(e) => setArtist(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            {artists.map((artist) => (
              <option key={artist.artist_id} value={artist.artist_id}>
                {artist.fname} {artist.lname}
              </option>
            ))}
          </select>{" "}
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
          <select
            className="Albums"
            onChange={(e) => setGenre(e.target.value)}
          >
            <option value="none" selected disabled hidden>
              Select an Option
            </option>
            {genres.map((genre) => (
              <option key={genre.genre_id} value={genre.genre_id}>
                {genre.title} 
              </option>
            ))}
          </select>{" "}
        </div>
        <div>
          <input type="file" onChange={handleSongUpload} />
        </div>

        <button onClick={handleSumbitSongs}>
          Submit</button>
      </form>

      {/* <div>
        <form method="put" encType="multipart/form-data">
          <input type="file" onChange={handleSongUpload} />
          <button className="cancelButton">Cancel</button>
        </form>
      </div> */}
    </div>
  )
}
